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
        ":qualificationId" => $request_data->qualificationId,
        ":planCareerId" => $request_data->planCareerId,
        ":skill" => $request_data->skill,
        ":level" => $request_data->level,
        ":goal" => $request_data->goal,
    );
    $query = "INSERT INTO qualification (qualificationId,planCareerId,skill,level,goal) 
                                    VALUES(:qualificationId,:planCareerId,:skill,:level,:goal)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array(" message " => " Insert Complete ");
    echo json_encode($output);
} else if ($request_data->action == "getall") {
    // echo " getAllUser ";
    $query = "SELECT qpc.qa_plan_career_id,pc.Plan_Career_id,ca.career,qa.qualification_name,lv.level_description,tg.target_name
    FROM qa_plan_career         as qpc
    INNER JOIN plan_career      as pc ON qpc.plan_career_id = pc.plan_career_id
    INNER JOIN career           as ca ON pc.career_id = ca.career_id
    INNER JOIN qualification    as qa ON qpc.qualification_id = qa.qualificationId
    INNER JOIN level            as lv ON qpc.level_id = lv.level_id
    INNER JOIN target           as tg ON qpc.target_id = tg.target_id ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if ($request_data->action == "edit") {
    $query = "SELECT * FROM qualification WHERE qualificationId = $request_data->qualificationId";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data['qualificationId'] = $row['qualificationId'];
        $data['planCareerId'] = $row['planCareerId'];
        $data['skill'] = $row['skill'];
        $data['level'] = $row['level'];
        $data['goal'] = $row['goal'];
    }
    echo json_encode($data);
} else if ($request_data->action == "update") {
    $data = array(
        ":qualificationId" => $request_data->qualificationId,
        ":planCareerId" => $request_data->planCareerId,
        ":skill" => $request_data->skill,
        ":level" => $request_data->level,
        ":goal" => $request_data->goal
    );
    $query = "UPDATE qualification 
    SET 
        qualificationId=:qualificationId,
        planCareerId=:planCareerId,
        skill=:skill,
        level=:level,
        goal=:goal
    WHERE qualificationId=:qualificationId";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = array("message" => "Update Complete");
    echo json_encode($output);
} else if ($request_data->action == "delete") {
    $query = "DELETE FROM qualification WHERE qualificationId = $request_data->qualificationId";
    $statement = $connect->prepare($query);
    $statement->execute();
    $output = array("message" => "Delete Complete");
    echo json_encode($output);
}
else if ($request_data->action == "getLevel") {
    $query = "SELECT * FROM level";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
else if ($request_data->action == "getTarget") {
    $query = "SELECT * FROM target";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
else if ($request_data->action == "getQualifiation") {
    $query = "SELECT * FROM qualification";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

else if ($request_data->action == "getEmpCareer") {
    $query = "SELECT pc.Plan_Career_id, emp.id, pc.career_id,ca.career
    FROM employee as emp 
    INNER JOIN plan_career as pc ON pc.Employee_id = emp.id
    INNER JOIN career as ca ON ca.career_id = pc.career_id

WHERE emp.id = $request_data->employee_id 
ORDER BY pc.Plan_Career_id asc";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);

}


