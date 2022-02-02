<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Official_receipt_model extends CI_Model
{

	public $table = 'official_receipt';
	public $id = 'or_id';
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
	function total_rows($q = NULL)
	{
		$this->db->like('or_id', $q);
		$this->db->or_like('or_no', $q);
		$this->db->or_like('file_id', $q);
		$this->db->or_like('or_date', $q);
		$this->db->or_like('insurer_id', $q);
		$this->db->or_like('currency_id', $q);
		$this->db->or_like('total_fee', $q);
		$this->db->or_like('expense', $q);
		$this->db->or_like('description', $q);
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

	function get_no()
	{
		$q = $this->db->query("SELECT MAX(LEFT(or_no,4)) AS kd_max FROM official_receipt WHERE YEAR(create_date)=YEAR(CURDATE())");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%04s", $tmp);
			}
		} else {
			$kd = "0001";
		}
		date_default_timezone_set('Asia/Jakarta');

		$cek = date('m');
		if ($cek == '01') {
			$bulan = 'I';
		} else if ($cek == '02') {
			$bulan = 'II';
		} else if ($cek == '03') {
			$bulan = 'III';
		} else if ($cek == '04') {
			$bulan = 'IV';
		} else if ($cek == '05') {
			$bulan = 'V';
		} else if ($cek == '06') {
			$bulan = 'VI';
		} else if ($cek == '07') {
			$bulan = 'VII';
		} else if ($cek == '08') {
			$bulan = 'VIII';
		} else if ($cek == '09') {
			$bulan = 'IX';
		} else if ($cek == '10') {
			$bulan = 'X';
		} else if ($cek == '11') {
			$bulan = 'XI';
		} else if ($cek == '12') {
			$bulan = 'XII';
		}

		return $kd . '/JN-' . $bulan . '/' . date('y');
	}
}
