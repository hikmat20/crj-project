<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Yunas Handra
 * @copyright Copyright (c) 2018, Yunas Handra
 *
 * This is model class for table "Customer"
 */

class Requests_model extends BF_Model
{

    /**
     * @var string  User Table Name
     */
    protected $table_name = 'requests';
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
        $maxID = $this->db->select("MAX(LEFT(number,5)) as number")
            ->from('check_hscodes')
            ->where(['RIGHT(number,2)' => date('y')])
            ->get()->row()->number;
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
        $m = date('m');
        $count = 1;
        $maxID = $this->db->select("MAX(LEFT(number,5)) as number")
            ->from('quotations')
            ->where(["SUBSTR(RIGHT(number, 5), 1, 2) =" => date('m')])
            ->get()->row()->number;
        // SUBSTR(RIGHT(number, 5), 1, 2) = MONTH("2023-09-10")
        if ($maxID || $maxID > 0) {
            $count = $maxID + 1;
        }
        $newID = sprintf("%05d", $count) . "/QTT/$m/$y";
        return $newID;
    }

    function getDetailId($checkID)
    {
        $maxID = $this->db->select("MAX(RIGHT(id,4)) as id")->from('check_hscode_detail')->where(['check_hscode_id' => $checkID])->get()->row()->id;
        $newId =  ($maxID) ? intval($maxID) : 0;
        return $newId;
    }
    function getDetailQuotId($checkID)
    {
        $maxID = $this->db->select("MAX(RIGHT(id,4)) as id")->from('quotation_details')->where(['quotation_id' => $checkID])->get()->row()->id;
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
}
