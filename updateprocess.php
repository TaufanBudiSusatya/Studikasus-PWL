<?php

include_once('config.php');
$user_fun = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['checkid']) && $_GET['checkid'] > 0){

		$update_ch_id = $user_fun->htmlvalidation($_GET['checkid']);

		$condition0['u_id'] = $update_ch_id;
		$select_pre = $user_fun->select_assoc("user", $condition0);

		if($select_pre){

			$json['status'] = 0;
			$json['username'] = $select_pre['u_name'];
			$json['email'] = $select_pre['u_email'];
			$json['prodi'] = $select_pre['u_prodi'];
			$json['lahir'] = $select_pre['u_lahir'];
			$json['gender'] = $select_pre['u_gender'];
			$json['msg'] = "Success";

		}
		else{

			$json['status'] = 1;
			$json['username'] = "NULL";
			$json['email'] = "NULL";
			$json['prodi'] = "NULL";
			$json['lahir'] = "NULL";
			$json['gender'] = "NULL";
			$json['msg'] = "Fail";

		}

	}
	else{
			$json['status'] = 2;
			$json['username'] = "NULL";
			$json['email'] = "NULL";
			$json['prodi'] = "NULL";
			$json['lahir'] = "NULL";
			$json['gender'] = "NULL";
			$json['msg'] = "Invalid Values Passed";
	}
}
else{
			$json['status'] = 3;
			$json['username'] = "NULL";
			$json['email'] = "NULL";
			$json['prodi'] = "NULL";
			$json['lahir'] = "NULL";
			$json['gender'] = "NULL";
			$json['msg'] = "Invalid Method Found";
}


echo json_encode($json);

?>