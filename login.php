<?php
require_once 'include/db_login.php';
$db = new DB_Login();
session_start();
if ((isset($_POST['UserName']) && isset($_POST['Password']))) {



$Username = $_POST['UserName'];
$Password = $_POST['Password'];	

// get the user by username and password
$User = $db->Login($Username, $Password);
if ($User != false) {
// if user is found
$UserType=$User['UserType'];
$_SESSION['UserID']=$User["UserID"];   
$_SESSION['FirstName']=$User["FirstName"];   
$_SESSION['UserName']=$User["UserName"];   
$_SESSION['UserType']=$User["UserType"];   
if ($UserType == "Admin") {


header("location:admin/domains.php");}
else  if ($UserType == "Member") {
header("location:member/domains.php");
} }
else 
{
// if user is not found with the credentials
header("location:index.php?error=1");
}	
} 
?>