<?php

class Model_update_pass extends CI_Model{


    function getUserPass($id){
        $this->db->where('user_id', $id);
        $query = $this->db->get('user_main');
        return $query->row();
    }

     public function savePassword($userid, $data){
      $this->db->where('user_id',$userid);
      $this->db->update('user_main',$data);
    }


    public function send_validation_mail_to_user($email){
		$message = "Congratulations! You have successfully updated Your Password in the alumni website.";
		$subject = 'Greetings from GEC-NITRR Alumni Association!';

		if($this->send_mail('admin@gecnitrralumni.org', 'Admin', $email, $subject, $message)){
			return 1;
		}else{
			return 0;
		}
    }
    
    private function send_mail($fromEmail,$fromName, $toEmail, $subject, $message){
		$config['mailtype'] = 'html';
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from($fromEmail, $fromName);
		$this->email->to($toEmail);
		$this->email->subject($subject);
		$this->email->message($message);

		if($this->email->send()){
			return 1;
		}else{
			return 0;
		}
	}

}

?>