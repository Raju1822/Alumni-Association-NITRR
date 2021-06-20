<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{	
		// default
		$this->loginPage();
	}

	// loads the login page
	public function loginPage($errors = null)
	{
		if ($this->session->userdata('logged_in')) {
			// if a user is already logged in redirect him/her to his/her profile
			redirect('userProfile');
		}
		else{
			$this->load->view('header.php');			
			$this->load->view('login.php',$errors);	
			$this->load->view('footer.php');	
		}
	}		

	public function validate_credentials(){
		// validate the login and password an allow the user to log in
		$this->load->model('Model_users');
		$this->load->model('Model_userprofile');
		$this->load->library('form_validation');

		// remove previous errors
		$errors = null;
		
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		$this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
	
        
		if ($this->form_validation->run()) {

			$email= $this->input->post('email');
			$password= $this->input->post('password');
			$this->Model_users->hashPassword($password);
			if($this->Model_users->can_log_in($email, $password)){
				$user_id = $this->Model_users->get_user_id($email);
				$personal_details = $this->Model_userprofile->get_personal_details($user_id);
				$full_user_name = $personal_details[0]->name;
				$access_level = $this->Model_users->get_user_access_level($user_id);

	            $email_verification_status = $personal_details[0]->email_verification_status; 
	            $user_type = $this->Model_users->get_user_type($user_id);
    
	            // Setting session variables
	            $this->session->set_userdata('logged_in', $email);
	            $this->session->set_userdata('user_type', $user_type);
	            $this->session->set_userdata('user_id', $user_id);       
	            $this->session->set_userdata('access_level', $access_level);       
				$this->session->set_userdata('full_user_name', $full_user_name);
				
	           // exit(0);
		        redirect('userProfile');
		    }
		    else{
		    	$error['login_error'] = "Invalid Email/Password Combination";
				$this->loginPage($error);
		    }
		}else{
		    $error['login_error'] = "Invalid Email/Password Combination";
			$this->loginPage($error);
		}
	}

	// forgot password view renderer
	public function forgot_password($errors = null)
	{
		if ($this->session->userdata('logged_in')) {
			// if a user is already logged in redirect him/her to his/her profile
			redirect('userProfile');
		}
		else{
			$this->load->view('header.php');			
			$this->load->view('forgot-password.php',$errors);	
			$this->load->view('footer.php');	
		}
	}

	// onsubmit of forgot password form, this function validates the data and shows a proper response
	public function validate_forgot_password_form()
	{
		$this->load->model('Model_users');
		$this->load->library('form_validation');

		// remove previous errors
		$errors = null;

		$this->form_validation->set_rules('email','Email','required|trim|valid_email');

		if ($this->form_validation->run()) {

			$email= $this->input->post('email');

			if($this->Model_users->is_registered_email($email)){
	            // send a reset link to user.
	            if($this->Model_users->send_forgot_password_link($email)){
		            $this->forgot_password_success($email);
	            }else{
	            	$this->forgot_password_success($email = null);
	            }
		    }
		    else{
		    	$error['reset_error'] = "Sorry, this email is not registered with us.";
				$this->forgot_password($error);
		    }
		}else{
		    $error['reset_error'] = "Invalid Email";
			$this->forgot_password($error);
		}
	}

	// onsubmission of forgot password form this function renders the next page
	private function forgot_password_success($email)
	{
		if ($this->session->userdata('logged_in')) {
			// if a user is already logged in redirect him/her to his/her profile
			redirect('userProfile');
		}
		else{
			$this->load->view('header.php');			
			$this->load->view('forgot-password-success.php', array('email' => $email));	
			$this->load->view('footer.php');	
		}
	}

	// this function validates the pin provided by the user. It is called when a user clicks the password reset link in his email.
	public function verify_forgot_password_pin($pin=null)
	{
		if ($this->session->userdata('logged_in')) {
			// if a user is already logged in redirect him/her to his/her profile
			redirect('userProfile');
		}
		else{
			$data = null;
			// If both pin and email are valid
			$this->load->model('Model_users');
			if ($pin) {
				$email= $this->input->get('email');
				$result = $this->Model_users->validate_password_reset_pin($email, $pin);
				if ($result == 1) {
					// password reset pin is correct, send the user to a form
					$data['pin'] = $pin;
					$data['email'] = $email;
					$this->reset_password_form($data);
				}else{
					$data['invalid_link'] = true;
					$this->reset_password_form($data);
				}
			}else{
				echo "<h1>Nothing here mate.</h1>";
			}
		}	
	}
	
	private function reset_password_form($data=null)
	{
		if ($this->session->userdata('logged_in')) {
			// if a user is already logged in redirect him/her to his/her profile
			redirect('userProfile');
		}
		else{
			$this->load->view('header.php');			
			$this->load->view('reset-password.php',$data);
			$this->load->view('footer.php');	
		}
	}

	public function reset_password($pin=null)
	{
		$email = $this->input->get('email');
		if ($pin && $email) {

			if ($this->session->userdata('logged_in')) {
				// if a user is already logged in redirect him/her to his/her profile
				redirect('userProfile');
			}
			else{
				$this->load->model('Model_users');
				$this->load->library('form_validation');

				// remove previous errors
				$data = null;

				$this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
				$this->form_validation->set_rules('cpassword','Re-enter Password','required|trim|matches[password]');

				if ($this->form_validation->run()) {
					// valid passwords entered
					
					$password = $this->input->post('password');

					if($this->Model_users->validate_password_reset_pin($email, $pin)){
						// pin is valid, store new password and delete password pin from database
						
						if($this->Model_users->set_new_password($email, $password)){
							// password reset success
							$data['password_change_success'] = true;
							$this->reset_password_form($data);
						}else{
							// password reset failed
							$data['password_change_failed'] = true;
							$this->reset_password_form($data);
						}
					}else{
						$data['invalid_link'] = true;
						$this->reset_password_form($data);
					}
				}else{
				    $data['password'] = "Please enter a valid password";
					$this->reset_password_form($data);
				}
			}
		}else{
			redirect('Login');
		}
		
	}

	// close current user session and logout.
	public function logout(){
		// logout
		$this->session->sess_destroy();
		redirect('login');
	}
}
