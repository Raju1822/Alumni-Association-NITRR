<?php
class Model_news extends CI_Model{

	public function encode($value)
	{
		$value = htmlspecialchars($value, ENT_NOQUOTES);
		return $value;
	}

	public function encodedata($data)
	{
		foreach ($data as $key => $value) {
			$value = htmlspecialchars($value, ENT_NOQUOTES);
		}
		return $data;
	}

	public function form_insert($data){
		$data = $this->encodedata($data);
		$this->db->insert('main_content', $data);
	}
	
	public function form_insert_image($data1){
		$this->db->insert('main_content_media', $data1);
	}

	public function get_news($content_id = null)
	{
		if($content_id === null){
			$this->db->select('*');
			$query = $this->db->get_where('main_content',array('content_category_id' => 2));
			return ($query->result());	
		}else{
			$this->db->select('*');
			$query = $this->db->get_where('main_content',array('content_category_id' => 2, 'main_content_id' => $content_id));
			$res = $query->result();
			return $res[0];
		}
	}

	public function update_news($data)
	{
		if($data['main_content_id'] == null){
			// Insert a new news content
			$data = $this->encodedata($data);
			if($this->db->insert('main_content', $data)){
				return 1;
			}else{
				return 0;
			}
		}else{
			$this->db->where('main_content_id',$data['main_content_id']);
			if($this->db->update('main_content', $data)){
				return 1;
			}else{
				return 0;
			}
			
			
		}	
	}
}
?>