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
        ":career_qualification_id" => $request_data->career_qualification_id,
        ":career_id" => $request_data->career_id,
        ":qualification" => $request_data->qualification,
	    ":level" => $request_data->level,
    );
    $query = "INSERT INTO career_qualification (career_qualification_id,career_id,qualification,level) 
              VALUES(:career_qualification_id,:career_id,:qualification,:level)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} 
else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT cq.career_qualification_id,pc.plan_career_id,qc.skill,qc.level,qc.goal
    FROM career_qualification AS cq
    INNER JOIN qualification AS qc ON cq.career_qualification_id=qc.qualificationId
    INNER JOIN plan_career AS pc ON pc.plan_career_id=cq.career_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
// else if ($request_data->action == "getEmpCareer") {
//     $query = "SELECT pc.Plan_Career_id, emp.id, pc.career_id,ca.career
//     FROM employee as emp 
//     INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
//     INNER JOIN career as ca ON ca.career_id = pc.career_id

//     WHERE emp.id = $request_data->employee_id 
//     ORDER BY pc.Plan_Career_id asc";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);

// }
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
}else if ($request_data->action == "edit") {
    $query = "SELECT * FROM career_qualification WHERE career_qualification_id = $request_data->career_qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['career_qualification_id'] = $row['career_qualification_id'];
        $data['career_id'] = $row['career_id'];
        $data['qualification'] = $row['qualification'];
	$data['level'] = $row['level'];
    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":career_qualification_id" => $request_data->career_qualification_id,
        ":career_id" => $request_data->career_id,
        ":qualification" => $request_data->qualification,
	":level" => $request_data->level,
    );
    $query = "UPDATE career_qualification 
    SET 
        career_qualification_id=:career_qualification_id,
        career_id=:career_id,
        qualification=:qualification,
	level=:level
    WHERE career_qualification_id = :career_qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM career_qualification 
    WHERE career_qualification_id = $request_data->career_qualification_id";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}

