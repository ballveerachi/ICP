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
        ":self_assessment_id" => $request_data->self_assessment_id,
        ":qa_plan_career_id" => $request_data->qa_plan_career_id,
        ":perform_id" => $request_data->perform_id,
        ":self_assessment_date" => $request_data->self_assessment_date
    );
    $query = "INSERT INTO self_assessment (self_assessment_id,
                                    qa_plan_career_id,
                                    self_assessment_date,
                                    perform_id) 
            VALUES(:self_assessment_id,
                                    :qa_plan_career_id,
                                    :self_assessment_date,
                                    :perform_id)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT * FROM self_assessment";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($request_data->action == "edit") {
    $query = "SELECT * 
    FROM self_assessment  AS sa
    INNER JOIN qa_plan_career  AS qpc ON qpc.qa_plan_career_id = sa.qa_plan_career_id
    INNER JOIN qualification As qa ON qa.qualificationId = qpc.qualification_id
    WHERE self_assessment_id = $request_data->self_assessment_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['self_assessment_id'] = $row['self_assessment_id'];
        $data['plan_career_id'] = $row['plan_career_id'];
        $data['qualification_name'] = $row['qualification_name'];
        $data['qa_plan_career_id'] = $row['qa_plan_career_id'];
        $data['self_assessment_date'] = $row['self_assessment_date'];
        $data['perform_id'] = $row['perform_id'];
    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":self_assessment_id" => $request_data->self_assessment_id,
        ":qa_plan_career_id" => $request_data->qa_plan_career_id,
        ":self_assessment_date" => $request_data->self_assessment_date,
        ":perform_id" => $request_data->perform_id,
    );
    $query = "UPDATE self_assessment 
    SET 
                     self_assessment_id=:self_assessment_id,
                     qa_plan_career_id=:qa_plan_career_id,
                     self_assessment_date=:self_assessment_date,
                     perform_id=:perform_id 
    WHERE self_assessment_id = :self_assessment_id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE 
    FROM self_assessment 
    WHERE self_assessment_id = $request_data->self_assessment_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}

else if ($request_data->action == "getEmpCareer") {
    $query = "SELECT pc.Employee_id,pc.Plan_Career_id,qpc.qa_plan_career_id,pc.career_id,ca.career,qpc.qualification_id
    FROM qa_plan_career as qpc
    INNER JOIN plan_career as pc ON pc.plan_career_id = qpc.plan_career_id
    INNER JOIN career as ca ON ca.career_id = pc.career_id
    INNER JOIN employee as ep ON ep.id= pc.Employee_id
    WHERE ep.id = $request_data->employee_id
    GROUP BY pc.plan_career_id 
    ORDER BY qpc.qa_plan_career_id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);

}

else if ($request_data->action == "getCareerQualifiation") {
    $query = "SELECT *
    FROM career_qualification as cq 
    WHERE cq.career_id = $request_data->career_id 
    ORDER BY cq.career_qualification_id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if ($request_data->action == "getCareer_Qualifiation") {
    // 28/2/2566 ดึงข้อมูลคุณสมบัติตามแผนอาชีพ
    $query = "SELECT pc.Employee_id,pc.Plan_Career_id,qpc.qa_plan_career_id,pc.career_id,ca.career,qa.qualification_name,qa.qualificationId
    FROM qa_plan_career as qpc
    INNER JOIN plan_career AS pc ON pc.plan_career_id = qpc.plan_career_id
    INNER JOIN career AS ca ON ca.career_id = pc.career_id
    INNER JOIN employee As ep ON ep.id= pc.Employee_id
    INNER JOIN qualification AS qa ON qa.qualificationId = qpc.qualification_id
    WHERE pc.Plan_Career_id = $request_data->Plan_Career_id
    ORDER BY qpc.qa_plan_career_id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if ($request_data->action == "getPlanCareer") {
    $query = "SELECT emp.id,emp.name,emp.study_faculty,emp.university,emp.disability_type,
    pc.Plan_Career_id, pc.Name_Plan_Career
    FROM employee as emp 
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    WHERE emp.id = $request_data->employeeId 
    ORDER BY emp.id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
else if ($request_data->action == "getPerform") {
    $query = "SELECT * FROM perform";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}