<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Hikmat20
 * @copyright Copyright (c) 2023, Hikmat20
 *
 * This is controller for Hscode
 */

class Hscode extends Admin_Controller
{
    // Permission
    protected $viewPermission = 'HS_Code.View';
    protected $addPermission = 'HS_Code.Add';
    protected $managePermission = 'HS_Code.Manage';
    protected $deletePermission = 'HS_Code.Delete';
    protected $ls;
    public function __construct()
    {
        parent::__construct();
        $this->load->library(['mpdf', 'upload', 'Image_lib']);
        $this->load->model([
            'Hscode/Hscode_model',
            'Aktifitas/aktifitas_model',
        ]);

        $this->template->title('HS Code Master');
        $this->template->page_icon('fa fa-table');
        $this->ls = [
            'Y' => 'Yes',
            'N' => 'No',
        ];
        date_default_timezone_set('Asia/Bangkok');
    }

    public function getData()
    {
        $requestData = $_REQUEST;
        $status = $requestData['status'];
        $search = $requestData['search']['value'];
        $column = $requestData['order'][0]['column'];
        $dir = $requestData['order'][0]['dir'];
        $start = $requestData['start'];
        $length = $requestData['length'];

        $where = '';
        $where = " AND `status` = '$status'";

        $string = $this->db->escape_like_str($search);

        $sql = "SELECT *,(@row_number:=@row_number + 1) AS num
        FROM view_hscodes, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (local_code LIKE '%$string%'
        OR origin_code LIKE '%$string%'
        OR `country_code` LIKE '%$string%'
        OR `country_name` LIKE '%$string%'
        -- OR `product_name` LIKE '%$string%'
        OR `brand` LIKE '%$string%'
        OR `description` LIKE '%$string%'
        OR `status` LIKE '%$string%'
            )";

        $totalData = $this->db->query($sql)->num_rows();
        $totalFiltered = $this->db->query($sql)->num_rows();

        $columns_order_by = [
            0 => 'num',
            1 => 'local_code',
            2 => 'origin_code',
            3 => 'country_code',
            4 => 'description',
            5 => 'brand',
            6 => 'status',
            7 => 'modified_at',
        ];

        $sql .= ' ORDER BY ' . $columns_order_by[$column] . ' ' . $dir . ' ';
        $sql .= ' LIMIT ' . $start . ' ,' . $length . ' ';
        $query = $this->db->query($sql);

        $data = [];
        $urut1 = 1;
        $urut2 = 0;

        $status = [
            '0' => '<span class="bg-danger tx-white pd-5 tx-11 tx-bold rounded-5">Inactive</span>',
            '1' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">Active</span>',
        ];

        /* Button */
        foreach ($query->result_array() as $row) {
            $buttons = '';
            $total_data = $totalData;
            $start_dari = $start;
            $asc_desc = $dir;
            if (
                $asc_desc == 'asc'
            ) {
                $nomor = $urut1 + $start_dari;
            }
            if (
                $asc_desc == 'desc'
            ) {
                $nomor = ($total_data - $start_dari) - $urut2;
            }

            $view = '<button type="button" class="btn btn-primary btn-sm view" data-toggle="tooltip" title="View" data-id="' . $row['id'] . '"><i class="fa fa-eye"></i></button>';
            $edit = '<button type="button" class="btn btn-success btn-sm edit" data-toggle="tooltip" title="Edit" data-id="' . $row['id'] . '"><i class="fa fa-edit"></i></button>';
            $delete = '<button type="button" class="btn btn-danger btn-sm delete" data-toggle="tooltip" title="Delete" data-id="' . $row['id'] . '"><i class="fa fa-trash"></i></button>';
            $buttons = $view;

            if (has_permission($this->managePermission)) {
                $buttons .= '&nbsp;' . $edit . '&nbsp;' . $delete;
            }

            $nestedData = [];
            $nestedData[] = $nomor;
            $nestedData[] = $row['local_code'];
            $nestedData[] = $row['origin_code'];
            $nestedData[] = $row['country_code'] . ' - ' . $row['country_name'];
            $nestedData[] = $row['description'];
            $nestedData[] = $row['brand'];
            $nestedData[] = $status[$row['status']];
            $nestedData[] = $row['modified_at'];
            $nestedData[] = $buttons;
            $data[] = $nestedData;
            ++$urut1;
            ++$urut2;
        }

        $json_data = [
            'draw' => intval($requestData['draw']),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ];

        echo json_encode($json_data);
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $this->template->render('index');
    }

