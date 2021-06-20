<?php 
	
	$degree_type = 'UG';

	$query = $this->db->get_where('degree',array('DegreeType'=> $degree_type));

	echo json_encode(array('result'=>$query));

 ?>