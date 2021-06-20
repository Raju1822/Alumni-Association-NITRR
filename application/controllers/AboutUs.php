<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AboutUs extends CI_Controller {

	public function index()
	{
		//$this->aboutUsPage();
		$this->load->view('header.php');
		$this->load->view('about-us.php');
		$this->load->view('footer.php');

	}

	public function aboutUsPage(){
		
	}

}