    public function add()
    {
        $this->auth->restrict($this->viewPermission);
        $countries = $this->Hscode_model->get_data('countries');
        $def_ppn = $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
        $def_pph_api = $this->db->get_where('configs', ['key' => 'pph_api'])->row()->value;
        $def_pph_napi = $this->db->get_where('configs', ['key' => 'pph_napi'])->row()->value;
        $lartas = $this->db->get_where('fee_lartas', ['status' => '1'])->result();
        $this->template->set([
            'def_ppn'       => $def_ppn,
            'def_pph_api'   => $def_pph_api,
            'def_pph_napi'  => $def_pph_napi,
            'countries'     => $countries,
            'lartas'        => $lartas,
        ]);
        $this->template->render('form');
    }

    public function edit($id)
    {

        $hs             = $this->db->get_where('hscodes', ['id' => $id])->row();
        $countries      = $this->Hscode_model->get_data('countries');
        $def_ppn        = $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
        $def_pph_api    = $this->db->get_where('configs', ['key' => 'pph_api'])->row()->value;
        $def_pph_napi   = $this->db->get_where('configs', ['key' => 'pph_napi'])->row()->value;
        $requirements   = $this->db->get_where('hscode_requirements', ['hscode_id' => $hs->id])->result_array();
        $ArrRQ          = [];
        $lartas         = $this->db->get_where('fee_lartas', ['status' => '1'])->result();

        foreach ($requirements as $rq) {
            $ArrRQ[$rq['type']][] = $rq;
        }

        $this->template->set([
            'hs' => $hs,
            'def_ppn' => $def_ppn,
            'def_pph_api' => $def_pph_api,
            'def_pph_napi' => $def_pph_napi,
            'countries' => $countries,
            'ArrRQ' => $ArrRQ,
            'lartas' => $lartas,
        ]);
        $this->template->render('form');
    }

