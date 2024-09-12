<?php
$servername='localhost';
$username='root';
$password="";
$dbname="productcart";

$conn=new mysqli($servername, $username, $password, $dbname);

if($conn){
    //echo "successfully connected";
}else{
    echo "failed to connect";
}