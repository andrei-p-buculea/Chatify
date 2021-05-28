<?php 

$info = (Object)[];

	$data = false;
 
	//validate info
 	$data['email'] = $DATA_OBJ->email;

 	if(empty($DATA_OBJ->email))
 	{
 		$Error = "Introduceti o adresa de e-mail valida";
 	}

 	if(empty($DATA_OBJ->password))
 	{
 		$Error = "Introduceti o parola valida";
 	}

 	
	if($Error == "")
	{

		$query = "select * from users where email = :email limit 1";
		$result = $DB->read($query,$data);

		if(is_array($result))
		{
			$result = $result[0];
			if($result->password == $DATA_OBJ->password)
			{
				$_SESSION['userid'] = $result->userid;
				$info->message = "Logare cu succes";
				$info->data_type = "info";
				echo json_encode($info);

			}else{

				$info->message = "Parola gresita";
				$info->data_type = "error";
				echo json_encode($info);
			}
			
		}else
		{

			$info->message = "Adresa de e-mail gresita";
			$info->data_type = "error";
			echo json_encode($info);

		}
	}else
	{
		$info->message = $Error;
		$info->data_type = "error";
		echo json_encode($info);
	}

