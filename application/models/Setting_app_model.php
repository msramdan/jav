<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_app_model extends CI_Model
{

    public $table = 'setting_app';
    public $id = 'app_setting_id';
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
        $this->db->like('app_setting_id', $q);
	$this->db->or_like('nama_aplikasi', $q);
	$this->db->or_like('nama_perusahaan', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('website', $q);
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

/* End of file Setting_app_model.php */
/* Location: ./application/models/Setting_app_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-01-20 15:43:36 */
/* http://harviacode.com */
