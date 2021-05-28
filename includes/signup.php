<?php 

$info = (Object)[];

	$data = false;
	$data['userid'] = $DB->generate_id(20);
	$data['date'] = date("Y-m-d H:i:s");

	//validate username
	$data['username'] = $DATA_OBJ->username;
	if(empty($DATA_OBJ->username))
	{
		$Error .= "Introduceti un nume de utilizator valid . <br>";
		
	}else
	{
		if(strlen($DATA_OBJ->username) < 3)
		{
			$Error .= "Numele de utilizator trebuie sa aiba o lungime minima de 3 caractere. <br>";
		}

		if(!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username))
		{
			$Error .= "Introduceti un nume de utilizator valid . <br>";
		}
 		
	}

	$data['email'] = $DATA_OBJ->email;
	if(empty($DATA_OBJ->email))
	{
		$Error .= "Introduceti o adresa de e-mail valida . <br>";
	}else
	{
	 
		if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $DATA_OBJ->email))
		{
			$Error .= "Introduceti o adresa de e-mail valida . <br>";
		}
 		
	}

	$data['gender'] = isset($DATA_OBJ->gender) ? $DATA_OBJ->gender : null;
	if(empty($DATA_OBJ->gender))
	{
		$Error .= "Selectati sexul. <br>";
	}else
	{
	 
		if($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female")
		{
			$Error .= "Selectati un sex valid . <br>";
		}
 		
	}

	$data['password'] = $DATA_OBJ->password;
	$password = $DATA_OBJ->password2;
	if(empty($DATA_OBJ->password))
	{
		$Error .= "Introduceti o parola valida. <br>";
	}else
	{
		if($DATA_OBJ->password != $DATA_OBJ->password2)
		{
			$Error .= "Parolele trebuie sa corespunda. <br>";
		}

		if(strlen($DATA_OBJ->password) < 8)
		{
			$Error .= "Parola trebuie sa aiba o lungime de cel putin 8 caractere. <br>";
		}
 
	}


	if($Error == "")
	{

		$query = "insert into users (userid,username,gender,email,password,date) values (:userid,:username,:gender,:email,:password,:date)";
		$result = $DB->write($query,$data);

		if($result)
		{
			
			$info->message = "Profilul a fost creat cu succes";
			$info->data_type = "info";
			echo json_encode($info);
		}else
		{

			$info->message = "Profilul NU a fost creat din cauza unei erori";
			$info->data_type = "error";
			echo json_encode($info);

		}
	}else
	{
		$info->message = $Error;
		$info->data_type = "error";
		echo json_encode($info);
	}
