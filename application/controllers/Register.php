<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->registerPage();
	}

	public function registerPage(){
		if ($this->session->userdata('is_logged_in')) {
			// if a user is alredy logged in redirect him to his profile page
			redirect('userProfile');
		}else{
			$this->load->view('header.php');
			$this->load->view('register.php');
			$this->load->view('footer.php');		
		}
			
	}

	public function registerValidation(){
		$this->load->library('form_validation');
		$this->load->model('Model_users');
		$this->load->model('Model_userprofile');
		$this->load->view('header.php');
		
		$this->form_validation->set_rules('mobile-no','Mobile No','required|trim|numeric');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user_main.login_name]',array('is_unique'=>'This Email is alredy Registerd with us!'));
		$this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
		$this->form_validation->set_rules('rpassword','Re-enter Password','required|trim|matches[password]');
		$this->form_validation->set_rules('terms-and-condition','Terms and Conditions','required',array('required'=>'You must agree to Terms and Conditions'));
		$this->form_validation->set_rules('first-name','First Name','required|trim|alpha_numeric_spaces');
		$this->form_validation->set_rules('last-name','Last Name','required|trim');
		$this->form_validation->set_rules('city','City','required|trim|alpha');

		// Added for current placement status
		$this->form_validation->set_rules('company','Company','required|trim');
		
		$this->form_validation->set_rules('country','Country','required|trim|alpha');
		$this->form_validation->set_rules('passing-year','Passing Year','required|trim');
		$this->form_validation->set_rules('degree-type','Degree Type','required|trim');
		$this->form_validation->set_rules('degree','Degree','required|trim');
		$this->form_validation->set_rules('branch','Branch','required|trim');
		
		// recaptcha
		if(isset($_POST['g-recaptcha-response']))
	      $captcha=$_POST['g-recaptcha-response'];

	    if(!$captcha){
	      echo '<h2>Please check the the captcha form.</h2>';
	      exit;
		}
		
		
		if ($this->form_validation->run()) {
			
			$password=$this->input->post('password');

			// hash the password
			$hash = $this->Model_users->hashPassword($password);
        	
        	$email = $this->input->post('email');

        	// prepare data for insertion into user_main
			$data_main = array(
            'user_type' =>  $this->input->post('user-type'),
            'login_name' =>  $email,
            'password' => $hash,
            'admin_status' => 0
        	);
			// insert user to the user table
			$this->Model_users->insert_user($data_main,'user_main');
			
			$user_id = $this->Model_users->get_user_id($email);
			$email_validation_pin = $this->Model_users->get_email_verification_pin();
        	// prepare data for insertion into personal_detail

			if ($this->input->post('degree-type') === 'ug') {
				 $data_personal_detail = array(
					'name' => $this->input->post('first-name')." ".$this->input->post('last-name'),
					'ph_number_1' => $this->input->post('mobile-no'),
					'email' => $this->input->post('email'),
					'email_verification_status' => 0,
					'contact_verification_status' => 0,
					'country' => $this->input->post('country'),
					'user_id' => $user_id,
					'email_verification_pin' => $email_validation_pin,
					'city' => $this->input->post('city'),
					'city' => $this->input->post('city'),
					'ug_passing_year' => $this->input->post('passing-year'),
					'degree_ug' => $this->input->post('degree'),
					'branch_ug' => $this->input->post('branch'),
				);
			}else{
				$data_personal_detail = array(
					'name' => $this->input->post('first-name')." ".$this->input->post('last-name'),
					'ph_number_1' => $this->input->post('mobile-no'),
					'email' => $this->input->post('email'),
					'email_verification_status' => 0,
					'contact_verification_status' => 0,
					'country' => $this->input->post('country'),
					'email_verification_pin' => $email_validation_pin,
					'user_id' => $user_id,
					'city' => $this->input->post('city'),
					'city' => $this->input->post('city'),
					'pg_passing_year' => $this->input->post('passing-year'),
					'degree_pg' => $this->input->post('degree'),
					'branch_pg' => $this->input->post('branch'),
				);
			}

			// insert user to the personal_details table
			$this->Model_users->insert_user($data_personal_detail,'personal_detail');
			
			$this->Model_users->send_validation_mail($this->input->post('email'), $email_validation_pin);

			$company_data = array(
                'user_id' => $user_id,
                'company' => $this->input->post("company"),
                'designation' => "",
                'description' => "",
                'from' => "2017-06-01",
                'to' => "0000-00-00"
            );
            
            $this->Model_userprofile->set_user_jobs($company_data);
			// TODO: after insertion send a confirmation mail
			// Registration is complete now, redirect the user to a confirmation page
			$this->registrationComplete(array('email' => $email));
			// redirect('IndexController');
		}
		else{
			$this->load->view('register.php');
		}
		$this->load->view('footer.php');
	}

	private function registrationComplete($user){
		if ($this->session->userdata('is_logged_in')) {
			// if a user is alredy logged in redirect him to his profile page
			redirect('userProfile');
		}else{
			$this->load->view('registration-successful.php', $user);
		}
	}

	public function registerGetDegree($degree_type = 'ug'){
		$query = $this->db->get_where('degree',array('DegreeType'=> $degree_type));
		$query = $query->result();
		echo json_encode(array($query));
	}

	public function registerGetBranch($degree_id = '1'){
		$query = $this->db->get_where('branch',array('DegreeId'=> $degree_id));
		$query = $query->result();
		echo json_encode(array($query));
	}
}
