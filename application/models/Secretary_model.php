<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secretary_model extends CI_Model
{

    public $table = 'secretary';
    public $id = 'secretary_code';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('secretary_id', $q);
	$this->db->or_like('secretary_code', $q);
	$this->db->or_like('secretary_name', $q);
	$this->db->or_like('secretary_address', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Secretary_model.php */
/* Location: ./application/models/Secretary_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-26 14:52:59 */
/* http://harviacode.com */
