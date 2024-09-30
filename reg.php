



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LOGIN DETAIL</title>
</head>

<body>
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password);
	$id="";
	$name="";
	$email="";
	$pass="";
	
	if(isset($_GET['action']) && $_GET['action']=="select")
	{
		$id=$_GET["id"];
		// Check connection
		if($conn) 
		{
			$db=mysqli_select_db($conn,"student");
			if($db)
			{
				$sql = "SELECT `regId`, `email`, `pass`, `name` FROM `tblreg` WHERE `tblreg`.`regId` = $id";
				$query=mysqli_query($conn,$sql);			
				if (mysqli_num_rows($query) > 0)
				{
					 while($row = mysqli_fetch_row($query)) 
					 {
							$name=$row[3];
							$email=$row[1];
							$pass=$row[2];
					 }
				}
				else
				{
					echo "Record not Inserted<br>";
				}
			}
			else
			{
				echo "Database not selected<br>";
			}
		}
		else
		{
			die("Connection failed: " . $conn->connect_error);
		}
		mysqli_close($conn);
	}
?>

<form id="form1" name="form1" method="post" action="preg.php">
  
Name 
<label> <input name="txtname" type="text" id="txtname" value="<?php echo $name;?>"/>

<input type="hidden" name="hf"  value="<?php if(isset($_GET['action']) && $_GET['action']=="select"){ echo $id;} else { echo "insert";} ?>"/> <br /> </label>

Email 
<label> <input name="txtemail" type="text" id="txtemail" value ="<?php echo $email;?>"/><br /></label>

Password 
<label> <input name="txtpass" type="text" id="txtpass" value = "<?php echo $pass;?>"/><br /><br />

<input name="btnaction" type="submit" id="btnaction" value= "<?php if(isset($_GET['action']) && $_GET['action']=="select"){ echo "update";} else { echo "insert";} ?>" />   

<input type="reset" name="Submit2" value="Reset" /> <br /> </label>
  
<table width="200" border="1">
	<tr>
    	<th scope="col">id</th>
    	<th scope="col">email</th>
		<th scope="col">password</th>
	  	<th scope="col">name</th>
	  	<th scope="col"></th>
	  	<th scope="col"></th>
  	</tr>

<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password);
	// Check connection
	if ($conn) 
	{
		$db=mysqli_select_db($conn,"student");
		if($db)
		{		
			$sql = "SELECT `regId`, `email`, `pass`, `name` FROM `tblreg` WHERE 1";
			$query=mysqli_query($conn,$sql);
			if (mysqli_num_rows($query) > 0)
			{
				 while($row = mysqli_fetch_row($query)) 
				 {				
					echo "<tr>";    
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					echo "<td>".$row[3]."</td>";
					echo "<td><a href='reg.php?id=$row[0]&action=select'>Select</a></td>";
					echo "<td><a href='preg.php?id=$row[0]&	action=delete'>Delete</a></td>";
					echo "</tr>";
				}
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
	mysqli_close($conn);
?>
</table>
</form>
</body>
</html>