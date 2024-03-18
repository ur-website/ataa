<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<h1 style="font-size: 30px;">هــــــــــــــذا حساب المعلمين مع اختلاف التخصصات التي سوف يتم اضافتها </h1><?php echo $_SESSION["username"] ?>

<a href="logout.php" style="font-size: 30px;" >Logout</a>

</body>
</html>
