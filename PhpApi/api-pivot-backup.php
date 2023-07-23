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

    // echo "You have CORS!";
}

cors();

$request_data = json_decode(file_get_contents("php://input"));

$data = array();
$connect = new PDO("mysql:host=localhost:3306;dbname=icp-score-card", "root", "");

// if ($request_data->action == "insert") {
//     echo " insert ";
//     $data = array(
//         ":planId" => $request_data->planId, 
//         ":qualificationId" => $request_data->qualificationId, 
//         ":doing" => $request_data->doing,
//         ":leaning" => $request_data->leaning
//     );
//     $query = "INSERT INTO plan (planId,
//                                 qualificationId,
//                                 doing,
//                                 leaning) 
//                  VALUES(:planId,
//                         :qualificationId,
//                         :doing,
//                         :leaning)";


//     $statement = $connect->prepare($query);
//     $statement->execute($data);
//     $output = array(" message " => " Insert Complete ");
//     echo json_encode($output);
// } else 
// $query = "SELECT emp.*, pc.*, q.*, p.*, sa.*
// INNER JOIN qualification as q ON q.planCareerId = pc.planCareerId
// INNER JOIN plan as p ON p.qualificationId = q.qualificationId
// INNER JOIN self_assessment as sa ON sa.planId = p.planId
//id,name,study_faculty,university,disability_type

if ($request_data->action == "getall") {
    $query = "SELECT emp.id,emp.name,emp.study_faculty,emp.university,emp.disability_type,
    pc.Name_Plan_Career,q.skill,q.level,q.goal,p.doing,p.leaning,sa.month,sa.assessment
    FROM employee as emp 
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    INNER JOIN qualification as q ON q.planCareerId = pc.Plan_Career_id
    INNER JOIN plan as p ON p.qualificationId = q.qualificationId
    INNER JOIN self_assessment as sa ON sa.qualificationId = q.qualificationId
    ORDER BY emp.id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if ($request_data->action == "getEmployees") {
    $query = "SELECT emp.id,emp.name,emp.study_faculty,emp.university,emp.disability_type
    FROM employee as emp
    WHERE emp.name LIKE  '" . $request_data->query . '%' . "' 
    ORDER BY emp.id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if ($request_data->action == "getPlanCareer") {
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

if ($request_data->action == "getQualification") {
    $query = "SELECT q.qualificationId,emp.name,emp.study_faculty,emp.university,emp.disability_type,
    pc.plan_career_id, pc.Name_Plan_Career,q.skill,q.level,q.goal
    FROM employee as emp 
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    INNER JOIN qualification as q ON q.planCareerId = pc.Plan_Career_id
    WHERE pc.Plan_Career_id = $request_data->Plan_Career_id 
    ORDER BY q.qualificationId asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if ($request_data->action == "getPlan") {
    $query = "SELECT p.planId, q.qualificationId, emp.name,q.skill,p.doing,p.leaning
    FROM employee as emp
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    INNER JOIN qualification as q ON q.planCareerId = pc.Plan_Career_id
    INNER JOIN plan as p ON p.qualificationId = q.qualificationId
    WHERE q.qualificationId = $request_data->qualificationId 
    ORDER BY q.qualificationId asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

if ($request_data->action == "getAssessment") {
    $query = "SELECT sa.selfAssessmentId, q.qualificationId, emp.name,q.skill,q.level,q.goal,sa.month,sa.assessment
    FROM employee as emp 
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    INNER JOIN qualification as q ON q.planCareerId = pc.Plan_Career_id
    INNER JOIN self_assessment as sa ON sa.qualificationId = q.qualificationId
    WHERE q.qualificationId = $request_data->qualificationId
    ORDER BY q.qualificationId asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    $data = array();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // $data[] = $row;
        $e = array(
            "selfAssessmentId" => $selfAssessmentId,
            "qualificationId" => $qualificationId,
            "name" => $name,
            "skill" => $skill,
            "level" => $level,
            "goal" => $goal,
            "month" => $month,
            "assessment" => $assessment
        );
        array_push($data, $e);
    }
    echo json_encode($data);
} 
// if ($request_data->action == "getAssessment") {
//     $query = "SELECT sa.selfAssessmentId, q.qualificationId, emp.name,q.skill,q.level,q.goal,sa.month,sa.assessment
//     FROM employee as emp 
//     INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
//     INNER JOIN qualification as q ON q.planCareerId = pc.Plan_Career_id
//     INNER JOIN self_assessment as sa ON sa.qualificationId = q.qualificationId
//     WHERE q.qualificationId = $request_data->qualificationId
//     ORDER BY q.qualificationId asc";
//     $statement = $connect->prepare($query);
//     $statement->execute();
//     while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
//         $data[] = $row;
//     }
//     echo json_encode($data);
// } 
