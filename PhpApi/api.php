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
        ":id" => $request_data->id, ":name" => $request_data->name, ":study_faculty" => $request_data->study_faculty,
        ":university" => $request_data->university, ":disability_type" => $request_data->disibility_type
    );
    $query = "INSERT INTO employee (id,name,study_faculty,university,disability_type) 
                 VALUES(:id,:name,:study_faculty,:university,:disability_type)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT * FROM employee";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($request_data->action == "edit") {
    $query = "SELECT * FROM employee WHERE id = $request_data->id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['id'] = $row['id'];
        $data['name'] = $row['name'];
        $data['study_faculty'] = $row['study_faculty'];
        $data['university'] = $row['university'];
        $data['disability_type'] = $row['disability_type'];
    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":id" => $request_data->id,
        ":name" => $request_data->name,
        ":study_faculty" => $request_data->study_faculty,
        ":university" => $request_data->university,
        ":disability_type" => $request_data->disability_type
    );
    $query = "UPDATE employee 
    SET 
        id=:id,
        name=:name,
        study_faculty=:study_faculty,
        university=:university,
        disability_type=:disability_type
    WHERE id=:id;";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM employee WHERE id = $request_data->id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}
