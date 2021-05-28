<html>
<head>
	<title>Chatify</title>
</head>

<style type="text/css">
	
	@font-face{

		font-family: headFont;
		src: url(ui/fonts/Summer-Vibes-OTF.otf);
	}

	@font-face{

		font-family: myFont;
		src: url(ui/fonts/OpenSans-Regular.ttf);
	}

	

	#wrapper{

		max-width:900px;
		min-height: 500px;
		margin: auto;
		color: grey;
		font-family: myFont;
		font-size: 13px;
	}

	form{

		margin: auto;
		padding: 10px;
		width:100%;
		max-width: 400px;
	}

	input[type=text],input[type=password],input[type=button]{

		padding:10px;
		margin: 10px;
		width:100%;
		border-radius: 5px;
		border:solid 1px grey;
	}

	input[type=button]{

		width: 100%;
		cursor: pointer;
		background-color: #2b5488;
		color: white;
	}

	input[type=radio]{

		transform: scale(1.2);
		cursor: pointer;
	}

	#header{

		background-color: #485b6c;
		font-size: 40px;
		text-align: center;
		font-family: headFont;
		width: 100%;
		color: white;
	}

	
	#error{

		text-align: center;
		padding: 0.5em;
		background-color: #ecaf91;
		color: white;
		display: none;
	}

</style>
<body>

	<div id="wrapper">
 
 		<div id="header">
 			Chatify
 			<div style="font-size: 20px;font-family: myFont;">Inregistrare</div>
 		</div>
 		<div id="error" style="">some text</div>
		<form id="myform">
			<input type="text" name="username" placeholder="Nume de utilizator"><br>
			<input type="text" name="email" placeholder="Email"><br>
			<div style="padding: 10px;">
				<br>Sex:<br>
				<input type="radio" value="Male" name="gender_male"> Barbat<br>
				<input type="radio" value="Female" name="gender_female"> Femeie<br>
			</div>
			<input type="password" name="password" placeholder="Parola"><br>
			<input type="password" name="password2" placeholder="Confirmare parola"><br>
			<input type="button" value="Inregristrare" id="signup_button" ><br>

 			<br>
 			<a href="login.php" style="display: block;text-align: center;text-decoration: none">
 				Aveti deja un cont? Logati-va aici
 			</a>

		</form>
	</div>
</body>
</html>

<script type="text/javascript">

	function _(element){

		return document.getElementById(element);
	}

   	var signup_button = _("signup_button");
   	signup_button.addEventListener("click",collect_data);

   	function collect_data(){

   		signup_button.disabled = true;
   		signup_button.value = "Incarcare...Va rugam asteptati..";

   		var myform = _("myform");
   		var inputs = myform.getElementsByTagName("INPUT");

   		var data = {};
   		for (var i = inputs.length - 1; i >= 0; i--) {

   			var key = inputs[i].name;

   			switch(key){

   				case "username":
   					data.username = inputs[i].value;
   					break;

   				case "email":
   					data.email = inputs[i].value;
   					break;

   				case "gender_male":
   				case "gender_female":
   					if(inputs[i].checked){
   						data.gender = inputs[i].value;
   					}
   					break;

   				case "password":
   					data.password = inputs[i].value;
   					break;

   				case "password2":
   					data.password2 = inputs[i].value;
   					break;

   			}
   		}

   		send_data(data,"signup");

   	}

   	function send_data(data,type){

   		var xml = new XMLHttpRequest();

   		xml.onload = function(){

   			if(xml.readyState == 4 || xml.status == 200){

   				handle_result(xml.responseText);
   				signup_button.disabled = false;
   				signup_button.value = "Signup";
   			}
   		}

		data.data_type = type;
		var data_string = JSON.stringify(data);

		xml.open("POST","api.php",true);
		xml.send(data_string);
   	}

   	function handle_result(result){

   		var data = JSON.parse(result);
   		if(data.data_type == "info"){

   			window.location = "index.php";
   		}else{

   			var error = _("error");
   			error.innerHTML = data.message;
   			error.style.display = "block";
 
   		}
   	}

</script>

