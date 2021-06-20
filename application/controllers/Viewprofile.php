<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewprofile extends CI_Controller {

public function index($user_id = null)
{
    $this->user($user_id);
}

public function user($user_id = null)
    {
        if (($this->session->userdata('logged_in') || $this->session->userdata('logged_in_admin'))  && $this->session->userdata('access_level') >= 8) {
            $this->load->view('header.php');
            $this->load->model('Model_userprofile');

            if (!$user_id) {
                $login_name = $this->session->userdata('logged_in');
                $user_id = $this->Model_userprofile->get_user_id($login_name);
            }

            $education = $this->Model_userprofile->get_user_education($user_id);
            $personal_details = $this->Model_userprofile->get_personal_details($user_id);
            $skills = $this->Model_userprofile->get_user_skills($user_id);
            $jobs = $this->Model_userprofile->get_user_jobs($user_id);
            $projects = $this->Model_userprofile->get_user_projects($user_id);
            $profile_picture = $this->Model_userprofile->get_profile_picture($user_id);
            if ($user_id > 6398) {
                $branch = $this->Model_userprofile->get_user_branch(@$personal_details[0]->branch_ug);
                $branch = $branch[0]->Branch;
            }else{
                $branch = @$personal_details[0]->branch_ug;                 
            }

            $email = $this->Model_userprofile->get_user_email($user_id);

            $data['education'] = $education;
            $data['personal_details'] = $personal_details;
            $data['user_branch'] = $branch;
            $data['user_email'] = $email;
            $data['skills'] = $skills;
            $data['jobs'] = $jobs;
            $data['projects'] = $projects;
            $data['profile_picture'] = $profile_picture;
            $this->load->view('public-user-profile.php', $data);
            $this->load->view('footer.php');
        }else{
            redirect('login');      
        }
    }

}