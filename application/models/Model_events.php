<?php 

class Model_events extends CI_Model
{
	public function encodedata(&$data)
	{
		foreach ($data as $key => &$value) {
			$value = htmlspecialchars($value, ENT_NOQUOTES);
		}
		return $data;
	}

	public function get_event($id)
	{
		return $this->db->get_where('main_content', array('main_content_id' => $id));
	}

	public function get_event_type($id)
	{
		return $this->db->select('content_category_id')->get_where('main_content',array('main_content_id' => $id))->result();
	}

	public function create_event($data)
	{
		$data = $this->encodedata($data);
		$this->db->insert('main_content', $data);
	}

	public function delete_event($id)
	{
		$this->db->where('main_content_id',$id);
		$this->db->delete('main_content');
	}

	// For Admin Panel
	public function get_events($content_id = null)
	{
		if($content_id === null){
			$this->db->select('*');
			$query = $this->db->get_where('main_content',array('content_category_id' => 3));
			return ($query->result());	
		}else{
			$this->db->select('*');
			$query = $this->db->get_where('main_content',array('content_category_id' => 3, 'main_content_id' => $content_id));
			$res = $query->result();
			return $res[0];
		}
	}

	public function update_event($data)
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