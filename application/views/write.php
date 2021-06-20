<?php
$email=$_SESSION['logged_in'];
$data1=$this->db->query("SELECT * FROM user_main where `login_name`='$email' order by content_date desc");
$row=$data1->row();
$user_id=$row->user_id;
echo $user_id;
?>																																																																																				