<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Minutesofmeeting extends CI_Controller {
	public function index()
	{ 
		if($this->session->userdata('logged_in'))
	    {
	    	if ($this->session->userdata('access_level') >= 10) {
				$this->Mompage();
			}else{
				redirect('Login');
			}
		}
		else{
			redirect("Login");
		}
	}

	public function Mompage($ind=null){
		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('access_level') >= 10) {
				$this->load->view('header.php');
				$data = array('ind' => $ind);
				$this->load->view('mom.php',$data);
				$this->load->view('footer.php');		
			}else{
				redirect('Login');
			}
		}else{
			redirect('login');	
		}
	}

	public function createMom()
	{
		if($this->session->userdata('logged_in_admin'))
	    {
			$this->load->view('header.php');  
			$this->load->view('admin/create-mom.php', $errors=null);
			$this->load->view('footer.php');  
	    }else
	    {
	      //If no session, redirect to admin-login page
	      $this->load->view('header.php');  
	      $this->load->view('admin/login.php', $errors=null);
	      $this->load->view('footer.php');    
	    }
	}

	public function createMomSubmit(){
		if($this->session->userdata('logged_in_admin'))
	    {
	     	$this->load->model('Model_mom');
	     	$this->load->model('Model_users');
			$this->load->library('form_validation');

	        $this->form_validation->set_rules('title','title','trim|required');
	        $this->form_validation->set_rules('content','Description','trim|required');
	        $this->form_validation->set_rules('date','Date','required');

	        if ($this->form_validation->run()) {
	        	$data = array('main_content_name' => $this->input->post('title'),
    	              'content_category_id' => 1,
    	              'content_text' => $this->input->post('content'),
    	              'content_date' => $this->input->post('date'),
    	              'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
    	              'status' => 1
    	 		);
	        	if($this->Model_mom->create_Mom($data)){
		        	echo 1;        		
	        	}else{
	        		echo 0;
	        	}

        	}else{
        		$this->createevent();
        	}
		}else
	    {
	      //If no session, redirect to admin-login page
	      $this->load->view('header.php');  
	      $this->load->view('admin/login.php', $errors=null);
	      $this->load->view('footer.php');   
	    }
	}
}