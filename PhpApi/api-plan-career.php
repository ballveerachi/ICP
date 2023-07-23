<?php
function cors()
{
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        exit(0);
    }
}

cors();

$request_data = json_decode(file_get_contents("php://input"));
$data = array();
$servername = "localhost";
$username = "u486700931_icp2";
$password = "HfEzpHm]Vg8";
$database = "u486700931_icp2";

try {
        $connect = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully"; 
    } catch(PDOException $e) {    
        echo "Connection failed: " . $e->getMessage();
    }

if ($request_data->action == "insert") {
    echo " insert ";
    $data = array(
        ":Employee_id" => $request_data->Employee_id,
        ":career_id" => $request_data->career_id
    );
    $query = "INSERT INTO plan_career (Employee_id,career_id) 
              VALUES(:Employee_id,:career_id)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} else if ($request_data->action == "getall") {
    // echo " getAllUser "; แก้ไข วัน31/01/66 
    $query = "SELECT pc.Plan_Career_id, pc.Employee_id,pc.career_id,ca.career,ep.id,ep.name,ep.university
              FROM plan_career AS pc
              INNER JOIN career AS ca ON pc.career_id=ca.career_id
              INNER JOIN employee AS ep ON pc.Employee_id=ep.id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($request_data->action == "edit") {
    //สิ่งที่เราต้องการค้นหา จาก $request_data->Plan_Career_id
    $query = "SELECT pc.Plan_Career_id, pc.Employee_id,pc.career_id,ca.career
              FROM plan_career AS pc
              INNER JOIN career AS ca ON pc.career_id=ca.career_id
              WHERE pc.Plan_Career_id =$request_data->Plan_Career_id;
    ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['Plan_Career_id'] = $row['Plan_Career_id'];
        $data['Employee_id'] = $row['Employee_id'];
        $data['career_id'] = $row['career_id'];
        $data['career'] = $row['career'];
        
    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":Plan_Career_id" => $request_data->Plan_Career_id,
        ":Employee_id" => $request_data->Employee_id,
        ":career_id" => $request_data->career_id,
        
    );
    $query = "UPDATE plan_career 
    SET 
        Employee_id=:Employee_id,
        career_id=:career_id
    WHERE Plan_Career_id=:Plan_Career_id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM plan_career 
              WHERE Plan_Career_id = $request_data->Plan_Career_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}
