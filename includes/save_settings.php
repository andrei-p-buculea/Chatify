<?php 

$info = (Object)[];

	$data = false;
	$data['userid'] = $_SESSION['userid'];
 
	//validate username
	$data['username'] = $DATA_OBJ->username;
	if(empty($DATA_OBJ->username))
	{
		$Error .= "Please enter a valid username . <br>";
		
	}else
	{
		if(strlen($DATA_OBJ->username) < 3)
		{
			$Error .= "Numele de utilizator trebuie sa aiba o lungime de cel putin 3 caractere. <br>";
		}

		if(!preg_match("/^[a-z A-Z]*$/", $DATA_OBJ->username))
		{
			$Error .= "Introduceti un nume de utilzator valid . <br>";
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
		$Error .= "Selectati sexul . <br>";
	}else
	{
	 
		if($DATA_OBJ->gender != "Male" && $DATA_OBJ->gender != "Female")
		{
			$Error .= "Selectati sexul . <br>";
		}
 		
	}

	$data['password'] = $DATA_OBJ->password;
	$password = $DATA_OBJ->password2;
	if(empty($DATA_OBJ->password))
	{
		$Error .= "Introduceti o parola valida . <br>";
	}else
	{
		if($DATA_OBJ->password != $DATA_OBJ->password2)
		{
			$Error .= "Parolele nu corespund. <br>";
		}

		if(strlen($DATA_OBJ->password) < 8)
		{
			$Error .= "Lungimea parolei trebuie sa fie de minim 8 caractere. <br>";
		}
 
	}


	if($Error == "")
	{

 		$query = "update users set username = :username,gender = :gender,email = :email,password = :password where userid = :userid limit 1";
		$result = $DB->write($query,$data);

		if($result)
		{
			
			$info->message = "Date salvate cu succes";
			$info->data_type = "save_settings";
			echo json_encode($info);
		}else
		{

			$info->message = "Datele dumneavoastra nu au fost salvate din cauza unei erori";
			$info->data_type = "save_settings";
			echo json_encode($info);

		}
	}else
	{
		$info->message = $Error;
		$info->data_type = "save_settings";
		echo json_encode($info);
	}
