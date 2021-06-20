<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvancedSearch extends CI_Controller {

	public function index($data=null)
	{
		$this->AdvancedSearchPage($data);
		

	}

	public function AdvancedSearchPage($data=null){
		if($this->session->userdata('logged_in'))
		{	
			$this->load->model('Model_search');
			$data['degrees'] = $this->Model_search->get_degrees();
			$data['branches'] = $this->Model_search->get_branches();
			$this->load->view('header.php');
			$this->load->view('advanced-search.php',$data);
			$this->load->view('footer.php');	

		}
		else{
			redirect('login');
		}
			
	}

	public function search()
	{
		if($this->session->userdata('logged_in'))
		{	
			$this->load->model('Model_search');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','trim|alpha_numeric_spaces',
		                                  array(
		                                        'required'=>'Enter a search term!',
		                                        'alpha_numeric_spaces'=>'Enter a valid Search term'
		                                        )
		                                  );
			$this->form_validation->set_rules('city','City','trim|alpha_numeric_spaces',
		                                  array(
		                                        'required'=>'Enter a search term!',
		                                        'alpha_numeric_spaces'=>'Enter a valid Search term'
		                                        )
		                                  );
			$this->form_validation->set_rules('year','Year','trim');
			$this->form_validation->set_rules('branch','Branch','trim|alpha_numeric_spaces',
		                                  array(
		                                        'required'=>'Enter a search term!',
		                                        'alpha_numeric_spaces'=>'Enter a valid Search term'
		                                        )
		                                  );
			$this->form_validation->set_rules('degree','Degree','trim|alpha_numeric_spaces',
		                                  array(
		                                        'required'=>'Enter a search term!',
		                                        'alpha_numeric_spaces'=>'Enter a valid Search term'
		                                        )
		                                  );
			$this->form_validation->set_rules('chapter','Chapter','trim|alpha_numeric_spaces',
		                                  array(
		                                        'required'=>'Enter a search term!',
		                                        'alpha_numeric_spaces'=>'Enter a valid Search term'
		                                        )
		                                  );

			if ($this->form_validation->run()) 
			{
				$name = $this->input->post('name');
				$city = $this->input->post('city');
				$year = $this->input->post('year');
				$branch = $this->input->post('branch');
				$degree = $this->input->post('degree');
				$chapter = $this->input->post('chapter');

				$pageno =1;
				$per_page = 100;
				//,(($pageno-1)*$per_page)+1,$pageno*$per_page
				$data['results'] = $this->Model_search->advanced_search($name, $city, $year, $branch, $degree, $chapter);
				$data['total_pages'] = $this->Model_search->get_total_pages(count($data['results']), $per_page);
				// print_r($data['results']);
				// print_r(count($data['results']));
				print_r($data['total_pages']);
				// die();
				
				if ($pageno > $data['total_pages'] + 1) {
					redirect('AdvancedSearch');
				}
				$this->AdvancedSearchPage($data);
			}
			else
			{
				$this->load->view('header.php');
				$this->load->view('advanced-search.php');
				$this->load->view('footer.php');	
			}
		}else{
			redirect('Login');
		}
	}

}