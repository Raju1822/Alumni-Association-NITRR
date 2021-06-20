<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {
	public function index()
	{
		$this->eventsPage();
	}

	private function eventsPage(){	
            $this->load->view('header.php');
			$this->load->view('events.php');
			$this->load->view('footer.php');
	}
	
	public function view($id=null){
		if ($this->session->userdata('logged_in') && $this->session->userdata('access_level') >= 8) {
			
			$this->load->model('Model_events');
			$type = $this->Model_events->get_event_type($id);
	        $data = array('id' => $id, 'type' => $type[0]->content_category_id);
	        $data['data1'] = $this->Model_events->get_event($id);
			$this->load->view('header.php');
			$this->load->view('viewEvents.php',$data);
			$this->load->view('footer.php');			
		}else{
			redirect('Login');
		}
	}

	public function createevent()
	{
		if($this->session->userdata('logged_in_admin'))
	    {
			$this->load->view('header.php');  
			$this->load->view('admin/create-event.php', $errors=null);
			$this->load->view('footer.php');  
	    }else
	    {
	      //If no session, redirect to admin-login page
	      $this->load->view('header.php');  
	      $this->load->view('admin/login.php', $errors=null);
	      $this->load->view('footer.php');    
	    }
	}

	public function createeventsubmit(){
		if($this->session->userdata('logged_in_admin'))
	    {
	     	$this->load->model('Model_events');
	     	$this->load->model('Model_users');
			$this->load->library('form_validation');

	        $this->form_validation->set_rules('title','title','trim|required');
	        $this->form_validation->set_rules('content','Description','trim|required');
	        $this->form_validation->set_rules('date','Date','required');

	        if ($this->form_validation->run()) {
	        	$data = array('main_content_name' => $this->input->post('title'),
	        	              'content_category_id' => 3,
	        	              'content_text' => $this->input->post('content'),
	        	              'content_date' => $this->input->post('date'),
	        	              'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
	        	              'status' => 1
	        	 		);

	        	$this->Model_events->create_event($data);

	        	redirect('Events/createevent');
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

	public function deleteevent($type,$id){
		if($this->session->userdata('logged_in_admin'))
	    {
	     	$this->load->model('Model_events');
	     	$this->Model_events->delete_event($id);
	     	switch ($type) {
	     		case 'event':
			        redirect('events');
	     			break;

	     		case 'mom':
	     			redirect('Minutesofmeeting');
	     			break;
	     		case 'news':
	     			redirect('news');
	     			break;
	     		
	     		default:
			        redirect('events');
	     			break;
	     	}
		}else
	    {
	      //If no session, redirect to admin-login page
	      $this->load->view('header.php');  
	      $this->load->view('admin-login.php', $errors=null);
	      $this->load->view('footer.php');    
	    }
	}
}
