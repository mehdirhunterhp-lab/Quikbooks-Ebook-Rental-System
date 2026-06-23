<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "user_management";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
