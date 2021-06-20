<?php
class Model_discussions extends CI_Model{

	public function encode(&$value)
	{
		$value = htmlspecialchars($value, ENT_NOQUOTES);
		return $value;
	}
	
	// to encode an array at once to prevent sql injection and csrf attacks

	public function encodedata(&$data)
	{
		foreach ($data as $key => &$value) {
			$value = htmlspecialchars($value, ENT_NOQUOTES);
		}
		return $data;
	}

	public function form_insert($data){
		$data = $this->encodedata($data);
		$this->db->insert('discussions', $data);
	}

	public function form_insert_image($data){
		$this->db->insert('discussion_media', $data);
	}

	public function updateviews($data){

    	if ($this->db->get_where('discussion_views',$data)->result()) {
    		// user has already seen this
    		// do nothing
    	}else{
    		// a new user has seen this post update the views
    		$data = $this->encodedata($data);
    		$this->db->insert("discussion_views",$data);
    	}
	}

	public function get_discussion_type($id)
	{
		return $this->db->query("SELECT `type_id` FROM `discussions` WHERE `discussion_id` = $id")->result();
	}

	public function delete_discussion($id)
	{
		$this->db->where('discussion_id',$id);
		$this->db->delete('discussions');
		$this->db->where('parent_discussion_id',$id);
		$this->db->delete('discussions');
	}

	public function get_all_chapters($user_city = null,$lower, $upper)
	{	
		// if user city has been provided
		if ($user_city) {
			$result = $this->db->query("SELECT `discussion_id` FROM `chapter_discussion` WHERE `city` = '$user_city' ")->result();
			if ($result) {
				for ($i=0; $i < count($result); $i++) { 
					$discussion_ids[$i] = $result[$i]->discussion_id;
				}
				$lower--;
				$res = $this->db->where('type_id',3)->where('discussion_id = parent_discussion_id')->where_in('parent_discussion_id',$discussion_ids)->where('status',1)->limit($lower, $upper)->get('discussions')->result();
				return $res;
			
		}
			
		}else{
			return;
		}
	}

	public function get_discussions($id)
	{
		return $this->db->get_where('discussions', array('discussion_id' => $id));
	}

	public function get_total_pages($total_items,$perpage )
	{
		if ($total_items % $perpage == 0) {
            return $total_items / $perpage;
        }else{
            return $total_items / $perpage + 1;
        }
	}

	public function delete_chapter_discussion($id)
	{
		$this->db->where('discussion_id',$id);
		$this->db->delete('chapter_discussion');
	}

	// For Admin Panel
	public function get_discussion($type_id = 1, $discussion_id = null)
	{
		if($discussion_id === null){
			$this->db->select('*');
			$query = $this->db->where('discussion_id = parent_discussion_id')->where(array('type_id' => $type_id))->get('discussions');
			return ($query->result());	
		}else{
			$this->db->select('*');
			$query = $this->db->where('discussion_id = parent_discussion_id')->where(array('type_id' => $type_id, 'discussion_id' => $discussion_id))->get('discussions');
			$res = $query->result();
			return $res[0];
		}
	}

	public function get_parent_discussion_id()
	{
		$query = $this->db->select('discussion_id')->order_by('discussion_id','desc')->limit(1)->get('discussions')->row('discussion_id');
		return intval($query) + 1;
	}

	public function update_event($data)
	{
		if($data['discussion_id'] == null){
			// Insert a new news content
			$data = $this->encodedata($data);
			if($this->db->insert('discussions', $data)){
				return 1;
			}else{
				return 0;
			}
		}else{
			$this->db->where('discussion_id',$data['discussion_id']);
			if($this->db->update('discussions', $data)){
				return 1;
			}else{
				return 0;
			}
			
			
		}	
	}
}