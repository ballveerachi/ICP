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
        ":planId" => $request_data->planId, 
        ":qa_plan_career_id" => $request_data->qa_plan_career_id, 
        ":doing" => $request_data->doing,
        ":leaning" => $request_data->leaning,
        ":plan_start_date" => $request_data->plan_start_date,
        ":plan_end_date" => $request_data->plan_end_date

    );
    $query = "INSERT INTO plan (planId,
                                qa_plan_career_id,
                                doing,
                                leaning,
                                plan_start_date,
                                plan_end_date) 
                 VALUES(:planId,
                        :qa_plan_career_id,
                        :doing,
                        :leaning,
                        :plan_start_date,
                        :plan_end_date)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT * FROM plan  ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($request_data->action == "edit") {
    $query = "SELECT * 
    FROM plan AS pln
    INNER JOIN qa_plan_career  AS qpc ON qpc.qa_plan_career_id = pln.qa_plan_career_id
    INNER JOIN qualification As qa ON qa.qualificationId = qpc.qualification_id
    WHERE planId = $request_data->planId";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['planId'] = $row['planId'];
        $data['plan_career_id'] = $row['plan_career_id'];
        $data['qualification_name'] = $row['qualification_name'];
        $data['qa_plan_career_id'] = $row['qa_plan_career_id'];
        $data['doing'] = $row['doing'];
        $data['leaning'] = $row['leaning'];
        $data['plan_start_date'] = $row['plan_start_date'];
        $data['plan_end_date'] = $row['plan_end_date'];

    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":planId" => $request_data->planId,
        ":qa_plan_career_id" => $request_data->qa_plan_career_id,
        ":doing" => $request_data->doing,
        ":leaning" => $request_data->leaning,
        ":plan_start_date" => $request_data->plan_start_date,
        ":plan_end_date" => $request_data->plan_end_date,
    );
    // doing=:doing,
    //     leaning=:leaning
    //     plan_start_date=:plan_start_date
    //     plan_end_date=:plan_end_date
    $query = "UPDATE plan 
    SET 
        planId=:planId,
        qa_plan_career_id=:qa_plan_career_id,
        doing=:doing,
        leaning=:leaning,
        plan_start_date=:plan_start_date,
        plan_end_date=:plan_end_date
    WHERE planId=:planId";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM plan WHERE planId = $request_data->planId";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}
