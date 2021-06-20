<?php 

/**
* 
*/
class Model_users extends CI_Model
{
	// this function returns true if user has entered correct information, otherwise false
	public function can_log_in($email,$password){
		$this->db->where('login_name', $email);
		$query = $this->db->get('user_main');

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

	// this function hashes Password and returns the hashed password
	public function hashPassword($password){
		$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
		$hash = crypt($password, '$2y$12$' . $salt);
		return $hash;
	}
	
	/**
	 * check if a user is approved by the user
	 * @param  integer $user_id user id of the user
	 * @return boolean          true or false based on admin approval status
	 */
	private function get_admin_approval_status($user_id)
	{
		$this->db->select('admin_status');
		$query = $this->db->get_where('user_main', array('user_id' => $user_id));
		if ($query->result()[0]->admin_status) {
			return true;
		}else{
			return false;
		}
	}

	/**
	 * check if a user has approved his email
	 * @param  integer $user_id user id of the user
	 * @return boolean          true or false based on email verification
	 */
	private function get_email_verification_status($user_id)
	{
		$this->db->select('email_verification_status');
		$query = $this->db->get_where('personal_detail', array('user_id' => $user_id));
		if ($query->result()[0]->email_verification_status) {
			return true;
		}else{
			return false;
		}
	}

	/**
	 * returns levels based on admin approval and email verification status. This is used to show proper messages to user
	 * Access Levels: 
	 
	 * level 0 => not verified email or not approved by admin.

	 * level 1 => verified email but not approved by admin

	 * level 8=> verified by admin user_type = student, 8

	 * level 10 => verified by admin, user_type = alumni, 2

	 * level 20 => ADMIN, GOD, THE SAVIOUR
	 * 
	 * note: approved by admin only if verified his email
	 * @param  int $user_id 
	 * @return int          level of access
	 */
	public function get_user_access_level($user_id){
		$admin_approval_status = $this->get_admin_approval_status($user_id);
		$email_verification_status = $this->get_email_verification_status($user_id);
		$user_type = $this->get_user_type($user_id);

		// Usertype = 9 is for THE ADMIN. THE GOD. THE SAVIOUR.
		if ($user_type == 9) {
			return 20;
		}
		// not verified by admin, not verified email
		if (!$email_verification_status) {
			return 0;
		}
		// verified email but not approved by admin
		elseif($email_verification_status && !$admin_approval_status) {
			return 1;
		}
		// verified email and approved by admin, STUDENT
		else if($email_verification_status && $admin_approval_status && $user_type == 8){
			// verified student, level = 8
			return 8;
		}
		// verified email and approved by admin, ALUMNI
		else if($email_verification_status && $admin_approval_status && $user_type == 2){
			// verified student, level = 10
			return 10;
		}
		die();
	}
	
	public function is_registered_email($email){
		$this->db->where('login_name', $email);
		$query = $this->db->get('user_main');
		
		if ($query->num_rows() == 1) {
			return true;
		}else{
			return false;
		}
	}


	// this function inserts user details in a table
	public function insert_user($data, $table){
		if ($query = $this->db->insert($table, $data)) {
			return;
		}else{
			echo "an error occured!";
		}
	}

	public function get_user_type($user_id){
		$result= $this->db->select('user_type')->get_where('user_main', array('user_id' => $user_id))->result();
		return $result[0]->user_type;
	}

	public function get_user_id($login_name){
		$this->db->select('user_id');
		$query = $this->db->get_where('user_main',array('login_name' => $login_name));
		$res = $query->result();
		return $res[0]->user_id; 
	}

	public function get_email_verification_pin($token=''){
		if ($token == ''){
			return md5(uniqid(rand(), true));
		}else{
			$this->db->where(array('email_verification_pin'=>$token));
			$query = $this->db->update('personal_detail', array('email_verification_pin' => '', 'email_verification_status'=> 1));
			if ($this->db->affected_rows() > 0) {
				return 1;
			}else{
				return 0;
			}
		}
	}

	public function send_validation_mail($email, $pin){
		$message = "Congratulations! You have successfully registered in the alumni website. The completion of your registration is subject to approval by the admin.<br><br>We need to verify your email address before you can proceed furthur.<br><br><a href='http://gecnitrralumni.org/verify-user/".$pin."'>Click here</a> to verify your account";
		$subject = 'Greetings from GEC-NITRR Alumni Association! Just One More Step.';

		if($this->send_mail('admin@gecnitrralumni.org', 'Admin', $email, $subject, $message)){
			return 1;
		}else{
			return 0;
		}
	}

	private function get_password_reset_pin(){
		return md5(uniqid(rand(), true));
	}

	private function set_password_reset_pin($pin, $email){
		$this->db->where('email',$email);
		$data = array('password_reset_pin' => $pin);
		if ($this->db->update('personal_detail', $data)) {
			return 1;
		}else{
			return 0;
		}
	}

	public function set_new_password($email, $password){
		$this->db->where('login_name',$email);
		$hashed_password = $this->hashPassword($password);

		$data = array('password' => $hashed_password);
		if ($this->db->update('user_main', $data)) {
			$this->set_password_reset_pin(null, $email);
			return 1;
		}else{
			return 0;
		}
	}

	public function send_forgot_password_link($email){
		$pin = $this->get_password_reset_pin();
		// Store the Pin in database
		$this->set_password_reset_pin($pin, $email);

		$message = "Forgot your Password? No Worries!<br><br><a href='http://gecnitrralumni.org/Login/verify_forgot_password_pin/".$pin."?email=".$email."'>Click here</a> to reset your password.<br><hr><p>Didn't request a new password? Click <a href='#'>here</a> to destroy this link forever!";
		$subject = 'Reset Password';

		if($this->send_mail('admin@gecnitrralumni.org', 'Admin', $email, $subject, $message)){
		    //print_r("test1");
			return 1;
		}else{
			//print_r("test2");
			//exit(0);
			return 0;
		}
	}

	public function validate_password_reset_pin($email, $pin){
		$this->db->where(array('password_reset_pin'=>$pin, 'email'=>$email));
		if ($this->db->count_all_results('personal_detail') == 1) {
			return 1;
		}else{
			return 0;
		}
	}

	public function get_todays_birthdays()
	{
		$SQL = "SELECT * FROM `personal_detail` WHERE month(CURRENT_DATE) = month(`dob`) and day(CURRENT_DATE) = day(`dob`)";
		$result= $this->db->query($SQL);
		return $result->result_array();;

		
	}

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


}