<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Affilation_model extends CI_Model
{

    public $table = 'affilation';
    public $id = 'affilation_id';
    public $order = 'DESC';

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
        $this->db->like('affilation_id', $q);
	$this->db->or_like('description', $q);
	$this->db->or_like('photo', $q);
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

/* End of file Affilation_model.php */
/* Location: ./application/models/Affilation_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-02-06 01:16:08 */
/* http://harviacode.com */