  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chapters extends CI_Controller {
  public function index()
  { 
      $this->chaptersPage();
  }

  public function chaptersPage($pageno=1){

    if($this->session->userdata('logged_in'))
    { 
      if ($this->session->userdata('access_level') >= 10) {
        
        $this->load->model('Model_discussions');
        $this->load->model('Model_userprofile');

        $per_page = 8;
        $userdata = $this->Model_userprofile->get_personal_details($this->Model_userprofile->get_user_id($this->session->userdata('logged_in')));
        $user_city = $userdata[0]->city;
        $chapters= $this->Model_discussions->get_all_chapters($user_city,(($pageno-1)*$per_page)+1,$pageno*$per_page);
        //var_dump($chapters);
        $data['total_pages'] = $this->Model_discussions->get_total_pages(count($chapters),8);
        $data['ind'] = $pageno;
        $data['chapters'] = $chapters;
        $this->load->view('header.php');  
        $this->load->view('chapters.php',$data);
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

  public function doupload()
  {
    if($this->session->userdata('logged_in') && $this->session->userdata('access_level') >= 10)
    {
      $this->load->model('Model_discussions');
      $this->load->library('upload');
      $this->load->model('Model_userprofile');
      $this->load->library('form_validation');

      $this->form_validation->set_rules('title','title','trim|required');
      $this->form_validation->set_rules('content','content','trim|required');

      if ($this->form_validation->run()) 
      {
          $files = $_FILES;
          
          $cpt = count($_FILES['userfile']['name']);

          $no=$this->db->select('discussion_id')->order_by('discussion_id','desc')->limit(1)->get('discussions')->row('discussion_id');
          $no=$no+1;
          
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
                        'discussion_id'=>$no,
                        'image_extension'=> substr(strchr($_FILES['userfile']['name'],"."),1),
                        'image_id'=> $no.'_'.$_FILES['userfile']['name'],
                        'mime_type'=> $_FILES['userfile']['type']);
                $this->Model_discussions->form_insert_image($data1);
                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
              }
          }

          $data = array(
              'type_id'=>3,
              'parent_discussion_id'=>$no,
              'discussion_name'=> $this->input->post('title'),
              'discussion_content' => $this->input->post('content'),
              'date'=>date("Y-m-d",time()),
              'content_posted_by_user_id'=>$this->Model_userprofile->get_user_id($this->session->logged_in),
              'status'=>0);
          $this->Model_discussions->form_insert($data);
          $data['message'] = 'Data Inserted Successfully';
          
          // insertin in chapter_discussions
          $user_id = $this->Model_userprofile->get_user_id($this->session->logged_in);
          $query = $this->db->get_where('personal_detail',array('user_id' => $user_id));
          $res = $query->result();
          $city = $res[0]->city;
          $chap = array(
              'discussion_id' => $no,
              'city' => $city
          );

          $this->Model_userprofile->set_chapter_discussion($chap);
          redirect('chapters/chaptersPage');

      }else{
        // there are validation errors
        redirect('chapters/chaptersPage');
      }
    }
    else{
        redirect('Login');
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
    if($this->session->userdata('logged_in') && $this->session->userdata('access_level') >= 10)
    {
      $this->load->model('Model_userprofile');
      $this->load->model('Model_discussions');

      $data = array(
            'type_id'=>3,
            'parent_discussion_id'=>$discussion_id,
            'discussion_name'=> '',
            'discussion_content' => $this->input->post('content'),
            'date'=>date("Y-m-d",time()),
            'content_posted_by_user_id'=>$this->Model_userprofile->get_user_id($this->session->logged_in),
            'status'=>1);
      $this->Model_discussions->form_insert($data);
      $data['message'] = 'Data Inserted Successfully';

      //Loading View
      $this->view($discussion_id); 
    }
    else{
      redirect('Login');
    }
  }
}