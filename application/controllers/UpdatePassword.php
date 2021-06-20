<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdatePassword extends CI_Controller{

    function index(){

        $this->updatepass();
    }

function updatePass(){

    if ($this->session->userdata('logged_in')){
         $this->load->view('header.php');
         $this->load->view('changepassword.php');
         $this->load->view('footer.php');
  }else{
      redirect('Login');
  }
}

function validation_password(){
        $this->load->model('Model_update_pass');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('old_password', 'Old Password', 'required'); 
        $this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]'); 

    if($this->form_validation->run()){
        $userid = $this->session->userdata('user_id');
        $user = $this->Model_update_pass->getUserPass($userid);
        $pass=$this->input->post('old_password');
        // check old password and match with current password
        if($user->password !== crypt($pass,$user->password)){   
               $this->session->set_flashdata('message', 'Old Password Is Not Correct');
               $this->load->view('header.php');
               $this->load->view('changepassword.php');
               $this->load->view('footer.php');
               return false;
        
        }else{
            $data1 = $this->input->post('new_password');
            $data = array();
            $data['password'] = $this->hashPassword($data1);

            $this->Model_update_pass->savePassword($userid,$data);
      
            $this->msg(); //calling msg() to show message in userprofile
            redirect('Userprofile');
        }
    
       }else{
        $this->load->view('header.php');
        $this->load->view('changepassword.php');
        $this->load->view('footer.php');
    } 
  }
  
  function hashPassword($data1){
       $salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
       $hash = crypt($data1, '$2y$12$' . $salt);
       return $hash;
    }
    
    public function msg() //show message for password update successfully
    {
        $userid = $this->session->userdata('user_id');
        $user = $this->Model_update_pass->getUserPass($userid);
        $this->Model_update_pass->send_validation_mail_to_user($user->login_name);
        $this->session->set_flashdata('message', 'Password is updated successfully');
    }

}
  
  class UserProfile extends UpdatePassword {} // calling userprofile controller for msg print

?>