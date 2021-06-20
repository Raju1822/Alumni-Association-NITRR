<?php 

/**
* 
*/
class Model_giving_back extends CI_Model
{
	public function get_all_branches()
	{
		return $this->db->select('BranchId, Branch')->get('branch')->result();
	}

	public function add_pending_donation($data)
	{

		if($this->db->insert('pending_donations', $data)){
			return 1;
		}else{
			return 0;
		}
	}
	
	public function delete_pending_donation($txn_id)
	{	
		$this->db->where('transaction_id', $txn_id);
		if($this->db->delete('pending_donations')){
			return 1;
		}else{
			return 0;
		}
	}

	public function add_completed_donation($data)
	{
		if($this->db->insert('completed_donations', $data)){
			return 1;
		}else{
			return 0;
		}
	}

	public function add_unsuccessful_donation($data)
	{

		if($this->db->insert('unsuccessful_donations', $data)){
			return 1;
		}else{
			return 0;
		}
	}

	public function get_new_user_id(){
		return $this->db->select('user_id')->order_by('user_id','desc')->limit(1)->get('pending_donations')->row('user_id');
	}
	public function get_txn_id()
	{
		$pending = $this->db->select('transaction_id')->order_by('transaction_id','desc')->limit(1)->get('pending_donations')->row('transaction_id');
		$completed = $this->db->select('transaction_id')->order_by('transaction_id','desc')->limit(1)->get('completed_donations')->row('transaction_id');
		$unsuccessful = $this->db->select('transaction_id')->order_by('transaction_id','desc')->limit(1)->get('unsuccessful_donations')->row('transaction_id');
		if (floatval($pending) > floatval($completed)) {
			if (floatval($pending) > floatval($unsuccessful)) {
				return $pending;
			}else{
				return $unsuccessful;
			}
		}else{
			if (floatval($completed) > floatval($unsuccessful)) {
				return $completed;
			}else{
				return $unsuccessful;
			}
		}
	}

	private function bigintval($value) {
	  $value = trim($value);
	  if (ctype_digit($value)) {
	    return $value;
	  }
	  $value = preg_replace("/[^0-9](.*)$/", '', $value);
	  if (ctype_digit($value)) {
	    return $value;
	  }
	  return 0;
	}

	// Generates total donations recieved in rupees.
	public function get_total_donations()
	{
		return $this->db->select_sum('amount')->get('completed_donations')->result();
	}

	// Gives the list of completed donations
	public function get_succesful_donations()
	{
		return $this->db->select('*')->get('completed_donations')->result();
	}

	public function get_transaction($transaction_id, $security_token)
	{
		return $this->db->select('*')->where('transaction_id', $transaction_id)->where('hash', $security_token)->get('completed_donations')->result()[0];
		
	}
}