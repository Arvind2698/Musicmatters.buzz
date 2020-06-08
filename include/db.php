<?php
$servername="localhost";
$db_username="root";
$db_password="";
$db_name="CMS";


$connection=mysqli_connect($servername,$db_username,$db_password,$db_name);
if(!$connection)
{
    echo " connection error";
}


