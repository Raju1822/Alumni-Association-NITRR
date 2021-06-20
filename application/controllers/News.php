<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	public function index()
	{
			$this->NewsPage();		
	}

	public function NewsPage($ind = 0){
		$data['ind'] = $ind;
		$this->load->view('header.php');
		$this->load->view('latest-news.php', $data);
		$this->load->view('footer.php');	
	}

	function doupload()
	{       
		if($this->session->userdata('logged_in') && $this->session->userdata('access_level') >= 10)
	  	{  
		  	$this->load->model('Model_news');
		    $this->load->library('upload');
		    $this->load->model('Model_userprofile');
		    $this->load->library('form_validation');

		    $this->form_validation->set_rules('title','title','trim|required');
		    $this->form_validation->set_rules('content','content','trim|required');

		    if ($this->form_validation->run()) 
		    {
			    $files = $_FILES;
			    $cpt = count($_FILES['userfile']['name']);
					$no=$this->db->select('main_content_id')->order_by('main_content_id','desc')->limit(1)->get('main_content')->row('main_content_id');
					$no=$no+1;
			    for($i=0; $i<$cpt; $i++)
			    {           
			        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
			        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
			        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
			        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
							$data1 = array(
								'main_content_id'=>$no,
								'image_extension'=> substr(strchr($_FILES['userfile']['name'],"."),1),
								'image_id'=> $no.'_'.$_FILES['userfile']['name'],
								'mime_type'=> $_FILES['userfile']['type']);

							$this->Model_news->form_insert_image($data1);
			
			        $this->upload->initialize($this->set_upload_options());
			        $this->upload->do_upload();
		    	}
					$data = array(
						'content_category_id'=>2,
						'main_content_name'=> $this->input->post('title'),
						'content_text' => $this->input->post('content'),
						'status'=>0,
						'content_posted_by_user_id'=> $this->Model_userprofile->get_user_id($this->session->logged_in),
						'content_date'=>date("Y-m-d",time()));

					$this->Model_news->form_insert($data);
					$data['message'] = 'Data Inserted Successfully';
					//Loading View
					redirect('news');
			}else{
				$this->NewsPage();
			}
		}else{
			redirect('Login');
		}
	}

	private function set_upload_options()
	{   
	    //upload an image options
	    $config = array();
		$no=$this->db->select('main_content_id')->order_by('main_content_id','desc')->limit(1)->get('main_content')->row('main_content_id');
		$no=$no+1;
		$new_name = $no.'_'.$_FILES["userfile"]['name'];
		$config['file_name'] = $new_name;
	    $config['upload_path'] = './news_upload/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;
	    return $config;
	}

}
