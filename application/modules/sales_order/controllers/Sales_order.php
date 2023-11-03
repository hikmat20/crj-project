<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Hikmat Aolia
 * @copyright Copyright (c) 2023, Hikmat Aolia
 *
 * This is controller for Sales order
 */

class Sales_order extends Admin_Controller
{
    //Permission
    protected $viewPermission     = 'Sales_order.View';
    protected $addPermission      = 'Sales_order.Add';
    protected $managePermission = 'Sales_order.Manage';
    protected $deletePermission = 'Sales_order.Delete';
    protected $currency;
    protected $ls;
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('upload', 'Image_lib'));
        $this->load->helper(array('grid_helper'));
        $this->load->model(array(
            // 'Sales_order/Sales_order',
            // 'Requests/Requests_model',
            'Aktifitas/aktifitas_model',
        ));
        $this->template->title('Sales Order');
        $this->template->page_icon('fa fa-list');
        $this->currency = $this->db->get('currency')->result();
        $this->ls = [
            'Y' => 'Yes',
            'N' => 'No',
        ];
        $this->template->set([
            'ENABLE_ADD'     => has_permission('Sales_order.Add'),
            'ENABLE_MANAGE'  => has_permission('Sales_order.Manage'),
            'ENABLE_VIEW'    => has_permission('Sales_order.View'),
            'ENABLE_DELETE'  => has_permission('Sales_order.Delete'),
        ]);
        date_default_timezone_set('Asia/Bangkok');
    }

    public function getData()
    {
        $requestData    = $_REQUEST;
        $status         = $requestData['status'];
        $search         = $requestData['search']['value'];
        $column         = $requestData['order'][0]['column'];
        $dir            = $requestData['order'][0]['dir'];
        $start          = $requestData['start'];
        $length         = $requestData['length'];

        $where = "";
        // if ($status) {
        //     $where = " AND `status` IN($status)";
        // } else {
        //     $where = " AND `status` NOT IN('QTT','HIS')";
        // }

        $string = $this->db->escape_like_str($search);
        $sql = "SELECT *,(@row_number:=@row_number + 1) AS num
        FROM view_sales_order, (SELECT @row_number:=0) as temp WHERE 1=1 $where  
        AND (`customer_name` LIKE '%$string%'
        OR `number` LIKE '%$string%'
        OR `project_name` LIKE '%$string%'
        OR `date` LIKE '%$string%'
        OR `employee_name` LIKE '%$string%'
        OR `status` LIKE '%$string%')";

        $totalData = $this->db->query($sql)->num_rows();
        $totalFiltered = $this->db->query($sql)->num_rows();

        $columns_order_by = array(
            0 => 'num',
            1 => 'number',
            2 => 'customer_name',
            3 => 'project_name',
            4 => 'date',
            5 => 'employee_name',
        );

        $sql .= " ORDER BY `created_at` DESC, " . $columns_order_by[$column] . " " . $dir . " ";
        $sql .= " LIMIT " . $start . " ," . $length . " ";
        $query  = $this->db->query($sql);

        $data  = array();
        $urut1  = 1;
        $urut2  = 0;

        $status = [
            'OPN' => '<span class="bg-info tx-white pd-5 tx-11 tx-bold rounded-5">New</span>',
            'DEAL' => '<span class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">Deal</span>',
            'LOSE' => '<span class="bg-light tx-white pd-5 tx-11 tx-bold rounded-5">Lose</span>',
            'RVI' => '<span class="bg-warning tx-white pd-5 tx-11 tx-bold rounded-5">Revision</span>',
            'HIS' => '<span class="bg-light pd-5 tx-11 tx-bold rounded-5">History</span>',
            'CNL' => '<span class="bg-secondary tx-white pd-5 tx-11 tx-bold rounded-5">Cancel</span>',
        ];

        /* Button */
        foreach ($query->result_array() as $row) {
            $buttons = '';
            $total_data     = $totalData;
            $start_dari     = $start;
            $asc_desc       = $dir;

            $flags =
                (($row['flag_invoice'] == 'Y') ? '<label class="bg-primary tx-white pd-5 tx-11 tx-bold rounded-5">INV</label>' . ' ' : '') .
                (($row['flag_pl'] == 'Y') ? '<label class="bg-success tx-white pd-5 tx-11 tx-bold rounded-5">PL</label>' . ' ' : '') .
                (($row['flag_bl'] == 'Y') ? '<label class="bg-indigo tx-white pd-5 tx-11 tx-bold rounded-5">BL</label>' . ' ' : '') .
                (($row['flag_fe'] == 'Y') ? '<label class="bg-warning tx-white pd-5 tx-11 tx-bold rounded-5">FE</label>' . ' ' : '') .
                (($row['flag_po'] == 'Y') ? '<label class="bg-pink tx-white pd-5 tx-11 tx-bold rounded-5">PO</label>' . ' ' : '') .
                (($row['flag_sc'] == 'Y') ? '<label class="bg-purple tx-white pd-5 tx-11 tx-bold rounded-5">SC</label>' : '');

            $flagAll = (($row['flag_invoice'] == 'Y') &&
                ($row['flag_pl'] == 'Y') &&
                ($row['flag_bl'] == 'Y') &&
                ($row['flag_fe'] == 'Y') &&
                ($row['flag_po'] == 'Y') &&
                ($row['flag_sc'] == 'Y')) ? 'Y' : 'N';
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

            $opsi         = '<a href="' . base_url($this->uri->segment(1) . '/detail/' . $row['id']) . '" class="btn btn-primary btn-sm" title="Detail" data-id="' . $row['id'] . '" data-number="' . $row['number'] . '"><i class="fa fa-pen"></i></a>';
            $rel          = '<button type="button"  class="btn bg-royal text-white btn-sm release_so" data-toggle="tooltip" title="Release SO" data-id="' . $row['id'] . '"><i class="fa fa-paper-plane"></i></button>';
            $revision     = '<a href="' . base_url($this->uri->segment(1) . '/revision/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Revision" data-id="' . $row['id'] . '"><i class="icon ion-edit text-warning"></i> Revison</a>';
            $deal         = '<a href="javascript:void(0)" class="nav-link" data-toggle="tooltip" title="Create Quotation" data-id="' . $row['id'] . '"><i class="fas fa-handshake text-primary"></i> Deal</a>';
            $printAI      = '<a href="' . base_url($this->uri->segment(1) . '/print_all_in/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Print All-In" data-id="' . $row['id'] . '" target="_blank"><i class="icon ion-printer text-info"></i> Print All-In</a>';
            $printAPB     = '<a href="' . base_url($this->uri->segment(1) . '/print_apb/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Print As Per-Bill" data-id="' . $row['id'] . '" target="_blank"><i class="icon ion-printer text-info"></i> <span class="">Print As Per-Bill</span></a>';
            $printDDU     = '<a href="' . base_url($this->uri->segment(1) . '/print_ddu/' . $row['id']) . '" class="nav-link" data-toggle="tooltip" title="Print As Per-Bill" data-id="' . $row['id'] . '" target="_blank"><i class="icon ion-printer text-info"></i> <span class="">Print DDU</span></a>';
            $cancel       = '<a href="javascript:void(0)" class="nav-link cancel" data-toggle="tooltip" title="Cancel" data-id="' . $row['id'] . '"><i class="icon ion-minus-circled text-danger"></i> Cancel</a>';
            $printBTN     = '';
            $buttons     = $opsi;

            if ($row['flag_release'] == 'N') {
                if ($flagAll == 'Y') {
                    $buttons     = $opsi . " " . $rel;
                }
            } else {
                $buttons     = '<label class="bg-success tx-white px-2 tx-bold rounded-20">Release</label>';
            }

            $nestedData   = array();
            $nestedData[]  = $nomor;
            $nestedData[]  = $row['number'];
            $nestedData[]  = $row['customer_name'];
            $nestedData[]  = $row['project_name'];
            $nestedData[]  = date("d/m/Y", strtotime($row['date']));
            $nestedData[]  = $row['employee_name'];
            $nestedData[]  = ($flags != '') ? $flags : $status[$row['status']];
            $nestedData[]  = $buttons;

            $data[] = $nestedData;
            $urut1++;
            $urut2++;
        }

        $json_data = array(
            "draw"              => intval($requestData['draw']),
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $this->template->render('index');
    }

    function detail($id)
    {
        $this->template->title('Detail Sales Order');
        $SO             = $this->db->get_where('sales_order', ['id' => $id])->row();
        $header         = $this->db->get_where('view_sales_order', ['id' => $id])->row();
        // $formE          = $this->db->get_where('form_e', ['so_id' => $id])->row();

        $data = [
            'header'        => $header,
            'SO'            => $SO,
            // 'FE'            => $formE,
        ];

        $this->template->set($data);
        $this->template->render('detail');
    }

    function more_detail($id)
    {
        $this->auth->restrict($this->viewPermission);
        $configs            = $this->db->get('configs')->result();
        $header             = $this->db->get_where('view_sales_order', ['id' => $id])->row();
        $companies          = $this->db->get_where('companies', ['status' => '1'])->result();
        $ports              = $this->db->get_where('harbours', ['status' => '1'])->result();
        $containers         = $this->db->get_where('containers', ['status' => '1'])->result();
        $cities             = $this->db->get_where('cities', ['country_id' => '102', 'flag' => '1'])->result();
        $areas              = $this->db->get_where('areas', ['city_id' => $header->dest_city])->result();
        $details            = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $hscodes            = $this->db->get_where('hscodes', array('status' => '1'))->result();
        $hscodes_doc        = $this->db->get_where('hscode_requirements')->result();
        $lartas             = $this->db->get_where('lartas', ['status' => '1'])->result_array();
        $costing            = $this->db->get_where('sales_order_costing', ['so_id' => $id])->result();
        $fee_lartas         = $this->db->get_where('sales_order_lartas', ['so_id' => $id])->result();
        $otherCost          = $this->db->get_where('sales_order_costing', ['so_id' => $id, 'name like' => '%OTH%'])->result();
        $payment_term       = $this->db->get_where('sales_order_pay_term', ['so_id' => $id])->result();
        $ArrLartas          = array_column($lartas, 'name', 'id');
        $ArrHscode          = [];
        $ArrDocs            = [];
        $ArrPorts           = [];
        $ArrCurrency        = [];

        $unitLartas     = [
            'TNE' => 'Tonase',
            'SPM' => 'Shipment',
            'CNT' => 'Container',
            'ITM' => 'Item',
        ];

        $default = [];
        foreach ($configs as $conf) {
            $default[$conf->key] = $conf;
        }

        foreach ($this->currency as $cur) {
            $ArrCurrency[$cur->code] = $cur;
        }

        $currency = $ArrCurrency[$header->currency]->symbol;
        $currency_code = $ArrCurrency[$header->currency]->code;

        $ArrPayTerm = [];
        foreach ($payment_term as $pt) {
            $ArrPayTerm[$pt->name] = $pt;
        }

        foreach ($hscodes as $hs) {
            $ArrHscode[$hs->origin_code] = $hs;
        }

        foreach ($hscodes_doc as $doc) {
            $ArrDocs[$doc->hscode_id][$doc->type][] = $doc;
        }

        foreach ($ports as $port) {
            $ArrPorts[$port->country_id][] = $port;
        }

        $ArrCosting = [];
        foreach ($costing as $cst) {
            $ArrCosting[$cst->name] = $cst;
        }

        $data = [
            'default'             => $default,
            'currency'             => $currency,
            'currency_code'     => $currency_code,
            'header'             => $header,
            'companies'         => $companies,
            'costing'             => $costing,
            'ports'             => $ports,
            'areas'             => $areas,
            'containers'         => $containers,
            'cities'             => $cities,
            'details'             => $details,
            'ArrHscode'         => $ArrHscode,
            'ArrDocs'             => $ArrDocs,
            'ArrPorts'             => $ArrPorts,
            'ArrLartas'         => $ArrLartas,
            'fee_lartas'         => $fee_lartas,
            'ArrCosting'         => $ArrCosting,
            'unitLartas'         => $unitLartas,
            'otherCost'         => $otherCost,
            'ArrPayTerm'         => $ArrPayTerm,
        ];


        $this->template->set($data);
        $this->template->render('more-detail');
    }


    /* INVOICE */

    function create_invoice($id)
    {
        $this->template->title('Create Invoice');
        $symbol         = $this->db->get('currency')->result_array();
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();

        $data = [
            'dataSO'        => $dataSO,
            'dataDetail'    => $dataDetail,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
        ];

        $this->template->set($data);
        $this->template->render('create-invoice');
    }

    function getIDInvoice()
    {
        // INV-2309-001
        $ym = date('ym');
        $result = $this->db->select('MAX(RIGHT(id,3)) as id')->from('invoices')
            ->where('SUBSTR(id,5,4)', $ym)->get()->row();
        $count = 1;
        if ($result->id) {
            $count = $result->id + 1;
        }
        $newID = 'INV-' . $ym . "-" . sprintf('%03d', $count);
        return $newID;
    }

    function saveInvoice()
    {
        $post                           = $this->input->post();
        $data                           = $post;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;
        // $data['id']                     = isset($post['id']) ? $post['id'] : $this->getIDInvoice();
        $data['subtotal']               = str_replace(",", "", $data['subtotal']);
        $data['insurance']              = str_replace(",", "", $data['insurance']);
        $data['freight']                = str_replace(",", "", $data['freight']);
        $data['grand_total_invoice']    = str_replace(",", "", $data['grand_total_invoice']);
        $data['flag_invoice']           = 'Y';
        $data['third_party']            = isset($data['third_party']) ? $data['third_party'] : 'N';
        $data['trd_company_name']       = isset($data['trd_company_name']) ? $data['trd_company_name'] : null;
        $data['trd_company_address']    = isset($data['trd_company_address']) ? $data['trd_company_address']  : null;
        $data['qq']                     = isset($data['qq']) ? $data['qq'] : 'N';
        $data['qq_company_name']        = isset($data['qq_company_name']) ? $data['qq_company_name'] : null;
        $data['qq_company_address']     = isset($data['qq_company_address']) ? $data['qq_company_address']  : null;
        // unset($data['gTotal']);
        // unset($data['detail']);

        // $detail                 = isset($data['detail']) ? $data['detail'] : '';

        // if ($detail) foreach ($detail as $k => $dtl) {
        //     $k++;
        //     $dataDetail[$k] = $dtl;
        //     // $dataDetail[$k]['id']                = ($data['id'] . "-" . sprintf("%03d", $k));
        //     // $dataDetail[$k]['invoice_id']        = ($data['id']);
        //     // $dataDetail[$k]['unit_price']        = ($dtl['unit_price']);
        //     // $dataDetail[$k]['total_price']       = ($dtl['total_price']);
        //     // $dataDetail[$k]['created_by']        = $this->auth->user_id();
        //     // $dataDetail[$k]['created_at']        = date('Y-m-d H:i:s');
        // }

        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $data['id']]);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data invoice, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data invoice.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data Invoice.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function editInvoice($id)
    {
        $data           = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol         = $this->db->get('currency')->result_array();

        $data = [
            'data'          => $data,
            'dataDetail'    => $dataDetail,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
        ];
        $this->template->set($data);
        $this->template->render('edit-invoice');
    }

    function viewInvoice($id)
    {
        $data           = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol         = $this->db->get('currency')->result_array();
        $data = [
            'data'          => $data,
            'dataDetail'    => $dataDetail,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
        ];
        $this->template->set($data);
        $this->template->render('view-invoice');
    }

    function print_invoice($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 35;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $header         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $suppliers      = $this->db->get_where('harbours', ['status' => '1'])->result();
        $comp           = $this->db->get_where('companies', ['id' => $header->company_id])->row();
        $symbol         = $this->db->get('currency')->result_array();
        $mpdf->SetHTMLHeader('<h2 style="text-align:center;margin:0px">' . $header->supplier_name . '</h2>
        <p style="text-align:center;margin:0px" class="font">' . $header->supplier_address . '</p>
        ');
        $mpdf->AddPage('P', '', '', '', '', 0, 0, 20, 5, 5, 0);
        foreach ($this->currency as $curr) {
            $ArrCurr[$curr->code] = $curr;
        }

        $data = [
            'header'        => $header,
            'details'       => $details,
            'suppliers'     => $suppliers,
            'comp'          => $comp,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
        ];

        $this->template->set($data);
        $html = $this->template->load_view('print-invoice');
        $mpdf->WriteHTML($html);
        $name = $header->customer_name . " " . str_replace("/", "-", $header->invoice_number);
        $mpdf->Output($name, 'I');
    }


    /* END INVOICE */


    /* PACKING LIST */

    function createPackinglist($id)
    {
        $this->template->title('Create Packing List');
        $symbol         = $this->db->get('currency')->result_array();
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();

        $data = [
            'dataSO'        => $dataSO,
            'dataDetail'    => $dataDetail,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
        ];

        $this->template->set($data);
        $this->template->render('create-packing-list');
    }

    function editPackingList($id)
    {
        $symbol = $this->db->get('currency')->result_array();
        $data         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();

        $data = [
            'data'        => $data,
            'dataDetail'    => $dataDetail,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];

        $this->template->set($data);
        $this->template->render('edit-packing-list');
    }

    function export($id)
    {
        $this->load->library('excel');
        $header = $this->db->get_where('sales_order', ['id' => $id])->row();
        $result = $this->db->get_where('sales_order_details', ['so_id' => $id])->result_array();
        $data = [
            'header' => $header,
            'detail' => $result
        ];
        // $this->load->view('export', $data);


        $excel = new PHPExcel();
        // Settingan awal file excel
        $excel->getProperties()->setCreator('CSJ Group')
            ->setLastModifiedBy('CSJ Group')
            ->setTitle("Data Item")
            ->setSubject("Item")
            ->setDescription("Data Item Sales Order")
            ->setKeywords("Sales Order Item");

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Packing List"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "ID"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "DESCRIPTION OF GOODS"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "SPECIFICATION"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "QTY"); // Set kolom E3 dengan tulisan "TELEPON"
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "UNIT"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "PACKAGES"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "UNIT PACKAGES"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "N.W (KGS)"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "G.W (KGS)"); // Set kolom F3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "CBM"); // Set kolom F3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        // $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        // $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        // $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

        $no = 0; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 3; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($result as $dtl) {
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
            // Ambil semua data dari hasil eksekusi $sql
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $dtl['id']);
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $dtl['product_name']);
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $dtl['specification']);

            // Khusus untuk no telepon. kita set type kolom nya jadi STRING
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('E' . $numrow, $dtl['qty'], PHPExcel_Cell_DataType::TYPE_STRING);

            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, $dtl['unit']);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, "");
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, "");
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, "");
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, "");
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, "");

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true); // Set width kolom F
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("imp_packing_list");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Packing-List' . $header->number . '.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write->save('php://output');
    }

    function importData()
    {
        $this->load->library('excel');
        $log_import     = [];
        $data           = [];

        if (isset($_FILES['uploadFile']['name'])) {
            $file_tmp = $_FILES['uploadFile']['tmp_name'];
            $file_name = $_FILES['uploadFile']['name'];
            $file_type = $_FILES['uploadFile']['type'];
            $config['allowed_types']        = 'xlsx|xls|csv';
            $log_import = [
                'file_name'     => "File name " . $file_name,
                'start'         => "Start Import",
            ];

            /* Import with Image */
            $obj                 = new PHPExcel_Reader_Excel2007;
            $objReader            = $obj->load($file_tmp);
            $objWorksheet         = $objReader->getActiveSheet();
            $objGetWorksheet     = $objReader->getSheetByName('imp_packing_list');
            if (!$objGetWorksheet) {
                $log_import['status']     = "Error!";
                $log_import['msg']         = "Worksheet name not valid!";
            } else {
                $dataArray = $objWorksheet->toArray();
                $row = 0;
                for ($i = 3; $i < count($dataArray); $i++) {
                    $row++;
                    $data[$row] = [
                        'id'                => $dataArray[$i]['1'],
                        'product_name'      => $dataArray[$i]['2'],
                        'specification'     => $dataArray[$i]['3'],
                        'qty'               => $dataArray[$i]['4'],
                        'unit'              => ($dataArray[$i]['5']),
                        'package'           => ($dataArray[$i]['6']),
                        'unit_package'      => ($dataArray[$i]['7']),
                        'nett_weight'       => ($dataArray[$i]['8']),
                        'gross_weight'      => ($dataArray[$i]['9']),
                        'cbm'               => ($dataArray[$i]['10']),
                    ];
                }

                $log_import['msg'] = "Data has been imported.";
                $log_import['count_data'] = "Total Data " . count($data);
                $log_import['status'] = "Successfull!";
            }

            echo json_encode([
                'log_import'    => $log_import,
                'data'          => $data
            ]);
        }
    }

    function getIDPL()
    {
        // INV-2309-001
        $ym = date('ym');
        $result = $this->db->select('MAX(RIGHT(id,3)) as id')->from('packing_lists')
            ->where('SUBSTR(id,5,4)', $ym)->get()->row();
        $count = 1;
        if ($result->id) {
            $count = $result->id + 1;
        }
        $newID = 'PLS-' . $ym . "-" . sprintf('%03d', $count);
        return $newID;
    }

    function savePackingList()
    {
        $post                   = $this->input->post();
        $data                   = $post;
        // $data['id']          = (isset($post['id']) && $post['id']) ? $post['id'] : $this->getIDPL();
        $data['flag_pl']        = 'Y';
        $data['third_party']            = isset($data['third_party']) ? $data['third_party'] : 'N';
        $data['trd_company_name']       = isset($data['trd_company_name']) ? $data['trd_company_name'] : null;
        $data['trd_company_address']    = isset($data['trd_company_address']) ? $data['trd_company_address']  : null;
        $data['qq']                     = isset($data['qq']) ? $data['qq'] : 'N';
        $data['qq_company_name']        = isset($data['qq_company_name']) ? $data['qq_company_name'] : null;
        $data['qq_company_address']     = isset($data['qq_company_address']) ? $data['qq_company_address']  : null;


        $detail                 = $data['detail'];
        unset($data['detail']);
        if ($detail) foreach ($detail as $k => $dtl) {
            $k++;
            $dataDetail[$k] = $dtl;
            // $dataDetail[$k]['id']                = ($data['id'] . "-" . sprintf("%03d", $k));
            $dataDetail[$k]['flag_bl']              = isset($dtl['flag_bl']) ? $dtl['flag_bl'] : 'N';
            $dataDetail[$k]['hide_qty']             = isset($dtl['hide_qty']) ? $dtl['hide_qty'] : 'N';
            $dataDetail[$k]['hide_spec']            = isset($dtl['hide_spec']) ? $dtl['hide_spec'] : 'N';
            $dataDetail[$k]['hide_nw']              = isset($dtl['hide_nw']) ? $dtl['hide_nw'] : 'N';
            $dataDetail[$k]['hide_gw']              = isset($dtl['hide_gw']) ? $dtl['hide_gw'] : 'N';
            $dataDetail[$k]['hide_fe']              = isset($dtl['hide_fe']) ? $dtl['hide_fe'] : 'N';
            // $dataDetail[$k]['created_by']        = $this->auth->user_id();
            // $dataDetail[$k]['created_at']        = date('Y-m-d H:i:s');
        }

        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $post['id']]);
        $this->db->update_batch('sales_order_details', $dataDetail, 'id');
        // if (isset($post['id']) && $post['id']) {
        // } else {
        //     $this->db->insert('packing_lists', $data);
        //     $this->db->insert_batch('packing_list_details', $dataDetail);
        // }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data Packing List, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data Packing List.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data Packing List.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function viewPackingList($id)
    {
        $data           = $this->db->get_where('sales_order', ['id' => $id])->row();
        $dataDetail     = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $data = [
            'data'          => $data,
            'dataDetail'    => $dataDetail,
        ];
        $this->template->set($data);
        $this->template->render('view-packing-list');
    }

    function printPackingList($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 35;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $header         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $suppliers      = $this->db->get_where('harbours', ['status' => '1'])->result();
        $comp           = $this->db->get_where('companies', ['id' => $header->company_id])->row();
        $mpdf->SetHTMLHeader('<h2 style="text-align:center;margin:0px">' . $header->supplier_name . '</h2>
        <p style="text-align:center;margin:0px" class="font">' . $header->supplier_address . '</p>
        ');


        $mpdf->AddPage('P', '', '', '', '', 0, 0, 20, 5, 5, 0);
        foreach ($this->currency as $curr) {
            $ArrCurr[$curr->code] = $curr;
        }

        $MGR = [];
        $n = 0;
        $x = 0;
        foreach ($details as $k => $dtl) {
            $x++;
            if ($dtl->package != 0) {
                $n++;
            }
            $MGR[$n][$x] = $dtl->package;
            if ($dtl->package == 0) {
            }
        }

        // echo '<pre>';
        // print_r($MGR);
        // echo '</pre>';
        // exit;

        $data = [
            'header'        => $header,
            'details'       => $details,
            'suppliers'     => $suppliers,
            'comp'          => $comp,
            'MGR'          => $MGR,
        ];

        $this->template->set($data);
        // $this->load->view('print-packing-list', $data);
        $html = $this->template->load_view('print-packing-list');
        $mpdf->WriteHTML($html);
        $name = $header->customer_name . " " . str_replace("/", "-", $header->invoice_number);
        $mpdf->Output($name, 'I');
    }


    /* BILL OF LADING */
    function createBillOfLading($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'flag_bl' => 'Y'])->result_array();
        $totalPkg       = $this->db->get_where('sales_order_details', ['so_id' => $id])->result_array();

        $totalPackage   = $totalGW = $totalCBM = 0;
        $arr            = array_column($totalPkg, 'package');
        $totalPackage   = array_sum($arr);
        $arrGW          = array_column($totalPkg, 'gross_weight');
        $totalGW        = array_sum($arrGW);
        $arrCBM         = array_column($totalPkg, 'cbm');
        $totalCBM       = array_sum($arrCBM);

        $containers     = $this->db->get_where('containers', ['status' => '1'])->result_array();
        $ArrContainer = array_column($containers, 'name', 'id');

        $data = [
            'dataSO'            => $dataSO,
            'details'           => $details,
            'totalPackage'      => $totalPackage,
            'totalGW'           => $totalGW,
            'totalCBM'          => $totalCBM,
            'ArrContainer'      => $ArrContainer,
        ];
        $this->template->set($data);
        $this->template->render('create-bill-of-lading');
    }

    function getIDBL()
    {
        // BL-2309-001
        $ym = date('ym');
        $result = $this->db->select('MAX(RIGHT(id,3)) as id')->from('bill_of_lading')
            ->where('SUBSTR(id,4,4)', $ym)->get()->row();
        $count = 1;
        if ($result->id) {
            $count = $result->id + 1;
        }
        $newID = 'BL-' . $ym . "-" . sprintf('%03d', $count);
        return $newID;
    }

    function saveBillOfLading()
    {
        $post           = $this->input->post();
        $data           = $post;
        // $data['id']     = isset($post['id']) ? $post['id'] : $this->getIdBL();
        $data['flag_bl'] = 'Y';


        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $post['id']]);
        // if (isset($post['id']) && $post['id']) {
        //     $data['modified_by'] = $this->auth->user_id();
        //     $data['modified_at'] = date('Y-m-d H:i:s');
        // } else {
        //     $data['created_by'] = $this->auth->user_id();
        //     $data['created_at'] = date('Y-m-d H:i:s');
        //     $this->db->insert('bill_of_lading', $data);
        // }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data Bill of Lading, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data Bill Of Lading.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data Bill of Lading.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function viewBillOfLading($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'flag_bl' => 'Y'])->result_array();
        $totalPkg       = $this->db->get_where('sales_order_details', ['so_id' => $id])->result_array();

        $totalPackage   = $totalGW = $totalCBM = 0;
        $arr            = array_column($totalPkg, 'package');
        $totalPackage   = array_sum($arr);
        $arrGW          = array_column($totalPkg, 'gross_weight');
        $totalGW        = array_sum($arrGW);
        $arrCBM         = array_column($totalPkg, 'cbm');
        $totalCBM       = array_sum($arrCBM);

        $containers     = $this->db->get_where('containers', ['status' => '1'])->result_array();
        $ArrContainer = array_column($containers, 'name', 'id');

        $data = [
            'dataSO'            => $dataSO,
            'details'           => $details,
            'totalPackage'      => $totalPackage,
            'totalGW'           => $totalGW,
            'totalCBM'          => $totalCBM,
            'ArrContainer'      => $ArrContainer,
        ];

        $this->template->set($data);
        $this->template->render('view-bill-of-lading');
    }

    function editBillOfLading($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'flag_bl' => 'Y'])->result_array();
        $totalPkg       = $this->db->get_where('sales_order_details', ['so_id' => $id])->result_array();

        $totalPackage   = $totalGW = $totalCBM = 0;
        $arr            = array_column($totalPkg, 'package');
        $totalPackage   = array_sum($arr);
        $arrGW          = array_column($totalPkg, 'gross_weight');
        $totalGW        = array_sum($arrGW);
        $arrCBM         = array_column($totalPkg, 'cbm');
        $totalCBM       = array_sum($arrCBM);

        $containers     = $this->db->get_where('containers', ['status' => '1'])->result_array();
        $ArrContainer = array_column($containers, 'name', 'id');

        $data = [
            'dataSO'            => $dataSO,
            'details'           => $details,
            'totalPackage'      => $totalPackage,
            'totalGW'           => $totalGW,
            'totalCBM'          => $totalCBM,
            'ArrContainer'      => $ArrContainer,
        ];

        $this->template->set($data);
        $this->template->render('edit-bill-of-lading');
    }

    function deleteBL()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $data = [
                'flag_bl'             => 'N',
                'notify_address'      => null,
                'reference'           => null,
                'vessel'              => null,
                'port_of_loading'     => null,
                'port_of_discharge'   => null,
                'shipping_mark'       => null,
                'weight'              => null,
                'volume'              => null,
                'place_and_date'      => null,
            ];

            $this->db->update('sales_order', $data, ['id' => $id]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = [
                    'msg'       => 'FAILED Delete data Bill of Lading, Please try again. ',
                    'status'    => 0,
                ];
                $keterangan     = "FAILD";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            } else {
                $this->db->trans_commit();
                $return = [
                    'msg'       => 'SUCCESS Delete data Bill of Lading.',
                    'status'    => 1,
                ];
                $keterangan     = "SUCCESS";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            }
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
            $return = [
                'msg'       => 'Not action processed.',
                'status'    => 0,
            ];
            $keterangan     = "Not Action";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = '';
            $jumlah         = 1;
            $sql            = "";
            $this->session->set_flashdata('msg', 'Success Deleted data Bill of Lading.');
        }

        echo json_encode($return);
    }

    function printbl($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 35;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $dataSO = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'flag_bl' => 'Y'])->result_array();
        $totalPkg       = $this->db->get_where('sales_order_details', ['so_id' => $id])->result_array();

        $totalPackage   = $totalGW = $totalCBM = 0;
        $arr            = array_column($totalPkg, 'package');
        $totalPackage   = array_sum($arr);
        $arrGW          = array_column($totalPkg, 'gross_weight');
        $totalGW        = array_sum($arrGW);
        $arrCBM         = array_column($totalPkg, 'cbm');
        $totalCBM       = array_sum($arrCBM);

        $containers     = $this->db->get_where('containers', ['status' => '1'])->result_array();
        $ArrContainer = array_column($containers, 'name', 'id');

        $mpdf->AddPage('P', '', '', '', '', 10, 10, 10, 5, 5, 0);

        $data = [
            'data'            => $dataSO,
            'details'           => $details,
            'totalPackage'      => $totalPackage,
            'totalGW'           => $totalGW,
            'totalCBM'          => $totalCBM,
            'ArrContainer'      => $ArrContainer,
        ];

        $this->template->set($data);
        $html = $this->template->load_view('print-bill-of-lading');
        $mpdf->WriteHTML($html);
        $name = $dataSO->customer_name . " " . str_replace("/", "-", $dataSO->invoice_number);
        $mpdf->Output($name, 'I');
    }


    /* FORM E */
    function createFE($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'hide_fe' => 'N'])->result();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
        ];
        $this->template->set($data);
        $this->template->render('create-fe');
    }

    function getIdFE()
    {
        // FE-2309-001
        $ym = date('ym');
        $result = $this->db->select('MAX(RIGHT(id,3)) as id')->from('form_e')
            ->where('SUBSTR(id,4,4)', $ym)->get()->row();
        $count = 1;
        if ($result->id) {
            $count = $result->id + 1;
        }
        $newID = 'FE-' . $ym . "-" . sprintf('%03d', $count);
        return $newID;
    }

    function saveFormE()
    {
        $post                   = $this->input->post();
        $data                   = $post;
        $details                = $data['details'];
        $data['flag_fe']        = 'Y';
        $data['departure_date'] = ($data['departure_date']) ?: null;

        unset($data['details']);
        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $data['id']]);
        if ($details) {
            $this->db->update_batch('sales_order_details', $details, 'id');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data Form E, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data Form E.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data Form E.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function editFormE($id)
    {
        $data     = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'hide_fe' => 'N'])->result();


        $data = [
            'data'    => $data,
            'details'   => $details,
        ];

        $this->template->set($data);
        $this->template->render('edit-fe');
    }

    function viewFormE($id)
    {
        $data     = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'hide_fe' => 'N'])->result();

        $data = [
            'data'    => $data,
            'details'   => $details,
        ];

        $this->template->set($data);
        $this->template->render('view-fe');
    }

    function deleteFE()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $data = [
                'total_text'      => null,
                'departure_date'  => null,
                'import_by'       => null,
                'exporter'        => null,
                'importing'       => null,
                'signature'       => null,
                'manufacturer'    => null,
                'flag_fe'         => 'N',

            ];
            $this->db->update('sales_order', $data, ['id' => $id]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = [
                    'msg'       => 'FAILED Delete data Form E, Please try again. ',
                    'status'    => 0,
                ];
                $keterangan     = "FAILD";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            } else {
                $this->db->trans_commit();
                $return = [
                    'msg'       => 'SUCCESS Delete data Form E.',
                    'status'    => 1,
                ];
                $keterangan     = "SUCCESS";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
                $this->session->set_flashdata('msg', 'Success Deleted data Form E.');
            }
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
            $return = [
                'msg'       => 'Not action processed.',
                'status'    => 0,
            ];
            $keterangan     = "Not Action";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = '';
            $jumlah         = 1;
            $sql            = "";
        }

        echo json_encode($return);
    }

    function printfe($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 35;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id, 'hide_fe' => 'N'])->result();
        $mpdf->AddPage('P', '', '', '', '', 10, 10, 10, 5, 5, 0);

        $data = [
            'data'    => $dataSO,
            'details'   => $details,
        ];

        $this->template->set($data);
        $html = $this->template->load_view('print-fe');
        $mpdf->WriteHTML($html);
        $name = $dataSO->customer_name . " " . str_replace("/", "-", $dataSO->invoice_number);
        $mpdf->Output($name, 'I');
    }


    /* PO */

    function createPO($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol = $this->db->get('currency')->result_array();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];
        $this->template->set($data);
        $this->template->render('create-po');
    }

    function savePO()
    {
        $post           = $this->input->post();
        $data           = $post;
        $data['flag_po'] = 'Y';

        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $data['id']]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data PO, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data PO.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data PO.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function editPO($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol = $this->db->get('currency')->result_array();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];
        $this->template->set($data);
        $this->template->render('edit-po');
    }

    function viewPO($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol = $this->db->get('currency')->result_array();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];
        $this->template->set($data);
        $this->template->render('view-po');
    }

    function deletePO()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $data = [
                'attention'      => null,
                'po_number'  => null,
                'po_date'       => null,
                'approve_by'        => null,
                'flag_po'         => 'N',

            ];
            $this->db->update('sales_order', $data, ['id' => $id]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = [
                    'msg'       => 'FAILED Delete data PO, Please try again. ',
                    'status'    => 0,
                ];
                $keterangan     = "FAILD";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            } else {
                $this->db->trans_commit();
                $return = [
                    'msg'       => 'SUCCESS Delete data PO.',
                    'status'    => 1,
                ];
                $keterangan     = "SUCCESS";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
                $this->session->set_flashdata('msg', 'Success Deleted data PO.');
            }
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
            $return = [
                'msg'       => 'Not action processed.',
                'status'    => 0,
            ];
            $keterangan     = "Not Action";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = '';
            $jumlah         = 1;
            $sql            = "";
        }

        echo json_encode($return);
    }

    function printpo($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 40;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol         = $this->db->get('currency')->result_array();
        $company = $this->db->get_where('companies', ['id' => $dataSO->company_id])->row();
        $hMgn = ($company->header_margin) ?: $hMargin;
        if ($company->header) {
            $mpdf->SetHTMLHeader('<html><div><img src="' . base_url('assets/img/letter-head/') . $company->header . '" width="100%"></div></html>', 'O', true);
        }
        $mpdf->AddPage('P', '', '', '', '', 10, 10, $hMgn, 5, 5, 0);
        $data = [
            'data'    => $dataSO,
            'details'   => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];

        $this->template->set($data);
        $html = $this->template->load_view('print-po');
        $mpdf->WriteHTML($html);
        $name = $dataSO->supplier_name . " " . str_replace("/", "-", $dataSO->po_number);
        $mpdf->Output($name, 'I');
    }



    /* SC */

    function createSC($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol         = $this->db->get('currency')->result_array();
        $company        = $this->db->get_where('companies', ['id' => $dataSO->company_id])->row();
        $supplier       = $this->db->get_where('suppliers', ['id' => $dataSO->supplier_id])->row();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column($symbol, 'symbol', 'code'),
            'company'       => $company,
            'supplier'      => $supplier
        ];

        $this->template->set($data);
        $this->template->render('create-sc');
    }

    function saveSC()
    {
        $post               = $this->input->post();
        $data               = $post;
        $data['flag_sc']    = 'Y';
        $data['signed_at']  = (isset($data['signed_at']) && $data['signed_at']) ? $data['signed_at'] : null;

        $this->db->trans_begin();
        $this->db->update('sales_order', $data, ['id' => $data['id']]);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = [
                'msg'       => 'FAILED save data PO, Please try again. ',
                'status'    => 0,
            ];
            $keterangan     = "FAILD";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
        } else {
            $this->db->trans_commit();
            $return = [
                'msg'       => 'SUCCESS created data SC.',
                'status'    => 1,
            ];
            $keterangan     = "SUCCESS";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = $data['id'];
            $jumlah         = 1;
            $sql            = $this->db->last_query();
            $this->session->set_flashdata('msg', 'Success Save data SC.');
        }
        simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        echo json_encode($return);
    }

    function editSC($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol = $this->db->get('currency')->result_array();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];
        $this->template->set($data);
        $this->template->render('edit-sc');
    }

    function viewSC($id)
    {
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol = $this->db->get('currency')->result_array();

        $data = [
            'dataSO'        => $dataSO,
            'details'       => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];
        $this->template->set($data);
        $this->template->render('view-sc');
    }

    function deleteSC()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $data = [
                'sc_number'      => null,
                'sc_date'        => null,
                'signed_at'      => null,
                'flag_sc'        => 'N',

            ];
            $this->db->update('sales_order', $data, ['id' => $id]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = [
                    'msg'       => 'FAILED Delete data SC, Please try again. ',
                    'status'    => 0,
                ];
                $keterangan     = "FAILD";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            } else {
                $this->db->trans_commit();
                $return = [
                    'msg'       => 'SUCCESS Delete data SC.',
                    'status'    => 1,
                ];
                $keterangan     = "SUCCESS";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
                $this->session->set_flashdata('msg', 'Success Deleted data SC.');
            }
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
            $return = [
                'msg'       => 'Not action processed.',
                'status'    => 0,
            ];
            $keterangan     = "Not Action";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = '';
            $jumlah         = 1;
            $sql            = "";
        }

        echo json_encode($return);
    }

    function printsc($id)
    {
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs   = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        $hMargin = 40;
        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [__DIR__]),
            'fontdata' => $fontData +
                [
                    'Sun-ExtA' => [
                        'R' => 'assets/fonts/Sun-ExtA.ttf',
                    ],
                    'Sun-ExtB' => [
                        'R' => 'assets/fonts/Sun-ExtB.ttf',
                    ],
                ],
            'mode' => 'utf-8',
            'format' => [210, 297],
            // 'setAutoTopMargin' => 'stretch',
            // 'autoMarginPadding' => 50
        ]);

        // $mpdf = new \Mpdf\Mpdf();
        $dataSO         = $this->db->get_where('sales_order', ['id' => $id])->row();
        $details        = $this->db->get_where('sales_order_details', ['so_id' => $id])->result();
        $symbol         = $this->db->get('currency')->result_array();

        $mpdf->AddPage('P', '', '', '', '', 10, 10, 5, 5, 5, 0);
        $data = [
            'data'    => $dataSO,
            'details'   => $details,
            'symbol'        => array_column(
                $symbol,
                'symbol',
                'code'
            ),
        ];

        $this->template->set($data);
        $html = $this->template->load_view('print-sc');
        $mpdf->WriteHTML($html);
        $name = $dataSO->supplier_name . " " . str_replace("/", "-", $dataSO->po_number);
        $mpdf->Output($name, 'I');
    }


    /* Release SO */

    function releaseSO()
    {
        $id = $this->input->post('id');
        if ($id) {
            $this->db->trans_begin();
            $data = [
                'flag_release'    => 'Y',
                'release_date'    => date('Y-m-d H:i:s'),
                'release_by'      => $this->auth->user_id(),
            ];
            $this->db->update('sales_order', $data, ['id' => $id]);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = [
                    'msg'       => 'FAILED Release this SO, Please try again. ',
                    'status'    => 0,
                ];
                $keterangan     = "FAILED";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
            } else {
                $this->db->trans_commit();
                $return = [
                    'msg'       => 'SUCCESS Release this SO.',
                    'status'    => 1,
                ];
                $keterangan     = "SUCCESS";
                $status         = 1;
                $nm_hak_akses   = $this->addPermission;
                $kode_universal = $id;
                $jumlah         = 1;
                $sql            = $this->db->last_query();
                $this->session->set_flashdata('msg', 'Success Release this SO.');
            }
            simpan_aktifitas($nm_hak_akses, $kode_universal, $keterangan, $jumlah, $sql, $status);
        } else {
            $return = [
                'msg'       => 'Not action processed.',
                'status'    => 0,
            ];
            $keterangan     = "Not Action";
            $status         = 1;
            $nm_hak_akses   = $this->addPermission;
            $kode_universal = '';
            $jumlah         = 1;
            $sql            = "";
        }

        echo json_encode($return);
    }
}