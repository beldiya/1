




<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$id="";
	if(isset($_GET['action']))
	{
		$action = "delete";
		$id=$_GET["id"];
	}
	else
	{
		$name=$_POST["txtname"];
		$email=$_POST["txtemail"];
		$pass=$_POST["txtpass"];
		$action=$_POST["btnaction"];
		$id=$_POST["hf"];
	}

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if ($conn) 
	{
		echo"Connection successfully<br>";	
		$db=mysqli_select_db($conn,"student");
		if($db)
		{
			echo"Databse selected<br>";
			if($action == "insert")
			{
				$sql = "INSERT INTO `tblreg` (`regId`, `email`, `pass`, `name`) VALUES (NULL, '$email', '$pass', '$name')";	
			}
			elseif($action == "update")
			{
				$sql = "UPDATE `tblreg` SET  `email` = '$email' , `pass` = '$pass' , `name` = '$name' WHERE `tblreg`.`regId` = '$id'";
			}
			elseif($action == "delete")
			{
				$sql = "DELETE FROM `tblreg` WHERE `tblreg`.`regId` = '$id'";
			}
			$query=mysqli_query($conn,$sql);
			if($query>0)
			{
				echo"$action Succesfully<br>";
				header("location:reg.php");
			}
			else
			{
				echo"Record not Inserted<br>";
			}	
		}
		else
		{
			echo"Database not selected<br>";
		}
	}
	else
	{
		die("Connection failed: " . $conn->connect_error);
	}
?>