<?php
class update_likes extends CI_Model{
function __construct() {
parent::__construct();
}
function update(){
  $this->load->model('Model_userprofile');
  $user_id = $this->Model_userprofile->get_user_id($_SESSION['logged_in']);
  $data = array(

                    "discussion_id" => $this->input->post('id'),
					"user_id"=>$user_id
                );
        return $this->db->insert("discussion_likes",$data);
}
}
?>