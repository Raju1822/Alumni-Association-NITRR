<?php 

class Model_admin extends CI_Model
{
	public function get_user_id($login_name){
		$this->db->select('user_id');
		$query = $this->db->get_where('user_main',array('login_name' => $login_name));
		$res = $query->result();
		return $res[0]->user_id; 
	}

	public function can_log_in($email,$password){
		// user_type = 9 for admin
		$query = $this->db->get_where('user_main',$arrayName = array('login_name'=> $email, 'user_type' => 9 ));
		
		if ($query->num_rows() == 1) {
			$result  = $query->result();
			
			// no for each needed as there is only one row in the result.
			$hash =  $result[0]->password;

			if($hash == crypt($password,$hash)){
				return true;
				// user has entered a valid password and email combination
			}else{
				return false;
				// user has entered an invalid password and email combination
			}

		}else{
			return false;
			// user has entered an invalid email.
		}
	}

	public function hashPassword($password){
		$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
		$hash = crypt($password, '$2y$12$' . $salt);
		return $hash;
	}

	public function get_all_users($flag=1,$lower=null,$upper=null)
	{
		$query = $this->db->get('user_main');

		if($flag == 1){
			if ($lower && $upper) {
				$query = $this->db->limit($lower,$upper);
			}
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}

	/**
	 * returns the details of users, who are pending for approval
	 * @param  integer $flag  if 1 returns the data, if 0 returns number of pending users
	 * @param  integer  $lower lowerbound for pagination
	 * @param  integer  $upper upper bound for pagination
	 * @return integer or object based on the value of flag
	 */
	public function get_pending_users($flag=1, $upper=null, $perpage=null)
	{
		$this->load->model('Model_userprofile');
		$query = $this->db->query("SELECT `login_name`,`user_id` FROM `user_main` WHERE `admin_status` = 0");
		$users = $query->result();

		foreach ($users as $key => $user) {
			$email = $this->Model_userprofile->get_user_email($user->user_id);
			$personal_details = $this->Model_userprofile->get_personal_details($user->user_id);

			// Get branch
			//TODO: 6398 is the time when we changed to the new website, NEED TO FIX THIS. IN OLDER DATABSE BRANCH IS STORED INSTEAD OF BRANCH CODE. 
			if ($user->user_id > 6398) {
				$branch = $this->Model_userprofile->get_user_branch(@$personal_details[0]->branch_ug);
				$branch = @$branch[0]->Branch;
			}else{
				$branch = @$personal_details[0]->branch_ug;					
			}

			// get passing year
			$users[$key]->passing_year = @$personal_details[0]->ug_passing_year;
			$users[$key]->name = @$personal_details[0]->name;
			$users[$key]->email_verification_status = @$personal_details[0]->email_verification_status;
			$users[$key]->email = $email ;
			$users[$key]->branch = $branch ;
		}
		// foreach ($users as $user) {
		// 	echo "<pre>";
		// 	var_dump($user);
		// 	echo "</pre>";
		// }
		// die();
		return $users;
		
	}

	public function get_total_discussions($flag=1,$lower=null,$upper=null)
	{
		$this->db->where("discussion_id = parent_discussion_id AND type_id=1");
		$query = $this->db->get('discussions');
		if($flag == 1){
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}
	
	public function get_pending_discussions($flag=1,$lower=null,$upper=null)
	{
		// TODO: Remove the fucking query!!!!!!!!!
		$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 1 AND `status` = 0");

		if($flag == 1){
			
			if (($lower) && ($upper)) 
			{	
				$lower--;
				// TODO: Remove the fucking query!!!!!!!!!

				$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 1 AND `status` = 0 LIMIT $lower, $upper");
			}
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}

	public function get_total_chapters($flag=1,$lower=null,$upper=null)
	{
	
		$this->db->where("discussion_id = parent_discussion_id AND type_id=3");
		$query = $this->db->get('discussions');
		if($flag == 1){
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}
	public function get_pending_chapters($flag=1,$lower=null,$upper=null)
	{
		// TODO: Remove the fucking query!!!!!!!!!

		$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 3 AND `status` = 0");

		if($flag == 1){
			
			if (($lower) && ($upper)) 
			{	
				$lower--;
				// TODO: Remove the fucking query!!!!!!!!!
				$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 3 AND `status` = 0 LIMIT $lower, $upper");
			}
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}
	public function get_total_student_forum($flag=1,$lower=null,$upper=null)
	{

		$this->db->where("discussion_id = parent_discussion_id AND type_id=2");
		$query = $this->db->get('discussions');
		if($flag == 1){
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}
	public function get_pending_student_forum($flag=1,$lower=null,$upper=null)
	{
		// TODO: Remove the fucking query!!!!!!!!!
		$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 2 AND `status` = 0");

		if($flag == 1){
			
			if (($lower) && ($upper)) 
			{	
				$lower--;
				// TODO: Remove the fucking query!!!!!!!!!
				$query = $this->db->query("SELECT * FROM `discussions` WHERE `discussion_id` = `parent_discussion_id` AND `type_id` = 2 AND `status` = 0 LIMIT $lower, $upper");
			}
			return $query->result();
		}else{
			return $query->num_rows();
		}
	}

	public function get_total_pages($total_items,$perpage )
	{
		if ($total_items % $perpage == 0) {
            return $total_items / $perpage;
        }else{
            return $total_items / $perpage + 1;
        }
	}

	private function get_user_email($user_id){
		$this->db->select('login_name');
		$query = $this->db->get_where('user_main',array('user_id' => $user_id));
		$res = $query->result();
		return $res[0]->login_name; 
	}

	public function verify_user($user_id = null, $app)
	{

		if ($user_id && $app) {
			if ($app == 1) {
				$this->db->where('user_id',$user_id);
				$this->db->update('user_main',array('admin_status'=>1));
				$email = $this->get_user_email($user_id);
				if ($this->send_admin_verification_message($email)) {
					return 1;
				}
			}elseif($app == 2){
				$this->db->where('user_id',$user_id);
				$this->db->delete('user_main');
				return 1;
			}
		}
		return 0;
	}

	public function delete_user($user_id)
	{
			$this->db->where('user_id',$user_id);
			$this->db->delete('user_main');

			$this->db->where('user_id',$user_id);
			$this->db->delete('personal_detail');

			$this->db->where('user_id',$user_id);
			$this->db->delete('user_projects');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('user_skills');

			$this->db->where('user_id',$user_id);
			$this->db->delete('user_education');
			
			$this->db->where('user_id',$user_id);
			$this->db->delete('profile_pic');
			
			return 1;	
	}

	public function verify_discussions($discussion_id = null, $app)
	{

		if ($discussion_id && $app) {
			if ($app == 1) {
				$this->db->where('discussion_id',$discussion_id);
				$this->db->update('discussions',array('status'=>1));
			}elseif($app == 2){
				
				$this->db->where('discussion_id',$discussion_id);
				$this->db->delete('discussions');
				$this->db->where('parent_discussion_id',$discussion_id);
				$this->db->delete('discussions');
				
				// for chapters_discussion table
				$this->db->where('discussion_id',$id);
				$this->db->delete('chapter_discussion');
			}
		}
	}

	/**
	 * send email to a user after his email verification
	 * @param  email  $email reciever's address
	 * @return true or false based on whether the email was sent
	 */
	public function send_admin_verification_message($email){

		$message = '<div style="padding:0;border:1px solid #e4e4e4;margin:0">
						<h2 style="text-align:center;background-color:#392064; color:#fff;margin-top:0;padding:10px 5px;">Dear Alumni</h2>
						<div class="body" style="padding:10px 10px;">
							Congratulations! Your account has been verified by the Admin GEC-NITRR Alumni Association. <br><br>
							Now you can access the the alumni data base, see photographs, upload photographs, participate in discussions and can even start a discussion. And much more as we keep improving the website. <br><br>
							We also request you to make one time deposit of Rs. 1000.00 only as registration fee in the following account and inform us accordingly at <a href="mailto:secretary@gecnitrralumni.org">secretary@gecnitrralumni.org</a>. <br><br>
							You can now also pay online by clicking here: <a href="http://gecnitrralumni.org/GivingBack">http://gecnitrralumni.org/GivingBack</a>
							<br><br>
							Name of Account - Alumni Association of GECNIT <br>
							A/c No. - 30094473156 <br>
							Bank - State Bank Of India <br> 
							Branch - GCET Branch, Raipur <br>
							<br><br>
							Thanking You <br>
							Alumni Association Executive Committee <br>
						</div>
					</div>';
		$subject = 'Congratulations on successful verification of your account at GEC-NITRR Alumni Website. ';

		if($this->send_mail('admin@gecnitrralumni.org', 'Admin', $email, $subject, $message)){
			return 1;
		}else{
			return 0;
		}
	}

	/**
	 * Private function for sending emails
	 * @param  text $fromEmail email from
	 * @param  text $fromName  Name of sender
	 * @param  text $toEmail   reciever email
	 * @param  text $subject   subject
	 * @param  text $message   message of the email
	 * @return boolean            true or false based on the email sent
	 */
	private function send_mail($fromEmail,$fromName, $toEmail, $subject, $message){
		$config['mailtype'] = 'html';
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from($fromEmail, $fromName);
		$this->email->to($toEmail);
		$this->email->subject($subject);
		$this->email->message($message);

		if($this->email->send()){
			return 1;
		}else{
			return 0;
		}
	}

	/////////////////////
	// Search function //
	/////////////////////
	
	public function search($name=null, $batch=null, $branch=null)
	{

		if ($name=="") {
			$name=null;
		}
		if ($branch=="") {
			$branch=null;
		}
		if ($batch=="") {
			$batch=null;
		}
		$this->db->select("*");
		$this->db->from("personal_detail");
		if (!is_null($name)) {
			$this->db->like('name', $name);
		}
		if (!is_null($branch)) {
			$this->db->where('branch_ug', $branch);
			$this->db->or_where('branch_pg', $branch);
		}

		if (!is_null($batch)) {
			$this->db->where('ug_passing_year', $batch);
			$this->db->or_where('pg_passing_year', $batch);
		}
		return $this->db->get()->result();
	}

	public function get_all_branches()
	{
		return $this->db->select('BranchId, Branch')->get('branch')->result();
	}
	// Update Users details
	public function update_user($data)
	{
		if ($query = $this->db->replace('personal_detail', $data)) {
			return 1;
		}else{
			echo "Sorry an error occured!";
			return 0;
		}
	}

////////////////////
// NEWS FUNCTIONS //
////////////////////
	public function verify_news($content_id, $action)
	{
		if ($action == 1) {
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>1))){
				return true;	
			}else{
				return false;
			}
			
		}else{
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>0))){
				return true;
			}else{
				return false;
			}	
			
		}
				
	}

////////////////////
// MOM FUNCTIONS //
////////////////////
	public function verify_mom($content_id, $action)
	{
		if ($action == 1) {
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>1))){
				return true;	
			}else{
				return false;
			}
		}else{
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>0))){
				return true;
			}else{
				return false;
			}	
		}	
	}

	////////////////////
	// Event FUNCTIONS //
	////////////////////
	public function verify_event($content_id, $action)
	{
		if ($action == 1) {
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>1))){
				return true;	
			}else{
				return false;
			}
		}else{
			$this->db->where('main_content_id',$content_id);
			if($this->db->update('main_content',array('status'=>0))){
				return true;
			}else{
				return false;
			}	
		}	
	}

	//////////////////////////
	// Discussion Functions //
	//////////////////////////
	public function verify_discussion($content_id, $action)
	{
		if ($action == 1) {
			$this->db->where('discussion_id',$content_id);
			if($this->db->update('discussionss',array('status'=>1))){
				return true;	
			}else{
				return false;
			}
		}else{
			$this->db->where('discussion_id',$content_id);
			if($this->db->update('discussions',array('status'=>0))){
				return true;
			}else{
				return false;
			}	
		}	
	}

	////////////////////////
	// Dahboard Functions //
	////////////////////////
	
	public function get_verified_users()
	{
		$query = $this->db->select('count(*) as a')->where(array('admin_status' => 1 ))->get('user_main');
		return $query->result()[0]->a;
	}
	public function get_pending_verification_users()
	{
		// $query = $this->db->select('count(*)')->order_by('discussion_id','desc')->limit(1)->get('discussions')->row('discussion_id');
		$query = $this->db->select('count(*) as a')->where(array('admin_status' => 0 ))->get('user_main');
		return $query->result()[0]->a;
	
	}

	public function get_no_of_donations()
	{
		$query = $this->db->select('count(*) as a')->get('completed_donations');
		return $query->result()[0]->a;
	}

	public function export_user_data()
	{
		$query = $this->db->query("SELECT
			    personal_detail.name,
			    personal_detail.gender,
			    personal_detail.dob,
			    personal_detail.address,
			    personal_detail.ph_number_1,
			    personal_detail.email,
			    personal_detail.user_id,
			    personal_detail.country,
			    personal_detail.state,
			    personal_detail.city,
			    personal_detail.ug_passing_year,
			    personal_detail.pg_passing_year,
			    personal_detail.branch_ug,
			    personal_detail.branch_pg,
			    personal_detail.degree_ug,
			    personal_detail.degree_pg,
			    user_jobs.company
			FROM
			    personal_detail
		    LEFT JOIN user_jobs ON personal_detail.user_id = user_jobs.user_id");

		$personal_details = $query->result();

		$query = $this->db->query("SELECT branch.BranchId, branch.Branch from branch");		
		
		$branches = $query->result();
		$branchesMap = array();
		
		foreach ($branches as $key => $value) {
			$branchesMap[$value->BranchId] = $value->Branch;
		}

		$query = $this->db->query("SELECT degree.DegreeId, degree.DegreeName from degree");		
		
		$degreesMap = array();
		$degrees = $query->result();

		foreach ($degrees as $key => $value) {
			$degreesMap[$value->DegreeId] = $value->DegreeName;
		}

		foreach ($personal_details as $key => $value) {
			$value->branch_ug = ($value->branch_ug > 0) ?  $branchesMap[$value->branch_ug] : $value->branch_ug;
			$value->degree_ug = ($value->degree_ug > 0) ?  $degreesMap[$value->degree_ug] : $value->degree_ug;
		}

		return $personal_details;
	}
}