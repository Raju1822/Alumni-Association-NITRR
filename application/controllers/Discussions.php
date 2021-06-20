<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discussions extends CI_Controller {

	public function index()
	{
		$this->discussionsPage();
	}

	public function discussionsPage(){
	
		if($this->session->userdata('logged_in'))
	  	{
	  		if ($this->session->userdata('access_level') >= 8) {

				$this->load->view('header.php');  
				$this->load->view('discussion.php');
				$this->load->view('footer.php');
			}else{
				redirect('Login');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('Login', 'refresh');
		}        
	}

	public function update_likes()
	{ 
		if($this->session->userdata('access_level') >= 8)
	  	{      
			$this->load->model("update_likes");
			$this->update_likes->update();
		}else{
			redirect('Login');
		}
	}

	public function doupload()
	{   
		if($this->session->userdata('access_level') >= 8)
	  	{  
			$this->load->model('Model_discussions');
			$this->load->library('upload');
			$this->load->model('Model_userprofile');
			$this->load->library('form_validation');

			$this->form_validation->set_rules('title','title','trim|required');
			$this->form_validation->set_rules('content','content','trim|required');

			if ($this->form_validation->run()) 
			{
			  $no=$this->db->select('discussion_id')->order_by('discussion_id','desc')->limit(1)->get('discussions')->row('discussion_id');
			  $no=$no+1;

			  $files = $_FILES;
			  $cpt = count($_FILES['userfile']['name']);
			  
			  for($i=0; $i<$cpt; $i++)
			  {           
				  $_FILES['userfile']['name']= $files['userfile']['name'][$i];
				  $_FILES['userfile']['type']= $files['userfile']['type'][$i];
				  $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
				  $_FILES['userfile']['error']= $files['userfile']['error'][$i];
				  $_FILES['userfile']['size']= $files['userfile']['size'][$i];    
				 //Checking whether file is uploaded or not    
				  if (is_uploaded_file($_FILES['userfile']['tmp_name'])) 
				  { 
					  $data1 = array(
					  'discussion_id'=> $no,
					  'image_extension'=> substr(strchr($_FILES['userfile']['name'],"."),1),
					  'image_id'=> $no.'_'.$_FILES['userfile']['name'],
					  'mime_type'=> $_FILES['userfile']['type']);
					  $this->Model_discussions->form_insert_image($data1);
					  $this->upload->initialize($this->set_upload_options());
					  $this->upload->do_upload();
				  }
			  }
			
			  $data = array(
					'type_id'=>1,
					'parent_discussion_id'=>$no,
					'discussion_name'=> $this->input->post('title'),
					'discussion_content' => $this->input->post('content'),
					'date'=>date("Y-m-d",time()),
					'content_posted_by_user_id'=>$this->Model_userprofile->get_user_id($this->session->logged_in),
					'status'=>0
				  );

			  $this->Model_discussions->form_insert($data);
			  
			  $data['message'] = 'Data Inserted Successfully';

			  //Loading View
			  $this->discussionsPage();
		  }else{
			// there are some validation errors
			$this->DiscussionsPage();
		  } 
		}else{
			redirect('Login');
		}
	}

  public function view($id){

		if($this->session->userdata('logged_in'))
		{
		    if ($this->session->userdata('access_level') >= 8) {

				$this->load->model("Model_discussions");
				$this->load->model("Model_userprofile");

				$viewdata = array(
				'discussion_id' => $id,
				'user_id' => $this->Model_userprofile->get_user_id($this->session->logged_in)    
				);

				$this->Model_discussions->updateviews($viewdata);

				$type = $this->Model_discussions->get_discussion_type($id);

				$pagedata = array('id' => $id,'type'=>$type[0]->type_id);
				$pagedata['data1'] = $this->Model_discussions->get_discussions($id);
				$this->load->view('header.php');
				$this->load->view('viewDiscussions.php',$pagedata);
				$this->load->view('footer.php');
			}else{
		        redirect('Login');
			}
		}
		else
		{
		 redirect('Login', 'refresh');
		}
	 
  }


  private function set_upload_options()
  {   
	  //upload an image options
	  $config = array();
	  $no=$this->db->select('discussion_id')->order_by('discussion_id','desc')->limit(1)->get('discussions')->row('discussion_id');
	  $no=$no+1;
	  $new_name = $no.'_'.$_FILES["userfile"]['name'];
	  $config['file_name'] = $new_name;
	  $config['upload_path'] = './discussion_upload/';
	  $config['allowed_types'] = 'gif|jpg|png';
	  $config['max_size']      = '0';
	  $config['overwrite']     = FALSE;

	  return $config;
  }

  public function insertComment($discussion_id)
  {
		if($this->session->userdata('logged_in') && $this->session->userdata('access_level') >= 8)
	  	{  
	  		$this->load->model('Model_userprofile');
			$data = array(
				  'type_id'=>1,
				  'parent_discussion_id'=>$discussion_id,
				  'discussion_name'=> '',
				  'discussion_content' => $this->input->post('content'),
				  'date'=>date("Y-m-d",time()),
				  'content_posted_by_user_id'=>$this->Model_userprofile->get_user_id($this->session->logged_in),
				  'status'=>1);
			$this->load->model('Model_discussions');
			$this->Model_discussions->form_insert($data);
			$data['message'] = 'Data Inserted Successfully';

			//Loading View
			$this->view($discussion_id);
		}else{
			redirect('Login');
		} 
  }

  public function deletediscussion($type, $id)
  {
  	if($this->session->userdata('logged_in_admin'))
	    {
	     	$this->load->model('Model_discussions');
	     	$this->Model_discussions->delete_discussion($id);
	     	switch ($type) {
	     		case 'discussion':
			        redirect('Discussions');
	     			break;

	     		case 'student-forum':
	     			redirect('StudentForum');
	     			break;
	     		case 'chapter':
	     			$this->Model_discussions->delete_chapter_discussion($id);
	     			redirect('Chapters');
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