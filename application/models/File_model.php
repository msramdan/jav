<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class File_model extends CI_Model
{

	public $table = 'file';
	public $id = 'file_id';
	public $order = 'DESC';

	function __construct()
	{
		parent::__construct();
	}

	// get all
	function get_all($start_date = null, $end_date = null, $status = null, $insurer_id = null)
	{
		$this->db->join('adjuster', 'adjuster.adjuster_id = file.adjuster_id', 'left');
		$this->db->join('trade', 'trade.trade_id = file.trade_id', 'left');
		$this->db->join('broker', 'broker.broker_id = file.broker_id', 'left');
		$this->db->join('user', 'user.user_id = file.user_id', 'left');
		$this->db->join('type_of_loss', 'type_of_loss.type_of_loss_id = file.type_of_loss_id', 'left');
		if ($start_date != null) {
			$this->db->where('create_date >=', $start_date);
		}

		if ($end_date != null) {
			$this->db->where('create_date <=', $end_date);
		}
		if ($status != null) {
			if ($status == 'Outstanding') {
				$cek = $this->db->query("SELECT * FROM remark where status_case='Outstanding'");
				foreach ($cek->result() as $row) {
					$list[] = $row->remark_id ;
				}
				$this->db->where_in('remark_id',$list);

			} else if ($status == 'Receiving') {
				$cek = $this->db->query("SELECT * FROM remark where status_case='Receiving'");
				foreach ($cek->result() as $row) {
					$list[] = $row->remark_id ;
				}
				$this->db->where_in('remark_id',$list);
			}
		}

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
		$this->db->like('file_id', $q);
		$this->db->or_like('ref_no', $q);
		$this->db->or_like('date_of_receive', $q);
		$this->db->or_like('adjuster_id', $q);
		$this->db->or_like('trade_id', $q);
		$this->db->or_like('type_of_loss_id', $q);
		$this->db->or_like('detail_dol', $q);
		$this->db->or_like('date_of_loss', $q);
		$this->db->or_like('date_of_survey', $q);
		$this->db->or_like('policy_number', $q);
		$this->db->or_like('situation_of_loss', $q);
		$this->db->or_like('insurer_ref_no', $q);
		$this->db->or_like('insured', $q);
		$this->db->or_like('broker_id', $q);
		$this->db->or_like('remark_id', $q);
		$this->db->or_like('user_id', $q);
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

	function get_ref_no()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(ref_no,3)) AS kd_max FROM file WHERE MONTH(create_date)=MONTH(CURDATE())");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%03s", $tmp);
			}
		} else {
			$kd = "001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('Ym-') . $kd;
	}
}