    public function view($id)
    {
        $this->auth->restrict($this->viewPermission);
        $hs             = $this->db->get_where('hscodes', ['id' => $id])->row();
        $countries      = $this->db->get('countries')->result_array();
        $def_ppn        = $this->db->get_where('configs', ['key' => 'ppn'])->row()->value;
        $requirements   = $this->db->get_where('hscode_requirements', ['hscode_id' => $hs->id])->result_array();
        $lartas         = $this->db->get_where('fee_lartas', ['status' => '1'])->result_array();
        $ArrLartas      = array_column($lartas, 'name', 'id');
        $unit = [
            'rp'        => '(Rp)',
            'm'         => 'Meter',
            'percent'   => '%',
            'kg'        => 'Kg',
        ];
        $ArrRQ          = [];
        foreach ($requirements as $rq) {
            $ArrRQ[$rq['type']][] = $rq;
        }

        $ArrCountries = array_column($countries, 'name', 'id');
        $this->template->set([
            'hs'            => $hs,
            'def_ppn'       => $def_ppn,
            'ArrCountries'  => $ArrCountries,
            'ArrRQ'         => $ArrRQ,
            'ArrLartas'     => $ArrLartas,
            'unit'          => $unit,
            'LS'            => $this->ls,
        ]);
        $this->template->render('view');
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('hscodes', ['id' => $id])->row_array();

        $this->db->trans_begin();
        $sql = $this->db->update('hscodes', ['status' => '0', 'deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $this->auth->user_id()], ['id' => $id]);
        $errMsg = $this->db->error()['message'];
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $keterangan = 'FAILD ' . $errMsg;
            $status = 0;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
            $return = [
                'msg' => 'Failed delete data HS Codes. Please try again. ' . $errMsg,
                'status' => 0,
            ];
        } else {
            $this->db->trans_commit();
            $return = [
                'msg' => 'Delete data HS Codes.',
                'status' => 1,
            ];
            $keterangan = 'Delete data HS Codes ' . $data['id'] . ', HS Codes name : ' . $data['description'];
            $status = 1;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    // -------------------------------------------------------------
    public function save()
    {
        $this->auth->restrict($this->addPermission);
        $post = $this->input->post();
        $data = $post;

        $data['id'] = $post['id'] ?: $this->Hscode_model->generate_id();

        $RQ = $post['requirement'];
        unset($data['requirement']);
        $this->db->trans_begin();
        if (isset($post['id']) && $post['id'] == '') {
            $data['created_at'] = $data['modified_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $data['modified_by'] = $this->auth->user_id();
            $this->db->insert('hscodes', $data);
        } else {
            $data['modified_at'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->auth->user_id();
            $this->db->update('hscodes', $data, ['id' => $data['id']]);
        }

        if ($RQ) {
            foreach ($RQ as $rq) {
                $dataRq = [
                    'hscode_id' => $data['id'],
                    'name' => $rq['name'],
                    'description' => $rq['description'],
                    'type' => $rq['type'],
                ];

                if (isset($rq['id']) && $rq['id']) {
                    $check = $this->db->get_where('hscode_requirements', ['id' => $rq['id']])->num_rows();
                    if ($check > 0) {
                        $dataRq['modified_by'] = $this->auth->user_id();
                        $dataRq['modified_at'] = date('Y-m-d H:i:s');
                        $this->db->update('hscode_requirements', $dataRq, ['id' => $rq['id']]);
                    }
                } else {
                    $dataRq['created_by'] = $dataRq['modified_by'] = $this->auth->user_id();
                    $dataRq['created_at'] = $dataRq['modified_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('hscode_requirements', $dataRq);
                }
            }
        }

        if ($this->db->trans_status() === false) {
            $errorMsg = $this->db->error()['message'];
            $this->db->trans_rollback();
            $return = [
                'msg' => 'Failed save data HS Code.  Please try again.',
                'status' => 0,
            ];
            $keterangan = 'FAILED save data HS Code ' . $data['id'] . ', HS Code name : ' . $data['description'] . '. ' . $errorMsg;
            $status = 1;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg' => 'Success Save data Customer.',
                'status' => 1,
            ];
            $keterangan = 'SUCCESS save data Customer ' . $data['id'] . ', HS Code name : ' . $data['description'];
            $status = 1;
            $nm_hak_akses = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }


    public function deleteRQ()
    {
        $id = $this->input->post('id');
        $data = $this->db->get_where('hscode_requirements', ['id' => $id])->row_array();

        $this->db->trans_begin();
        // $sql = $this->db->update('hscode_requirements', ['status' => '0', 'deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $this->auth->user_id()], ['id' => $id]);
        $sql = $this->db->delete('hscode_requirements', ['id' => $id]);
        $errMsg = $this->db->error()['message'];
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $keterangan = 'FAILD ' . $errMsg;
            $status = 0;
            $nm_hak_akses = $this->deletePermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
            $return = [
                'msg' => 'Failed delete data HS Code Requirement. Please try again. ' . $errMsg,
                'status' => 0,
            ];
        } else {
            $this->db->trans_commit();
            $return = [
                'msg' => 'Delete data HS Codes Requirement.',
                'status' => 1,
            ];
            $keterangan = 'Delete data HS Codes Requirement ' . $data['id'];
            $status = 1;
            $nm_hak_akses = $this->deletePermission;
            $kode_universal = $data['id'];
            $jumlah = 1;
            $sql = $this->db->last_query();
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }


    public function print_request($id)
    {
        $id_customer = $id;
        $mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
        $mpdf->SetImportUse();
        $mpdf->RestartDocTemplate();

        $cust_toko = $this->Toko_model->tampil_toko($id_customer)->result();
        // $cust_setpen    =  $this->Penagihan_model->tampil_tagih($id_customer)->result();
        // $cust_setpem    =  $this->Pembayaran_model->tampil_bayar($id_customer)->result();
        $cust_pic = $this->Pic_model->tampil_pic($id_customer)->result();
        $cust_data = $this->Customer_model->find_data('customer', $id_customer, 'id_customer');
        $inisial = $this->Customer_model->find_data('data_reff', $id_customer, 'id_customer');

        $this->template->set('cust_data', $cust_data);
        $this->template->set('inisial', $inisial);
        $this->template->set('cust_toko', $cust_toko);
        // $this->template->set('cust_setpen', $cust_setpen);
        // $this->template->set('cust_setpem', $cust_setpem);
        $this->template->set('cust_pic', $cust_pic);
        $show = $this->template->load_view('print_data', $data);

        $this->mpdf->WriteHTML($show);
        $this->mpdf->Output();
    }

    public function rekap_pdf()
    {
        $mpdf = new mPDF('', '', '', '', '', '', '', '', '', '');
        $mpdf->SetImportUse();
        $mpdf->RestartDocTemplate();
        $session = $this->session->userdata('app_session');
        $kdcab = $session['kdcab'];
        $data_cus = $this->Customer_model->rekap_data($kdcab)->result_array();
        $this->template->set('data_cus', $data_cus);

        $show = $this->template->load_view('print_rekap', $data);

        $this->mpdf->AddPage('L');
        $this->mpdf->WriteHTML($show);
        $this->mpdf->Output();
    }

    public function downloadExcel()
    {
        $session = $this->session->userdata('app_session');
        $kdcab = $session['kdcab'];
        // $data_cus = $this->Customer_model->rekap_data($kdcab)->result_array();
        $data_cus = $this->db->get_where('customer', ['kdcab' => $session['kdcab'], 'deleted != 0'])->result_array();
        // print_r($data_cus);die();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);

        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);

        $header = [
            'alignment' => [
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ],
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
                'name' => 'Verdana',
            ],
        ];
        $objPHPExcel->getActiveSheet()->getStyle('A1:I2')
            ->applyFromArray($header)
            ->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I2');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'REKAP DATA CUSTOMER')
            ->setCellValue('A3', 'No.')
            ->setCellValue('B3', 'ID CUSTOMER')
            ->setCellValue('C3', 'NAMA CUSTOMER')
            ->setCellValue('D3', 'BIDANG USAHA')
            ->setCellValue('E3', 'MARKETING')
            ->setCellValue('F3', 'KREDIBILITAS')
            ->setCellValue('G3', 'PRODUK')
            ->setCellValue('H3', 'ALAMAT')
            ->setCellValue('I3', 'KREDIT LIMIT');

        $ex = $objPHPExcel->setActiveSheetIndex(0);
        $no = 1;
        $counter = 4;
        foreach ($data_cus as $row) {
            $ex->setCellValue('A' . $counter, $no++);
            $ex->setCellValue('B' . $counter, $row['id_customer']);
            $ex->setCellValue('C' . $counter, $row['nm_customer']);
            $ex->setCellValue('D' . $counter, $row['bidang_usaha']);
            $ex->setCellValue('E' . $counter, $row['nama_karyawan']);
            $ex->setCellValue('F' . $counter, $row['kredibilitas']);
            $ex->setCellValue('G' . $counter, $row['produk_jual']);
            $ex->setCellValue('H' . $counter, $row['alamat']);
            $ex->setCellValue('I' . $counter, $row['limit_piutang']);

            $counter = $counter + 1;
        }

        $objPHPExcel->getProperties()->setCreator('Yunaz Fandy')
            ->setLastModifiedBy('Yunaz Fandy')
            ->setTitle('Export Rekap Data Customer')
            ->setSubject('Export Rekap Data Customer')
            ->setDescription('Rekap Data Customer for Office 2007 XLSX, generated by PHPExcel.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('PHPExcel');
        $objPHPExcel->getActiveSheet()->setTitle('Rekap Data Customer');
        ob_clean();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ExportCustomer' . date('Ymd') . '.xls"');

        $objWriter->save('php://output');
    }
}
