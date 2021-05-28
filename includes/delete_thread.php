<?php 
	
	$arr['userid'] = "null";
	if(isset($DATA_OBJ->find->userid)){

		$arr['userid'] = $DATA_OBJ->find->userid;
	}
 
 	//read from db
	$arr['sender'] = $_SESSION['userid'];
	$arr['receiver'] = $arr['userid'];

	$sql = "select * from messages where (sender = :sender && receiver = :receiver) || (receiver = :sender && sender = :receiver)";
	$result = $DB->read($sql,$arr);
 
	if(is_array($result))
	{
		foreach ($result as $row) {
			# code...
		
			if($_SESSION['userid'] == $row->sender)
			{
				$sql = "delete from messages where id = '$row->id' limit 1";
				$DB->write($sql);
			}

			if($_SESSION['userid'] == $row->receiver)
			{
				$sql = "delete from messages where id = '$row->id' limit 1";
				$DB->write($sql);
			}
		}


	}
?>