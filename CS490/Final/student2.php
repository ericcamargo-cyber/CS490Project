<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Landing Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="final-style.css">
</head>
<?php
include("nav_student.php");
$cmd = "";
if (isset($_GET["cmd"]) && ($_GET["cmd"] != "")) {
    $cmd = $_GET["cmd"];
}

switch ($cmd) {
    case "listtest":
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=getlisttests');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else{
            $temp =1;
            ?>

            <h1> LIST OF TESTS AVAILABLE </h1>

            <?php
            foreach ($final_response->msg as $q) {
                echo "<br>";
                echo $temp." : ".$q->id;
                echo " status = ".$q->name;
                echo "<a href='https://afsaccess4.njit.edu/~ec378/student2.php?cmd=taketest&id=".$q->id."'> [ TAKE IT]</a>";
                $temp++;
            }
            echo "<br>";

            ?>
                <a href="https://afsaccess4.njit.edu/~ec378/student2.php"> &nbsp; CONTINUE...</a>
            <?php
        }
        die();
        break;

    case "taketest":
        $id = $_GET["id"];
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=gettest&id='.$id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        } else {
            echo "<h1>".$final_response->testname."</h1><br>";
            echo "<form action='https://afsaccess4.njit.edu/~ec378/student2.php?cmd=savetest' method='POST'>";
            echo '<input type="hidden" id="idstudent" name="idstudent" value="0001">';
            echo '<input type="hidden" id="idtest" name="idtest" value="'.$final_response->idtest.'">';
            $temp =1;
            foreach($final_response->msg as $q){
                echo $temp." ._ ".$q->question."<br>";
                echo $temp." ._ ".$q->value."<br>";
                echo '<textarea id="answer'.$temp.'" name="answer[]" rows="4" cols="50"></textarea>';
                echo '<input type="hidden" id="questionid'.$temp.'" name="answer2[]" value="'.$q->id_question.'">';
                echo "<br>";
                echo "<br>";
                $temp++;
            }
            echo "<button>SAVE</button>";
            echo "</form>";
        }

        die();
        break;

    case "savetest":
        //print_r($_POST);

        $fields_string = http_build_query($_POST);
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=savetakentest');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
        curl_close($ch);



        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        } else {
        ?>
            <div> TEST IS SAVED</div>
            <a href="https://afsaccess4.njit.edu/~ec378/student2.php"> &nbsp; CONTINUE...</a>
        <?php
        }
        //print_r($_POST);
        die();
        break;
} // switch

?>

<div class="login-form">
    <div class = "landingpage">
    <h1>Welcome Student</h1>
</div>