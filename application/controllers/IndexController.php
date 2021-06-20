<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndexController extends CI_Controller {
	public function index()
	{
		$this->load->model('Model_users');
		$data['birthdays'] = $this->Model_users->get_todays_birthdays();
		$this->load->view('header.php');
		$this->load->view('homepage.php', $data);
		$this->load->view('footer.php');
	}

	public function studentEducationalFund()
	{
		$this->load->view('header.php');
		$this->load->view('student-educational-fund.php');
		$this->load->view('footer.php');
	}

	public function goldenTower()
	{
		$this->load->view('header.php');
		$this->load->view('golden-tower.php');
		$this->load->view('footer.php');
	}

	public function goldenTowerBooking()
	{
		$this->load->view('header.php');
		$this->load->view('golden-tower-booking.php');
		$this->load->view('footer.php');
	}

	public function activityReport(){
		$this->load->view('header.php');
		$this->load->view('activity-report.php');
		$this->load->view('footer.php');	
	}

	public function AlumniMeet()
	{
		$this->load->view('header.php');
		$this->load->view('alumni-meet.php');
		$this->load->view('footer.php');
	}
}
