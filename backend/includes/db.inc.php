<?php
$hostname = "172.17.0.13";
#$hostname = "localhost";
$username = "root";
$password = "root";
#$password = "";
$database = "parbeit";

$db = mysqli_connect($hostname, $username, $password, $database);

if ($db->connect_errno)
{
    echo "Database error!";
}