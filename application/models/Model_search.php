<?php 

/**
* 
*/
class Model_search extends CI_Model
{
	public function get_search(){
		$match = $this->input->post('search');
		$this->db->like('name',$match);
		$this->db->or_like('email',$match);
		$query = $this->db->get('personal_detail');
		if ($query->result()) {
			return $query->result();		
		}else{
			return 0;
		}
	}
	
	public function get_total_pages($total_items,$perpage )
	{
		if ($total_items % $perpage == 0) {
            return $total_items / $perpage;
        }else{
            return $total_items / $perpage + 1;
        }
	}

	public function get_branches()
	{
		return $this->db->query("SELECT `branch` FROM `branch`")->result();
	}

	public function get_degrees()
	{
		return $this->db->query("SELECT `degreename` FROM `degree`")->result();
	}
	
	public function advanced_search($name, $city, $year, $branch, $degree, $chapter,$lower=null,$upper=null)
	{
		if ($name=="") {
			$name=null;
		}
		if ($city=="") {
			$city=null;
		}
		if ($branch=="") {
			$branch=null;
		}
		if ($year=="") {
			$year=null;
		}
		if ($degree=="") {
			$degree=null;
		}
		if ($chapter=="") {
			$chapter=null;
		}

		$this->db->select("*");
		$this->db->from("personal_detail");
		//$this->db->join('user_education','personal_detail.user_id = user_education.user_id');



		if (!is_null($name)) {
			$this->db->like('name', $name);
		}
		if (!is_null($city)) {
			$this->db->like('city', $city);
		}
		if (!is_null($year)) {
			$this->db->where('ug_passing_year', $year);
			$this->db->or_where('pg_passing_year', $year);
		}
		if (!is_null($branch)) {
			$this->db->where('branch_ug', $branch);
			$this->db->or_where('branch_pg', $branch);
		}
		if (!is_null($degree)) {
			$this->db->where('degree_ug', $degree);
			$this->db->or_where('degree_pg', $degree);
		}
		if (!is_null($chapter)) {
			$this->db->like('city', $chapter);
		}
		if (!is_null($lower) && !is_null($upper)) {
			$this->db->limit($upper,$lower);
		}
		return $this->db->get()->result();
	}
}