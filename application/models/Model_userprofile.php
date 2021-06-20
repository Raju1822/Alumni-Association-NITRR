<?php 

/**
* 
*/
class Model_userprofile extends CI_Model
{

	public function encode($value)
	{
		$value = htmlspecialchars($value);
		return $value;
	}

	public function encodedata(&$data)
	{
		foreach ($data as $key=>&$value) {
			$value = htmlspecialchars($value);
		}
		return $data;
	}

	public function get_user_id($login_name){
		$this->db->select('user_id');
		$query = $this->db->get_where('user_main',array('login_name' => $login_name));
		$res = $query->result();
		
		return $res[0]->user_id; 
	}
	public function get_user_email($user_id){
		$this->db->select('login_name');
		$query = $this->db->get_where('user_main',array('user_id' => $user_id));
		$res = $query->result();
		return $res[0]->login_name; 
	}

	public function get_personal_details($user_id){
		
		$query = $this->db->get_where('personal_detail',array('user_id' => $user_id));
		$res = $query->result();
		return $res;
	}

	public function get_user_skills($user_id){
		
		$query = $this->db->get_where('user_skills',array('user_id' => $user_id));
		$res = $query->result();
		return $res; 
	}

	public function get_user_education($user_id){
		
		$query = $this->db->get_where('user_education',array('user_id' => $user_id));
		$res = $query->result();
		return $res; 
	}

	public function get_user_jobs($user_id){
		
		$query = $this->db->get_where('user_jobs',array('user_id' => $user_id));
		$res = $query->result();
		return $res; 
	}

	public function get_user_projects($user_id){
		$query = $this->db->get_where('user_projects',array('user_id' => $user_id));
		$res = $query->result();
		return $res; 
	}

	public function get_user_branch($branch_id)
	{
		$query = $this->db->select('Branch')->get_where('branch',array('BranchId' => $branch_id));
		return $query->result();
	}

	// INSERT FUNCTIONS

	public function set_personal_details($data, $user_id){
		$data = $this->encodedata($data);
		$this->db->where('user_id',$user_id);
		if ($this->db->update('personal_detail', $data)) {
			return 1;
		}else{
			return 0;
		}
	}

	public function set_user_skills($data){
		$data = $this->encodedata($data);
		
		if ($query = $this->db->insert('user_skills', $data)) {
			return 1;
		}else{
			return 0;
		} 
	}

	public function set_chapter_discussion($data){
		$data = $this->encodedata($data);
		
		if ($query = $this->db->insert('chapter_discussion', $data)) {
			return 1;
		}else{
			return 0;
		} 
	}

// education models

	public function delete_user_education($data){
		if($this->db->delete('user_education', $data)){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function set_user_education($data){
		$data = $this->encodedata($data);
		
		$this->db->where(array('user_id' => $data['user_id'],'institute'=> $data['institute']));
		$this->db->delete('user_education');

		if($this->db->insert('user_education', $data)){
			return 1;
		}else{
			return 0;
		}
	}

// job models

	public function delete_user_jobs($data){
		if($this->db->delete('user_jobs', $data)){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function set_user_jobs($data){
		$data = $this->encodedata($data);

		$this->db->where(array('user_id' => $data['user_id'],'company'=> $data['company']));
		$this->db->delete('user_jobs');

		if($this->db->insert('user_jobs', $data)){
			return 1;
		}else{
			return 0;
		}
	}

// project model

	public function delete_user_projects($data){
		if($this->db->delete('user_projects', $data)){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function set_user_projects($data){
		$data = $this->encodedata($data);

		$this->db->where(array('user_id' => $data['user_id'],'project_name'=> $data['project_name']));
		$this->db->delete('user_projects');

		if($this->db->insert('user_projects', $data)){
			return 1;
		}else{
			return 0;
		}
	}

// skills models

	public function set_user_skill($data, $user_id){
		$data = $this->encodedata($data);

		if($this->db->insert('user_skills', $data)){
			return 1;
		}else{
			return 0;
		}
	}

	public function delete_userskill($data)
	{
		if($this->db->delete('user_skills', $data)){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function update_profile_picture($picture, $user_id)
	{
		$data = array('user_id' => $user_id, 'image_name' => $picture);


		$query = $this->db->get_where('profile_pic', array('user_id' => $user_id));

		if($query->num_rows() > 0){
			$this->db->where('user_id',$user_id);
			
			if ($this->db->update('profile_pic', $data)) {
				return 1;
			}else{
				return 0;
			}	
		}else{
			if($this->db->insert('profile_pic', $data)){
				return 1;
			}else{
				return 0;
			}
		}
	}

	public function get_profile_picture($user_id)
	{
		$res = $this->db->get_where('profile_pic',array('user_id'=>$user_id))->result();
		if ($res) {
			return $res[0]->image_name;
		}else{
			return "user-img.png";
		}
	}

	


}