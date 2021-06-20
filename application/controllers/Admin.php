<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  public function index()
  {
    $this->login();
  }

  public function login($errors = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->dashboard();
    } else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function dashboard()
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');
      $data['total_donations'] = $this->get_total_donation();
      $data['verified_users'] = $this->Model_admin->get_verified_users(); 
      $data['pending_users'] = $this->Model_admin->get_pending_verification_users(); 
      $data['no_of_donations'] = $this->Model_admin->get_no_of_donations(); 

      $this->load->view('admin/dashboard.php', $data);
    }else{
      $this->login();
    }
  }

  public function exportUserDataCSV(){
    // file name 
    $filename = 'users_data'.date('Ymd').'.csv'; 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$filename"); 
    header("Content-Type: application/csv; ");

    $this->load->model('Model_admin');
    $usersData = $this->Model_admin->export_user_data();
    // file creation 
    $file = fopen('php://output', 'w');
    
    $header = array("name", "gender", "dob", "address", "ph_number_1", "email", "user_id", "country", "state", "city", "ug_passing_year", "pg_passing_year", "branch_ug", "branch_pg", "degree_ug", "degree_pg", "company");
    fputcsv($file, $header); 

    foreach ($usersData as $key=>$line){
      fputcsv($file, (array)$line); 
    }

    fclose($file);
  }

  public function validateCredentials(){
    // validate the login and password an allow the user to log in
    $this->load->model('Model_admin');
    $this->load->library('form_validation');

    // remove previous errors
    $errors = null;
    
    $this->form_validation->set_rules('email','Email','required|trim|valid_email');
    $this->form_validation->set_rules('password','Password','required|trim|min_length[8]');

    if ($this->form_validation->run()) {

      $email= $this->input->post('email');
      $password= $this->input->post('password');
      $this->Model_admin->hashPassword($password);
      
      if($this->Model_admin->can_log_in($email, $password)){
            $this->session->set_userdata('logged_in_admin', $email);
            // delete the following one line, or maybe not
            // TODO: Refactor this code. It's too messy!
            $this->session->set_userdata('logged_in', $email);
              $this->session->set_userdata('access_level',10);
            $this->session->set_userdata('full_user_name', 'Admin');
            $this->session->set_userdata('email_verified', 1);


            redirect('Admin/dashboard');
        }
        else{
          $error['login_error'] = "Invalid Email/Password Combination";
          $this->login($error);
        }
    }else{
      $error['login_error'] = "Invalid Email/Password Combination";
      $this->login($error);
    }
  }

  public function logout($error = null){
    // logout
    $this->session->set_userdata('logged_in_admin', null);
    $this->session->set_userdata('logged_in', null);
    $this->session->set_userdata('access_level',null);
    $this->session->set_userdata('full_user_name', null);
    $this->session->set_userdata('email_verified', null);
    $this->session->sess_destroy();
    $this->login($error);
  }

  public function pendingapprovals($type='users')
  {
    $this->load->model('Model_admin');
    $this->load->model('Model_userprofile');

    switch ($type) {
      case 'users':
        if($this->session->userdata('logged_in_admin'))
        {
          $data['pending_users'] = $this->Model_admin->get_pending_users();
          
          if (!$data['pending_users']) {
            redirect('Admin');
          }

          $this->load->view('admin/users/pending_users.php', $data);
        }
        else
        {
          //If no session, redirect to admin-login page
          $this->load->view('header.php');  
          $this->load->view('admin/login.php', $errors=null);
          $this->load->view('footer.php');    
        }
        break;
      case 'discussions':
        if($this->session->userdata('logged_in_admin'))
        {
          $per_page = 8;

          $data['pending_posts'] = $this->Model_admin->get_pending_discussions(1,(($page-1)*$per_page)+1,$page*$per_page);
          $data['total_pages'] = $this->Model_admin->get_total_pages($this->Model_admin->get_pending_discussions(0),$per_page);
          $data['page_title'] = "Pending Discussions";
          
          if (!$data['pending_posts']) {
            redirect('Admin');
          }

          // to prevent users from going beyond pagination
          if ($page > $data['total_pages']) {
            redirect('Admin/pendingapprovals/discussions');
          }

          $this->load->view('header.php');  
          $this->load->view('admin/pending-posts.php', $data);
          $this->load->view('footer.php');
        }
        else
        {
          //If no session, redirect to admin-login page
          $this->load->view('header.php');  
          $this->load->view('admin/login.php', $errors=null);
          $this->load->view('footer.php');    
        }
        break;

        case 'chapters':
        if($this->session->userdata('logged_in_admin'))
        {
          $per_page = 8;

          $data['pending_posts'] = $this->Model_admin->get_pending_chapters(1,(($page-1)*$per_page)+1,$page*$per_page);
          $data['total_pages'] = $this->Model_admin->get_total_pages($this->Model_admin->get_pending_chapters(0),$per_page);
          $data['page_title'] = "Pending Chapter Discussions";

          if (!$data['pending_posts']) {
            redirect('Admin');
          }

          // to prevent users from going beyond pagination
          if ($page > $data['total_pages']) {
            redirect('Admin/pendingapprovals/chapters');
          }

          $this->load->view('header.php');  
          $this->load->view('admin/pending-posts.php', $data);
          $this->load->view('footer.php');
        }
        else
        {
          //If no session, redirect to admin-login page
          $this->load->view('header.php');  
          $this->load->view('admin/login.php', $errors=null);
          $this->load->view('footer.php');    
        }
        break;
        case 'student-forum':
        if($this->session->userdata('logged_in_admin'))
        {
          $per_page = 8;

          $data['pending_posts'] = $this->Model_admin->get_pending_student_forum(1,(($page-1)*$per_page)+1,$page*$per_page);
          $data['total_pages'] = $this->Model_admin->get_total_pages($this->Model_admin->get_pending_student_forum(0),$per_page);
          $data['page_title'] = "Pending Chapter Discussions";

          if (!$data['pending_posts']) {
            redirect('Admin');
          }

          // to prevent users from going beyond pagination
          if ($page > $data['total_pages']) {
            redirect('Admin/pendingapprovals/student-forum');
          }else

          $this->load->view('header.php');  
          $this->load->view('admin/pending-posts.php', $data);
          $this->load->view('footer.php');
        }
        else
        {
          //If no session, redirect to admin-login page
          $this->load->view('header.php');  
          $this->load->view('admin/login.php', $errors=null);
          $this->load->view('footer.php');    
        }
        break;
      default:
        redirect('Admin');
        break;
    }
  }
  
  ////////////////////
  // USER FUNCTIONS //
  ////////////////////
  
  // The Search Page
  public function users_search()
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->view('admin/users/search.php');
    }else{
      $this->login();
    }
  }

  // The Edit Page
  public function users_edit($user_id=null, $message = null){
    $this->load->library('form_validation');
    if($this->session->userdata('logged_in_admin'))
    {
      if ($user_id) {
        $this->load->model('Model_userprofile');
        $data['user'] = $this->Model_userprofile->get_personal_details($user_id)[0];
        $data['branches'] = $this->getAllBranches();
        $data['msg'] = $message;
        $this->load->view('admin/users/edit_user.php', $data);
      }else{
        $this->load->view('admin/users/edit.php');
      }
    }else{
      $this->login();
    }
  }

  public function users_edit_validate()
  { 
    $this->load->library('form_validation');
    $this->load->model('Model_users');
    

    $this->form_validation->set_rules('name','First Name','required|trim|alpha_numeric_spaces');
    $this->form_validation->set_rules('email','Email','required|trim|valid_email');
    $this->form_validation->set_rules('dob','Date of Birth','trim');
    $this->form_validation->set_rules('ph_number_1','Phone No 1','required|trim|numeric');
    $this->form_validation->set_rules('user_id','User ID','required|trim|numeric');
    $this->form_validation->set_rules('ph_number_2','Phone No 2','trim|numeric');
    $this->form_validation->set_rules('city','City','trim');
    $this->form_validation->set_rules('state','State','trim');
    $this->form_validation->set_rules('country','Country','trim');
    $this->form_validation->set_rules('about_me','About Me','trim');
    $this->form_validation->set_rules('address','Address','trim');

    $this->form_validation->set_rules('ug_batch','Passing Year','trim');
    $this->form_validation->set_rules('ug_degree','Degree Type','trim');
    $this->form_validation->set_rules('ug_branch','Degree','trim');

    $this->form_validation->set_rules('ug_batch','Passing Year','trim');
    $this->form_validation->set_rules('ug_degree','Degree Type','trim');
    $this->form_validation->set_rules('ug_branch','Degree','trim');
    
    $this->form_validation->set_rules('notes','Notes','trim');
    $user_id = $this->input->post('user_id');

    if ($this->form_validation->run()) {
      $this->load->model('Model_admin');

      $name = $this->input->post('name');
      $email = $this->input->post('email');
      $dob = $this->input->post('dob');
      $gender = $this->input->post('gender');
      $ph_number_1 = $this->input->post('ph_number_1');
      $ph_number_2 = $this->input->post('ph_number_2');
      $city = $this->input->post('city');
      $state = $this->input->post('state');
      $country = $this->input->post('country');
      $about_me = $this->input->post('about_me');
      $address = $this->input->post('address');
      $ug_batch = $this->input->post('ug_batch');
      $ug_degree = $this->input->post('ug_degree');
      $ug_branch = $this->input->post('ug_branch');
      $pg_batch = $this->input->post('pg_batch');
      $pg_degree = $this->input->post('pg_degree');
      $pg_branch = $this->input->post('pg_branch');
      $notes = $this->input->post('notes'); 

      $data = array(
        'user_id' => $user_id,
        'name' => $name,
        'gender' => $gender,
        'dob' => $dob,
        'address' => $address,
        'ph_number_1' => $ph_number_1,
        'email' => $email,
        'notes' => $notes,
        'country' => $country,
        'state' => $state,
        'city' => $city,
        'about_me' => $about_me,
        'ph_number_2' => $ph_number_2,
        'ug_passing_year' => $ug_batch,
        'pg_passing_year' => $pg_batch,
        'degree_ug' => $ug_degree,
        'degree_pg' => $pg_degree,
        'branch_ug' => $ug_branch,
        'branch_pg' => $pg_branch,
        );

      if($this->Model_admin->update_user($data)){
        $msg = "Update successful!";
        $this->users_edit($user_id, $msg);
      }else{
        $msg = "Update unsuccessful!";
        $this->users_edit($user_id, $msg);
      }
    }else{
      $msg = "There are errors!!";
        $this->users_edit($user_id, $msg);
    }
  }
  // Get Edit Search Results
  public function users_getEditSearchResults()
  {
     if($this->session->userdata('logged_in_admin'))
     {
      $name = trim($this->input->post('name'));
      $batch = trim($this->input->post('batch'));
      $branch = trim($this->input->post('branch'));

      $this->load->Model('Model_admin');

      $data['results'] = $this->Model_admin->search($name, $batch, $branch);
      $data['branches'] = $this->Model_admin->get_all_branches();

      $this->load->view('admin/users/edit_results_table', $data);
     }else{
       echo null;
     }
  }

  // Get Search Results
  public function users_getSearchResults()
  {
     if($this->session->userdata('logged_in_admin'))
     {
        $name = trim($this->input->post('name'));
        $batch = trim($this->input->post('batch'));
        $branch = trim($this->input->post('branch'));

        $this->load->Model('Model_admin');

        $data['results'] = $this->Model_admin->search($name, $batch, $branch);
        $data['branches'] = $this->Model_admin->get_all_branches();

        $this->load->view('admin/users/search_results_table', $data);
     }else{
       echo null;
     }
  }


  // Approve or Decline a user
  public function verifyuser($userid,$app)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($app) {
        
        case 'approve':
          if($this->Model_admin->verify_user($userid,1)){
            // redirect('Admin/pendingapprovals/users');
            echo 1;
          }else{
            echo 0;
          }
          break;
        case 'decline':
          if($this->Model_admin->verify_user($userid,2)){
            echo 1;
          }else{
            echo 0;
          }
          // redirect('Admin/pendingapprovals/users');
          break;  
          
        default:
          redirect('Admin/pendingapprovals/users');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function verifydiscussions($discussion_id,$app)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($app) {
        
        case 'approve':
          $this->Model_admin->verify_discussions($discussion_id,1);
          redirect('Admin/pendingapprovals/discussions');
          break;
        case 'decline':
          $this->Model_admin->verify_discussions($discussion_id,2);
          redirect('Admin/pendingapprovals/discussions');
          break;
        default:
          redirect('Admin/pendingapprovals/discussions');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function editUser($user_id)
  {
    if ($this->session->userdata('logged_in_admin')) {
      // show the edit user page
      $this->load->view('header.php');  
      $this->load->view('admin/edit-users.php');
      $this->load->view('footer.php');  
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function delete_user($user_id)
  {
    if ($this->session->userdata('logged_in_admin')) {
      // Delete the user.
      $this->load->model('Model_admin');
      if($this->Model_admin->delete_user($user_id)){
        echo 1;
      }else{
        echo 0;
      }

    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  private function getAllBranches()
  {
    $this->load->Model('Model_admin');
    return $this->Model_admin->get_all_branches();
  }

  ///////////////////////////////
  // PAYMENT GATEWAY FUNCTIONS //
  ///////////////////////////////

  public function view_successful_donations()
  {
    if ($this->session->userdata('logged_in_admin')) {
      // Show the Completed donations page.
      $this->load->Model('Model_giving_back');
      $data['results'] = $this->Model_giving_back->get_succesful_donations();
      $this->load->view('admin/giving-back/succesful-donations.php', $data);
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
    
  }

  private function get_total_donation()
  {
    $this->load->Model('Model_giving_back');
    $amt_obj = $this->Model_giving_back->get_total_donations();
    return $amt_obj[0]->amount;
  }

  private function get_completed_donations()
  {
    $this->load->Model('Model_giving_back');
    $completed_donations = $this->Model_giving_back->get_completed_donations();
    return $completed_donations[0];
  }

  ////////////////////
  // News Functions //
  ////////////////////
  
  public function list_news()
  {
    if ($this->session->userdata('logged_in_admin')) {
      // Show the Completed donations page.
      $this->load->Model('Model_news');
      $data['results'] = $this->Model_news->get_news();
      $this->load->view('admin/news/list-news.php', $data);
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function verifynews($main_content_id, $action)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($action) {
        
        case 'approve':
          if($this->Model_admin->verify_news($main_content_id,1)){
            echo 1;
          }else{
            echo 0;
          }
          break;
        case 'disapprove':
          if($this->Model_admin->verify_news($main_content_id,0)){
            echo 1;
          }else{
            echo 0;
          }
          // redirect('Admin/pendingapprovals/users');
          break;  
          
        default:
          redirect('Admin/pendingapprovals/users');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }    
  }

  public function edit_news($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_news');
      $this->load->model('Model_admin');
      
      if($main_content_id){
        $data['news_article'] = $this->Model_news->get_news($main_content_id);
        $data['page_title'] = "Edit News Article";
      }else{
        $data['news_article'] = null;
        $data['page_title'] = "Add News Article";
      }
      $this->load->view('admin/news/edit-news', $data);

    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function edit_news_submit($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('main_content_name','Title','required|trim');
      $this->form_validation->set_rules('content_date','Date','required|trim');
      $this->form_validation->set_rules('article_id','Article ID','trim|numeric');
      $this->form_validation->set_rules('content_category_id','Content Category ID','trim|numeric');
      $this->form_validation->set_rules('user_id','User ID','trim|numeric');
      $this->form_validation->set_rules('status','Status','required|trim|numeric');

      $this->form_validation->set_rules('content','Content','required|trim');

      if ($this->form_validation->run()) {
        $this->load->model('Model_news');
        $this->load->model('Model_users');
        
        if ($this->input->post('article_id') == '') {
          $data = array(
            'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
            'content_category_id' => 2,
            'main_content_id' => null,
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );  
        }else{
          $data = array(
            'content_posted_by_user_id' => $this->input->post('user_id'),
            'content_category_id' => $this->input->post('content_category_id'),
            'main_content_id' => $this->input->post('article_id'),
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );
        }
        if($this->Model_news->update_news($data)){
          echo 1;
        }else{
          echo 0;
        }

        
      }else{
          $msg = array(
            'title' => form_error('main_content_name'), 
            'content' => form_error('content')
          );
          var_dump($msg);
      } 
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    } 
  }


  ///////////////////////
  // Minutes Functions //
  ///////////////////////
  public function list_mom()
  {
    if ($this->session->userdata('logged_in_admin')) {
      // Show the Completed donations page.
      $this->load->Model('Model_mom');
      $data['results'] = $this->Model_mom->get_mom();
      $this->load->view('admin/mom/list-mom.php', $data);
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function verifymom($main_content_id, $action)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($action) {
        
        case 'approve':
          if($this->Model_admin->verify_mom($main_content_id,1)){
            echo 1;
          }else{
            echo 0;
          }
          break;
        case 'disapprove':
          if($this->Model_admin->verify_mom($main_content_id,0)){
            echo 1;
          }else{
            echo 0;
          }
          // redirect('Admin/pendingapprovals/users');
          break;  
          
        default:
          redirect('Admin/pendingapprovals/users');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }    
  }

  public function edit_mom($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_mom');
      $this->load->model('Model_admin');
      
      if($main_content_id){
        $data['mom_article'] = $this->Model_mom->get_mom($main_content_id);
        $data['page_title'] = "Edit MOM Article";
      }else{
        $data['mom_article'] = null;
        $data['page_title'] = "Add MOM Article";
      }
      $this->load->view('admin/mom/edit-mom', $data);

    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function edit_mom_submit($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('main_content_name','Title','required|trim');
      $this->form_validation->set_rules('content_date','Date','required|trim');
      $this->form_validation->set_rules('article_id','Article ID','trim|numeric');
      $this->form_validation->set_rules('content_category_id','Content Category ID','trim|numeric');
      $this->form_validation->set_rules('user_id','User ID','trim|numeric');
      $this->form_validation->set_rules('status','Status','required|trim|numeric');

      $this->form_validation->set_rules('content','Content','required|trim');

      if ($this->form_validation->run()) {
        $this->load->model('Model_mom');
        $this->load->model('Model_users');
        if ($this->input->post('article_id') == '') {
          $data = array(
            'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
            'content_category_id' => 1,
            'main_content_id' => null,
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );  
        }else{
          $data = array(
            'content_posted_by_user_id' => $this->input->post('user_id'),
            'content_category_id' => $this->input->post('content_category_id'),
            'main_content_id' => $this->input->post('article_id'),
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );
        }
        if($this->Model_mom->update_mom($data)){
          echo 1;
        }else{
          echo 0;
        }

        
      }else{
          $msg = array(
            'title' => form_error('main_content_name'), 
            'content' => form_error('content')
          );
          var_dump($msg);
      } 
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    } 
  }

  /////////////////////
  // Event Functions //
  /////////////////////
  public function list_event()
  {
    if ($this->session->userdata('logged_in_admin')) {
      // Show the Completed donations page.
      $this->load->Model('Model_events');
      $data['results'] = $this->Model_events->get_events();
      $this->load->view('admin/event/list-event.php', $data);
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function verifyevent($main_content_id, $action)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($action) {
        
        case 'approve':
          if($this->Model_admin->verify_event($main_content_id,1)){
            echo 1;
          }else{
            echo 0;
          }
          break;
        case 'disapprove':
          if($this->Model_admin->verify_event($main_content_id,0)){
            echo 1;
          }else{
            echo 0;
          }
          // redirect('Admin/pendingapprovals/users');
          break;  
        default:
          redirect('Admin/pendingapprovals/users');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }    
  }

  public function edit_event($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_events');
      $this->load->model('Model_admin');
      
      if($main_content_id){
        $data['event'] = $this->Model_events->get_events($main_content_id);
        $data['page_title'] = "Edit Event";
      }else{
        $data['event'] = null;
        $data['page_title'] = "Add Event";
      }
      $this->load->view('admin/event/edit-event', $data);

    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function edit_event_submit($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('main_content_name','Title','required|trim');
      $this->form_validation->set_rules('content_date','Date','required|trim');
      $this->form_validation->set_rules('article_id','Article ID','trim|numeric');
      $this->form_validation->set_rules('content_category_id','Content Category ID','trim|numeric');
      $this->form_validation->set_rules('user_id','User ID','trim|numeric');
      $this->form_validation->set_rules('status','Status','required|trim|numeric');

      $this->form_validation->set_rules('content','Content','required|trim');

      if ($this->form_validation->run()) {
        $this->load->model('Model_events');
        $this->load->model('Model_users');
        if ($this->input->post('article_id') == '') {
          $data = array(
            'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
            'content_category_id' => 3,
            'main_content_id' => null,
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );  
        }else{
          $data = array(
            'content_posted_by_user_id' => $this->input->post('user_id'),
            'content_category_id' => $this->input->post('content_category_id'),
            'main_content_id' => $this->input->post('article_id'),
            'content_date' => date('Y-m-d', strtotime($this->input->post('content_date'))),
            'status' => $this->input->post('status'),
            'main_content_name' => $this->input->post('main_content_name'),
            'content_text' => $this->input->post('content')
          );
        }
        if($this->Model_events->update_event($data)){
          echo 1;
        }else{
          echo 0;
        }

        
      }else{
          $msg = array(
            'title' => form_error('main_content_name'), 
            'content' => form_error('content')
          );
          var_dump($msg);
      } 
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    } 
  }

  //////////////////////////
  // Discussion Functions //
  //////////////////////////
  public function list_discussion($type_id = 1)
  {

    switch ($type_id) {
      case 1:
        $data['page_title'] = "Discussions";
        break;
      case 2:
        $data['page_title'] = "Student Forum";
        break;
      case 3:
        $data['page_title'] = "Chapters";
        break;

    }

    if ($this->session->userdata('logged_in_admin')) {
      // Show the Completed donations page.
      $this->load->Model('Model_discussions');
      $data['results'] = $this->Model_discussions->get_discussion($type_id);
      $data['type_id'] = $type_id;
      $this->load->view('admin/discussions/list-discussions.php', $data);
    }else{
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function verify_discussion($main_content_id, $action)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_admin');

      switch ($action) {
        
        case 'approve':
          if($this->Model_admin->verify_discussion($main_content_id,1)){
            echo 1;
          }else{
            echo 0;
          }
          break;
        case 'disapprove':
          if($this->Model_admin->verify_discussion($main_content_id,0)){
            echo 1;
          }else{
            echo 0;
          }
          // redirect('Admin/pendingapprovals/users');
          break;  
        default:
          redirect('Admin/pendingapprovals/users');
          break;
      }
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }    
  }

  public function edit_discussion($type_id =1, $main_content_id = null)
  {
    switch ($type_id) {
      case 1:
       $title = "Discussion";
        break;
      case 2:
       $title = "Student Forum";
        break;
      case 3:
       $title = "Chapter";
        break;

    }
    $data['type_id'] = $type_id;
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->model('Model_discussions');
      $this->load->model('Model_admin');
      
      if($main_content_id){
        $data['result'] = $this->Model_discussions->get_discussion($type_id, $main_content_id);
        // var_dump($data['result']);
        // die();
        $data['page_title'] = "Edit ". $title;
      }else{
        $data['result'] = null;
        $data['page_title'] = "Add ". $title;
      }
      $this->load->view('admin/discussions/edit-discussions', $data);

    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    }
  }

  public function edit_discussion_submit($main_content_id = null)
  {
    if($this->session->userdata('logged_in_admin'))
    {
      $this->load->library('form_validation');

      $this->form_validation->set_rules('discussion_name','Title','required|trim');
      $this->form_validation->set_rules('date','Date','required|trim');
      $this->form_validation->set_rules('discussion_id','Article ID','trim|numeric');
      $this->form_validation->set_rules('type_id','Content Category ID','trim|numeric');
      $this->form_validation->set_rules('user_id','User ID','trim|numeric');
      $this->form_validation->set_rules('status','Status','required|trim|numeric');
      $this->form_validation->set_rules('discussion_content','discussion_content','required|trim');

      if ($this->form_validation->run()) {
        $this->load->model('Model_discussions');
        $this->load->model('Model_users');
        if ($this->input->post('discussion_id') == '') {
          $data = array(
            'content_posted_by_user_id' => $this->Model_users->get_user_id($this->session->userdata('logged_in_admin')),
            'type_id' => $this->input->post('type_id'),
            'discussion_id' => null,
            'parent_discussion_id' => $this->Model_discussions->get_parent_discussion_id(),
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'status' => $this->input->post('status'),
            'discussion_name' => $this->input->post('discussion_name'),
            'discussion_content' => $this->input->post('discussion_content')
          );  
        }else{
          $data = array(
            'content_posted_by_user_id' => $this->input->post('user_id'),
            'type_id' => $this->input->post('type_id'),
            'discussion_id' => $this->input->post('discussion_id'),
            'date' => date('Y-m-d', strtotime($this->input->post('date'))),
            'status' => $this->input->post('status'),
            'discussion_name' => $this->input->post('discussion_name'),
            'discussion_content' => $this->input->post('discussion_content')
          );
        }
        if($this->Model_discussions->update_event($data)){
          echo 1;
        }else{
          echo 0;
        }

        
      }else{
          $msg = array(
            'title' => form_error('discussion_name'), 
            'discussion_content' => form_error('content')
          );
          var_dump($msg);
      } 
    } 
    else
    {
      //If no session, redirect to admin-login page
      $this->load->view('header.php');  
      $this->load->view('admin/login.php', $errors=null);
      $this->load->view('footer.php');    
    } 
  }  
}