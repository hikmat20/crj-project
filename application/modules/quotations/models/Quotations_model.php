<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Hikmat A.R
 * @copyright Copyright (c) 2023, Hikmat A.R
 *
 * This is model class for table "Quotations"
 */

class Quotations_model extends BF_Model
{

    /**
     * @var string  User Table Name
     */
    protected $table_name = 'quotations';
    protected $key        = 'id';

    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'created_at';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'modified_at';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = true;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = true;
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = true;

    protected $date_format = 'datetime';

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = true;

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }


    function generate_id($kode = '')
    {
        $y = date('y');
        $count = 1;
        $maxID = $this->db->select("MAX(RIGHT(id,5)) as id")->from('check_hscodes')->where(['SUBSTR(id,3,2)' => date('y')])->get()->row()->id;
        if ($maxID || $maxID > 0) {
            $count = $maxID + 1;
        }
        $newID = "CH$y" . "-" . str_pad($count, 5, "0", STR_PAD_LEFT);
        return $newID;
    }

    function generateIdQuotation($kode = '')
    {
        // QU23-CSJ-00001
        $y = date('y');
        $count = 1;
        $maxID = $this->db->select("MAX(RIGHT(id,5)) as id")->from('quotations')->where(['SUBSTR(id,3,2)' => date('y')])->get()->row()->id;
        if ($maxID || $maxID > 0) {
            $count = $maxID + 1;
        }
        $newID = "QU$y" . "-CSJ-" . str_pad($count, 5, "0", STR_PAD_LEFT);
        return $newID;
    }

    function generate_number($kode = '')
    {
        $y = date('y');
        $count = 1;
        $maxID = $this->db->select("MAX(LEFT(number,5)) as number")->from('check_hscodes')->where(['RIGHT(number,2)' => date('y')])->get()->row()->number;
        if ($maxID || $maxID > 0) {
            $count = $maxID + 1;
        }
        $m = date('m');
        $newID = sprintf("%05d", $count) . "/CHS/$m/$y";
        return $newID;
    }

    function generateQuotNumber($kode = '')
    {
        $y = date('y');
        $count = 1;
        $maxID = $this->db->select("MAX(LEFT(number,5)) as number")->from('quotations')->where(['RIGHT(number,2)' => date('y')])->get()->row()->number;
        if ($maxID || $maxID > 0) {
            $count = $maxID + 1;
        }
        $m = date('m');
        $newID = sprintf("%05d", $count) . "/QTT/$m/$y";
        return $newID;
    }

    function getDetailId($checkID)
    {
        $maxID = $this->db->select("MAX(RIGHT(id,4)) as id")->from('check_hscode_detail')->where(['check_hscode_id' => $checkID])->get()->row()->id;
        $newId =  ($maxID) ? intval($maxID) : 0;
        return $newId;
    }

    public function get_data($table, $where_field = '', $where_value = '')
    {
        if ($where_field != '' && $where_value != '') {
            $query = $this->db->get_where($table, array($where_field => $where_value));
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }

    /* DEAL */

    function getSOID()
    {
        // SO2309-001
        $ym = date('ym');
        $result = $this->db->select("MAX(RIGHT(id,3)) as id")->from('sales_order')
            ->where(['SUBSTR(id,3,4) =' => $ym])->get()->row();
        $count = 1;
        if ($result->id) {
            $count = $result->id + 1;
        }

        $newID = "SO$ym-" . sprintf("%03d", $count);
        return $newID;
    }

    function getSONumber()
    {
        // 0001/SO/09/2023
        $Y = date('Y');
        $m = date('m');
        $result = $this->db->select("MAX(LEFT(number,4)) as number")->from('sales_order')
            ->where(['SUBSTR(number,9,2) =' => $m, 'RIGHT(number,4) =' => $Y])->get()->row();
        $count = 1;
        if ($result->number) {
            $count = $result->number + 1;
        }
        $newID = sprintf("%04d", $count) . "/SO/" . $m . '/' . $Y;

        return $newID;
    }

    function getSOProcess()
    {
        $post = $this->input->post();
        $this->db->trans_begin();
        $this->db->update("quotations", ['status' => 'DEAL'], ['id' => $post['quotation_id']]);
        simpan_aktifitas('1', $post['quotation_id'], 'Update quotation to deal', '1', $this->db->last_query(), '1');


        /* header SO */
        $result = $this->db->get_where('quotations', ['id' => $post['quotation_id']])->row();
        $dataSO = [
            'id'                             => $this->getSOID(),
            'quotation_id'                   => $post['quotation_id'],
            'number'                         => $this->getSONumber(),
            'date'                           => date('Y-m-d'),
            'currency'                       => $result->currency,
            'description'                    => $result->description,
            'exchange'                       => $result->exchange,
            'customer_id'                    => $result->customer_id,
            'origin_country_id'              => $result->origin_country_id,
            'project_name'                   => $result->project_name,
            'marketing_id'                   => $result->marketing_id,
            'company_id'                     => $result->company_id,
            'port_loading'                   => $result->port_loading,
            'port_discharge'                 => $result->port_discharge,
            'dest_city'                      => $result->dest_city,
            'trucking_id'                    => $result->trucking_id,
            'dest_area'                      => $result->dest_area,
            'price_type'                     => $result->price_type,
            'fee_type'                       => $result->fee_type,
            'service_type'                   => $result->service_type,
            'container_id'                   => $result->container_id,
            'ls_type'                        => $result->ls_type,
            'qty_container'                  => $result->qty_container,
            'qty_ls_container'               => $result->qty_ls_container,
            'fee_lartas_type'                => $result->fee_lartas_type,
            'fee_lartas'                     => $result->fee_lartas,
            'fee'                            => $result->fee,
            'fee_value'                      => $result->fee_value,
            'fee_customer_id'                => $result->fee_customer_id,
            'fee_customer'                   => $result->fee_customer,
            'stacking_days'                  => $result->stacking_days,
            'storage'                        => $result->storage,
            'total_product'                  => $result->total_product,
            'total_fee_lartas'               => $result->total_fee_lartas,
            'subtotal'                       => $result->subtotal,
            'discount_value'                 => $result->discount_value,
            'tax'                            => $result->tax,
            'total_tax'                      => $result->total_tax,
            'total_bm'                       => $result->total_bm,
            'total_pph'                      => $result->total_pph,
            'grand_total'                    => $result->grand_total,
            'grand_total_exclude_price'      => $result->grand_total_exclude_price,
            'so_type'                        => $post['so_type'],
            'created_by'                     => $this->auth->user_id(),
            'created_at'                     => date('Y-m-d H:i:s'),
            'total_costing'                  => $result->total_costing,
            'total_costing_foreign_currency' => $result->total_costing_foreign_currency
        ];

        $this->db->insert('sales_order', $dataSO);
        simpan_aktifitas('', $dataSO['id'], 'Insert Sales Order', '1', $this->db->last_query(), '1');


        /* Detail SO */
        $resultDtl      = $this->db->get_where('quotation_details', ['quotation_id' => $post['quotation_id']])->result();
        if ($resultDtl) foreach ($resultDtl as $k => $dtl) {
            $k++;
            $dataSODtl[$k] = [
                'id'                => $dataSO['id'] . "-" . sprintf("%04d", $k),
                'so_id'             => $dataSO['id'],
                'product_name'      => $dtl->product_name,
                'specification'     => $dtl->specification,
                'origin_hscode'     => $dtl->origin_hscode,
                'local_hscode'      => $dtl->local_hscode,
                'remarks'           => $dtl->remarks,
                'lartas'            => $dtl->lartas,
                'qty'               => $dtl->qty,
                'unit'              => $dtl->unit,
                'unit_price'        => $dtl->unit_price,
                'bm_type'           => $dtl->bm_type,
                'bm_value'          => $dtl->bm_value,
                'pph_api'           => $dtl->pph_api,
                'total_price'       => $dtl->price,
                'total_bm'          => $dtl->total_bm,
                'total_pph'         => $dtl->total_pph,
                'image'             => $dtl->image,
                'created_at'        => date('Y-m-d H:i:s'),
                'created_by'        => $this->auth->user_id(),
            ];
        }

        $this->db->insert_batch('sales_order_details', $dataSODtl);
        simpan_aktifitas('', $dataSO['id'], 'Insert Sales Order Detail', '1', $this->db->last_query(), '1');


        /* Costing */
        $resultCosting      = $this->db->get_where('quotation_detail_costing', ['quotation_id' => $post['quotation_id']])->result();
        if ($resultCosting) foreach ($resultCosting as $k => $cost) {
            $k++;
            $dataSOCosting[$k] = [
                'id'                      => $dataSO['id'] . "-" . sprintf("%02d", $k),
                'so_id'                   => $dataSO['id'],
                "name"                    => $cost->name,
                "currency"                => $cost->currency,
                "exchange"                => $cost->exchange,
                "price"                   => $cost->price,
                "total"                   => $cost->total,
                "total_foreign_currency"  => $cost->total_foreign_currency,
                'created_at'              => date('Y-m-d H:i:s'),
                'created_by'              => $this->auth->user_id(),
            ];
        }

        $this->db->insert_batch('sales_order_costing', $dataSOCosting);
        simpan_aktifitas('', $dataSO['id'], 'Insert Sales Order Costing', '1', $this->db->last_query(), '1');


        /* Payment Term */
        $resultPayTerm      = $this->db->get_where('quotation_payment_term', ['quotation_id' => $post['quotation_id']])->result();

        if ($resultPayTerm) foreach ($resultPayTerm as $k => $term) {
            $k++;
            $dataSOPayTerm[$k] = [
                'id'                  => $dataSO['id'] . "-" . sprintf("%02d", $k),
                'so_id'               => $dataSO['id'],
                "name"                => $term->name,
                "percentage"          => $term->percentage,
                "amount"              => $term->amount,
                "last_update"         => $term->last_update,
                "description"         => $term->description,
            ];
        }

        $this->db->insert_batch('sales_order_pay_term', $dataSOPayTerm);
        simpan_aktifitas('', $dataSO['id'], 'Insert Sales Order Costing', '1', $this->db->last_query(), '1');

        /* Lartas */
        $resultLartas      = $this->db->get_where('quotation_detail_lartas', ['quotation_id' => $post['quotation_id']])->result();

        if ($resultLartas) foreach ($resultLartas as $k => $lts) {
            $k++;
            $dataSOLartas[$k] = [
                'id'                        => $dataSO['id'] . "-" . sprintf("%02d", $k),
                'so_id'                     => $dataSO['id'],
                "name"                      => $lts->name,
                "lartas_id"                 => $lts->lartas_id,
                "qty"                       => $lts->qty,
                "unit"                      => $lts->unit,
                "price"                     => $lts->price,
                "total"                     => $lts->total,
                "total_foreign_currency"    => $lts->total_foreign_currency,
                "created_at"                => date('Y-m-d H:i:s'),
                "created_by"                => $this->auth->user_id(),
            ];
        }

        $this->db->insert_batch('sales_order_lartas', $dataSOLartas);
        simpan_aktifitas('', $dataSO['id'], 'Insert Sales Order Lartas', '1', $this->db->last_query(), '1');
    }
}
