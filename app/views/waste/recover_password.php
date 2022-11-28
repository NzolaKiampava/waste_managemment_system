<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=WEBSITE_TITLE?></title>
</head>

<body style="font-family: tahoma;">

	<style type="text/css">
		
		form{
			width: 300px;
			padding: 10px;
			box-shadow: 0px 0px 10px #aaa;
			margin: auto;
			margin-top: 20px;
			border-radius: 10px;
		}

		form input{
			width: 270px;
			padding: 10px;
			border: solid thin #aaa;
			border-radius: 10px;
			margin: 5px;
			outline: none;
		}

		.btn{

			width: 290px;
			cursor: pointer;
		}

		.text{
			border: solid thin #aaa;
			border-radius: 10px;
			border: solid thin #aaa;
			width: 270px;
			margin-left: 5px;
			padding: 10px;
		}

	</style>

	<form method="post">
		<h3>Recuperar Palavra-passe</h3>
		<input type="text" name="email" placeholder="Receiver Email" autofocus="true" required><br> 
		<input class="btn" type="submit" name="recover_password" value="Enviar">

	</form>
</body>
</html>