<?php

include_once('config.php');
$user_fun = new Userfunction();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['prodi']) && isset($_POST['lahir']) && isset($_POST['gender'])){

		$username = $user_fun->htmlvalidation($_POST['username']);
		$email = $user_fun->htmlvalidation($_POST['email']);
		$prodi= $user_fun->htmlvalidation($_POST['prodi']);
		$lahir = $user_fun->htmlvalidation($_POST['lahir']);
		$gender = $user_fun->htmlvalidation($_POST['gender']);

		if((!preg_match('/^[ ]*$/', $username)) && (!preg_match('/^[ ]*$/', $email)) && (!preg_match('/^[ ]*$/', $prodi)) && (!preg_match('/^[ ]*$/', $gender)) && ($lahir != NULL)){

			$field_val['u_name'] = $username;
			$field_val['u_email'] = $email;
			$field_val['u_gender'] = $gender;
			$field_val['u_prodi'] = $prodi;
			$field_val['u_lahir'] = $lahir;	

			$insert = $user_fun->insert("user", $field_val);

			if($insert){
				$json['status'] = 101;
				$json['msg'] = "Data Successfully Inserted";
			}
			else{
				$json['status'] = 102;
				$json['msg'] = "Data Not Inserted";
			}

		}
		else{

			if(preg_match('/^[ ]*$/', $username)){

				$json['status'] = 103;
				$json['msg'] = "Please Enter Username";

			}
			if(preg_match('/^[ ]*$/', $email)){

				$json['status'] = 104;
				$json['msg'] = "Please Enter Email";

			}
			if(preg_match('/^[ ]*$/', $prodi)){

				$json['status'] = 105;
				$json['msg'] = "Please Select Prodi";

			}
			if(preg_match('/^[ ]*$/', $gender)){

				$json['status'] = 106;
				$json['msg'] = "Please Choice Gender";

			}
			if($lahir == NULL){

				$json['status'] = 107;
				$json['msg'] = "Please Enter Lahir";

			}

		}

	}
	else{

		$json['status'] = 108;
		$json['msg'] = "Invalid Values Passed";

	}

}
else{

	$json['status'] = 109;
	$json['msg'] = "Invalid Method Found";

}


echo json_encode($json);

?>