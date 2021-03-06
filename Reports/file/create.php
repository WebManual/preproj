<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate course object
include_once '../objects/file.php';
 
$database = new Database();
$db = $database->getConnection();
 
$file = new File($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set course property values
$file->link = $data->link;
$file->student_id = $data->student_id;
$file->course_id = $data->course_id;

 
// create the course
if($file->create()){
    echo '{';
        echo '"message": "File was created."';
    echo '}';
}
 
// if unable to create the course, tell the user
else{
    echo '{';
        echo '"message": "Unable to create file."';
    echo '}';
}
?>
