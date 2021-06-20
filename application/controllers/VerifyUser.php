<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VerifyUser extends CI_Controller {

	public function index($token)
	{
		$this->verifyusers($token);
	}
	/**
	 * This function validates the user once he clicks the confirmation link in his email
	 * @param   $token the unique token
	 */	
	public function verifyusers($token='')
	{
		// If both token and email are valid
		$this->load->model('Model_users');

		if ($token) {
			$result = $this->Model_users->get_email_verification_pin($token);
			if ($result == 1) {
				$this->success();
			}else{
				$this->failed();
			}

		}else{
			echo "<h1>Nothing here mate.</h1>";
		}
	}

	private function failed()
	{
		if ($this->session->userdata('is_logged_in')) {
			// if a user is alredy logged in redirect him to his profile page
			redirect('userProfile');
		}else{
			$this->load->view('header.php');
			$this->load->view('verify-failed.php');
			$this->load->view('footer.php');		
		}
	}
	private function success()
	{
		if ($this->session->userdata('is_logged_in')) {
			// if a user is alredy logged in redirect him to his profile page
			redirect('userProfile');
		}else{
			$this->load->view('header.php');
			$this->load->view('verify-success.php');
			$this->load->view('footer.php');		
		}
	}
}