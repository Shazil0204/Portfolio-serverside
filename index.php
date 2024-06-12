<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
header("Access-Control-Allow-Origin:  *" );
header("Access-Control-Allow-Headers: *" );
header("Access-Control-Allow-Methods: *" );

$db_conn = mysqli_connect("localhost", "root", "", "portfolio-testing-db");

if($db_conn===false){
    die("ERROR: Could not connect".mysqli_connect_error());
}

$userPostData = json_decode(file_get_contents("php://input")); // It takes your network request BODY and converts it to an array which can be used by your php.
// echo "success data";
// print_r($userPostData); die;
$username = $userPostData->name;
$useremail = $userPostData->email;
$userPhone = $userPostData->phoneNo;
$userMessage = $userPostData->message;
$result = mysqli_query($db_conn, "INSERT INTO user_comments (username, email, phone, message) 
VALUES('$username', '$useremail', '$userPhone', '$userMessage')");

if($result){
    echo json_encode(["SUCCESS"=>"your data has been insert into the database!"]);
    return;
}
else{
    echo json_encode(["ERROR"=>"Something went wrong please try again!"]);
    return;
}

?>