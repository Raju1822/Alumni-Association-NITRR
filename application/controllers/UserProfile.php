<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserProfile extends CI_Controller {

	public function index()
	{
		$this->userProfilePage();
	}

	public function userProfilePage(){
		if ($this->session->userdata('logged_in')) {
			$this->load->view('header.php');
        	$this->load->model('Model_userprofile');

            $login_name = $this->session->userdata('logged_in');
        	$user_id = $this->Model_userprofile->get_user_id($login_name);

        	$education = $this->Model_userprofile->get_user_education($user_id);
        	$personal_details = $this->Model_userprofile->get_personal_details($user_id);
        	$skills = $this->Model_userprofile->get_user_skills($user_id);
        	$jobs = $this->Model_userprofile->get_user_jobs($user_id);
        	$projects = $this->Model_userprofile->get_user_projects($user_id);
            $profile_picture = $this->Model_userprofile->get_profile_picture($user_id);

            
    		$data['education'] = $education;
    		$data['personal_details'] = $personal_details;
    		$data['skills'] = $skills;
    		$data['jobs'] = $jobs;
    		$data['projects'] = $projects;
            $data['profile_picture'] = $profile_picture;
            
            $this->load->view('user-profile.php', $data);
            
			$this->load->view('footer.php');
		}else{
          //  exit(0);
			redirect('Login');		
		}
    }

	public function edit($errors = null){
		if ($this->session->userdata('logged_in')) {
            	$this->load->view('header.php');
            	$this->load->model('Model_userprofile');

            	$login_name = $this->session->userdata('logged_in');
            	
            	$user_id = $this->Model_userprofile->get_user_id($login_name);

            	$education = $this->Model_userprofile->get_user_education($user_id);
            	$personal_details = $this->Model_userprofile->get_personal_details($user_id);
            	$skills = $this->Model_userprofile->get_user_skills($user_id);
            	$jobs = $this->Model_userprofile->get_user_jobs($user_id);
            	$projects = $this->Model_userprofile->get_user_projects($user_id);
                $profile_picture = $this->Model_userprofile->get_profile_picture($user_id);

                $data['user_id'] = $user_id;
        		$data['educations'] = $education;
        		$data['personal_details'] = $personal_details;
        		$data['skills'] = $skills;
        		$data['jobs'] = $jobs;
        		$data['projects'] = $projects;
                $data['errors'] = $errors;
                $data['profile_picture'] = $profile_picture;

				$this->load->view('edit-userprofile.php', $data);
            	

				$this->load->view('footer.php');
		}else{
			
			redirect('Login');		
		}
	}

    public function personalDetailsValdation(){
        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $this->form_validation->set_rules('gender','Gender','required');
        $this->form_validation->set_rules('dob','Date of Birth','required');
        $this->form_validation->set_rules('about-me','about-me','trim');
        $this->form_validation->set_rules('address','Address','trim');
        $this->form_validation->set_rules('city','city','required');
        $this->form_validation->set_rules('country','Country','required|trim');
        $this->form_validation->set_rules('ph-no-1','Phone Number 1','required|trim');
        $this->form_validation->set_rules('ph-no-2','Phone Number 2','trim');
        $this->form_validation->set_rules('marital-status','Marital Status','required|trim');
        $this->form_validation->set_rules('notes','Notes','trim');

        if ($this->form_validation->run()) {
            $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
            $data = array(
                'gender' => $this->input->post('gender'),
                'marital_status_id' => $this->input->post('marital-status'),
                'dob' => $this->input->post('dob'),
                'address' => $this->input->post('address'),
                'notes' => $this->input->post('notes'),
                'about_me' => $this->input->post('about-me'),
                'country' => $this->input->post('country'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'ph_number_1' => $this->input->post('ph-no-1'),
                'ph_number_2' => $this->input->post('ph-no-2')
            );

            if($this->Model_userprofile->set_personal_details($data, $user_id)){
                redirect('userProfile/edit');
            }
        }
        else{
            $data['personal_detail_errors'] = validation_errors();
            $this->edit($data);
        }
    }

    public function educationValidation(){

        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $form_length = count($this->input->post('institute'));

        $this->form_validation->set_rules("institute[]",'Institute','required');
        $this->form_validation->set_rules("course[]",'course','required|trim');
        $this->form_validation->set_rules("feild_of_study[]",'Feild of Study','required|trim');
        $this->form_validation->set_rules("edu-date-from[]",'Date From','required');
        $this->form_validation->set_rules("edu-date-to[]",'Date to');
        
        if ($this->form_validation->run()) {
            $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
            
            $this->Model_userprofile->delete_user_education(array('user_id' => $user_id));

            for ($i = 0; $i < $form_length; $i++) { 
                
                if ($this->input->post("current-education[$i]")) {
                    // if it is then se to => 00 00 0000
                    $to = null;
                }else{
                    $to = $this->input->post("edu-date-to[$i]");
                }
                $data = array(
                    'user_id' => $this->Model_userprofile->get_user_id($this->session->logged_in),
                    'institute' => $this->input->post("institute[$i]"),
                    'course' => $this->input->post("course[$i]"),
                    'major_field_of_study' => $this->input->post("feild_of_study[$i]"),
                    'from' => $this->input->post("edu-date-from[$i]"),
                    'to' => $to
                );
                $this->Model_userprofile->set_user_education($data);
            }
                redirect('userProfile/edit');
        }else{
            $data['education_errors'] = validation_errors();
            $this->edit($data);
        }
    }

    public function jobValidation(){
        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $form_length = count($this->input->post('company'));
        
        
        $this->form_validation->set_rules('company[]','company','required');
        $this->form_validation->set_rules('designation[]','designation','required|trim');
        $this->form_validation->set_rules('job-description[]','Job Description','required|trim');
        $this->form_validation->set_rules('job-date-from[]','Date From','required');
        $this->form_validation->set_rules('job-date-to[]','Date to');

        if ($this->form_validation->run()) {
            $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
            // $this->Model_userprofile->delete_user_jobs(array('user_id' => $user_id));

            for ($i = 0; $i < $form_length; $i++) { 
                if ($this->input->post("current-work[$i]")) {
                    // if it is then se to => 00 00 0000
                    $to = null;
                }else{
                    $to = $this->input->post("job-date-to[$i]");
                }
                $data = array(
                    'user_id' => $this->Model_userprofile->get_user_id($this->session->logged_in),
                    'company' => $this->input->post("company[$i]"),
                    'designation' => $this->input->post("designation[$i]"),
                    'description' => $this->input->post("job-description[$i]"),
                    'from' => $this->input->post("job-date-from[$i]"),
                    'to' => $to
                );
                
                $this->Model_userprofile->set_user_jobs($data);
            }
                redirect('userProfile/edit');

        }

        else{
            $data['job_errors'] = validation_errors();
            $this->edit($data);
        }
    }

    public function projectsValidation(){
        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $form_length = count($this->input->post('project_name'));

        $this->form_validation->set_rules('project_name[]','project name','required');
        $this->form_validation->set_rules('project_details[]','project details','required|trim');
        $this->form_validation->set_rules('skills_used[]','skills used','required|trim');
        $this->form_validation->set_rules('project_from[]','Date From','required');
        $this->form_validation->set_rules('project_to[]','Date to');

        if ($this->form_validation->run()) {
            $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
            $this->Model_userprofile->delete_user_projects(array('user_id' => $user_id));

            for ($i = 0; $i < $form_length; $i++)
             {
                if ($this->input->post("current-project[$i]")) {
                    // if it is then se to => 00 00 0000
                    $to = null;
                }else{
                    $to = $this->input->post("project_date_to[$i]");
                }
                $data = array(
                    'user_id' => $this->Model_userprofile->get_user_id($this->session->logged_in),
                    'project_name' => $this->input->post("project_name[$i]"),
                    'project_details' => $this->input->post("project_details[$i]"),
                    'skills_used' => $this->input->post("skills_used[$i]"),
                    'from' => $this->input->post("project_from[$i]"),
                    'to' => $to
                );

                $this->Model_userprofile->set_user_projects($data);
            }

            redirect('userProfile/edit');
        }

        else{
            $data['project_errors'] = validation_errors();
            $this->edit($data);
        }
    }

    public function skillsValidation(){
        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $this->form_validation->set_rules('user-skill','User Skill','required');

        if ($this->form_validation->run()) {
            $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
            $data = array(
                'user_id' => $this->Model_userprofile->get_user_id($this->session->logged_in),
                'skill' => $this->input->post('user-skill')
            );

            if($this->Model_userprofile->set_user_skills($data, $user_id)){
                redirect('userProfile/edit');
            }
        }

        else{
            $data['skill_errors'] = validation_errors();
            $this->edit($data);
        }
    }

    public function deleteSkill()
    {
        $this->load->library('form_validation');
        $this->load->model('Model_userprofile');

        $data = array(
            'user_id' => $this->input->post('user-id'),
            'skill' => $this->input->post('user-skill')
        );

        if($this->Model_userprofile->delete_userskill($data)){
            echo 'Completed';
        }else{
            echo 'Bad things happend';
        }
    }

    public function uploadProfilePicture()
    {
        if ($this->session->userdata('logged_in')) {
            
            $this->load->helper('form');
            $this->load->helper('url');

            $config['upload_path'] = "profile_pictures/";
            $config['allowed_types'] = "jpg|jpeg|png";
            $config['encrypt_name'] = true;
            $config['overwrite'] = true;
            $config['max_size'] = "2000";
            $config['max_width'] = "1920";
            $config['max_height'] = "1080";
            $this->load->library('upload',$config);
            // if file upload was not successful
            if(!$this->upload->do_upload('file_name'))
            {
                $data['image_errors'] = $this->upload->display_errors();
                $this->edit($data);
            }
            else
            {
                $this->load->model('Model_userprofile');

                $finfo=$this->upload->data();
                $file = $finfo['file_name'];
                $username = $this->session->userdata('logged_in');
                $user_id = $this->Model_userprofile->get_user_id($username);
                
                if($this->Model_userprofile->update_profile_picture($file, $user_id) == 1){
                    // successfully uploaded file
                    redirect('userProfile/edit');
                }else{
                    // Some error occured
                    $data['image_errors'] = "An error occured, please try again later.";
                    $this->edit($data);
                }
            }
        }else{
            redirect('Login');
        }
    }


   

    
}