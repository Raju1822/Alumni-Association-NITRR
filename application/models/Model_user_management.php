<?php 

/**
* 
*/
class Model_user_management extends CI_Model
{

	// this function hashes Password and returns the hashed password
	private function hashPassword($password){
		$salt = substr(strtr(base64_encode(openssl_random_pseudo_bytes(22)), '+', '.'), 0, 22);
		$hash = crypt($password, '$2y$12$' . $salt);
		return $hash;
	}

	public function encrypt_passwords()
	{
		$query = $this->db->where('user_id =',4350)->get('user_main');
		set_time_limit(1500);
		foreach ($query->result() as $row)
		{
		    $hashedPassword = $this->hashPassword($row->password);
		    $this->db->where('login_name', $row->login_name);
		    $data = array('password' => $hashedPassword);

		    if ($this->db->update('user_main',$data)){
				echo "<p style='color:green'>Updated for ".$row->login_name."<\p>";
			}else{
				echo "<p style='color:red'>Cannot Update for".$row->login_name."<\p>";
				return 0;
			}
		}
	}
}

// 4350
