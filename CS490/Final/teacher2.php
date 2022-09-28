<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Landing Page</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="final-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        function addToFinalQuestions(id) {
            var elem = document.getElementById(id);
            const clone = elem.cloneNode(true);

            var test = document.querySelector('#finalquestions');

            test.appendChild(clone);

            var myedit = document.createElement("input");
            myedit.setAttribute('type', 'text');
            myedit.setAttribute('value', '');
            myedit.setAttribute('id', 'idvalue'+id);

            test.appendChild(myedit);

        }

        function saveExam() {
            var test = document.querySelector('#finalquestions');
            var nametest = document.getElementById("nametest").value;
            let children = test.children;

            var payloadjson = '{ "nametest": "'+nametest+'", "list" : [';
            for (var i = 0; i < children.length ; i++) {
                if (children[i].nodeName == "SPAN") {
                    //payloadarray.push(children[i].getAttribute("id"));
                    payloadjson += ' {"id":'+children[i].getAttribute("id")+',';
                }
                if (children[i].nodeName == "INPUT") {
                    //payloadarray.push(children[i].value);
                    payloadjson += ' "value":'+children[i].value+'},';
                }
            }

            payloadjson = payloadjson.slice(0, -1);
            payloadjson += "]}";
            //console.log(payloadarray);

            //jsonarray = Object.assign({}, payloadarray);
            console.log(payloadjson);

            // SEND TO THE SERVER
            //var data = new FormData();
            //data.append( "json", jsonarray   );

            const data2 = { username: 'example' };

            fetch("https://afsaccess4.njit.edu/~brt22/model2.php?cmd=savetest", {
                method: "POST",
                mode: "same-origin",
                credentials: "same-origin",
                headers: {
                    "Content-Type": "application/json"
                },

                body: payloadjson
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    window.location.replace("https://afsaccess4.njit.edu/~ec378/teacher2.php");
                })
                .catch((error) => {
                    console.error('Error:', error);
                });



        }
    </script>
</head>
<body>

<?php

$cmd = "";
if (isset($_GET["cmd"]) && ($_GET["cmd"] != "")){
    $cmd = $_GET["cmd"];
}

switch($cmd){
    case "createquestion":
        echo '<link rel="stylesheet" href="create_question.css">';
        echo '<div class="row g-0">';
        ?>
        <div class="col g-0">
            <div class="leftside">
                <div class="question-form">
            <h1> Creating Question </h1>
            <form action ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=savequestion" method = "POST">
                <p>Function Name <input name = "functionName" type = "text" ></p>
                <p>Question <input name = "question" type = "text" ></p>
                <p>Number of test cases <input name = "numTestCases" type = "number" ></p>
                <p>Test Case 1 <input name = "test1" type = "text" ></p>
                <p>Answer 1 <input name = "answer1" type = "text" ></p>
                <p>Test Case 2 <input name = "test2" type = "text" ></p>
                <p>Answer 2 <input name = "answer2" type = "text" ></p>
                <p>Test Case 3 <input name = "test3" type = "text" ></p>
                <p>Answer 3 <input name = "answer3" type = "text" ></p>
                <p>Test Case 4 <input name = "test4" type = "text" ></p>
                <p>Answer 4 <input name = "answer4" type = "text" ></p>
                <p>Test Case 5 <input name = "test5" type = "text" ></p>
                <p>Answer 5 <input name = "answer5" type = "text" ></p>
                <p>Difficulty
                    <select name="difficulty">
                        <option value="easy">Easy</option>
                        <option value="medium">Medium</option>
                        <option value="hard">Hard</option>
                    </select>
                </p>
                <!--
                <p>Topic
                    <select name="topic">
                        <option value="For loop">For loop</option>
                        <option value="While loop">While Loop</option>
                        <option value="Recursion">Recursion</option>
                    </select>
                </p>
            -->
                <p>Constraint
                    <select name="constraint">
                        <option value="for">For</option>
                        <option value="while">While</option>
                        <option value="Recursion">Recursion</option>
                    </select>
                </p>
                <p>Status
                    <select name="status">
                        <option value="0">Inactive</option>
                        <option value="1" selected>Active</option>
                    </select>
                </p>
                <p><button> Submit</button> <a href="https://afsaccess4.njit.edu/~ec378/teacher2.php"> CANCEL</a></p>
    
            </form>
            </div>
            </div>
            </div>
        <?php
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=getlistquestions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else{
            //echo ($final_response->msg);
            //print_r($final_response->msg);
            //$temp = $final_response->msg[1];
            //print_r($temp);
            echo '<div class="col g-0">';
                echo '<div class="rightside">';
                echo '<div class="question-form">';
            $temp =1;
            echo "<h1> BANK OF QUESTIONS </h1>";
            echo '<div class = "content">';
            foreach ($final_response->msg as $q) {
                echo "<br>";
                echo $temp." : ".$q->question;
                $temp++;
            }
            echo "</div>";
            echo "</div>";
                echo "</div>";
                echo "</div>";
        }
        echo "</div>";
        die();
        break;

    case "savequestion":

        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=savequestion');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else{
            echo ($final_response->msg);
            ?>
                <a href="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=createquestion"> &nbsp; CONTINUE...</a>
            <?php
        }
        //print_r($_POST);
        die();
        break;

    case "listquestions" :
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=getlistquestions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else{
            //echo ($final_response->msg);
            //print_r($final_response->msg);
            //$temp = $final_response->msg[1];
            //print_r($temp);

            $temp =1;
            echo "<h1> BANK OF QUESTIONS </h1>";
            foreach ($final_response->msg as $q) {
                echo "<br>";
                echo $temp." : ".$q->question;
                echo " status = ".$q->status;
                echo "<a href='model2.php?cmd=deletequestion&id=".$q->id."'> [ DELETE ]</a>";
                $temp++;
            }
            echo "<br>";

            ?>
            <a href="https://afsaccess4.njit.edu/~ec378/teacher2.php"> &nbsp; CONTINUE...</a>
            <?php
        }
        //print_r($_POST);
        die();

        break;
    case "createtest":
        echo '<link rel="stylesheet" href="create_question.css">';
        echo '<div class="row g-0">';
        // GET THE LIST OF QUESTIONS FROM MODEL.PHP
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=getlistquestions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $response = curl_exec($ch);
        curl_close($ch);
        $final_response = json_decode($response);

        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else {
            echo '<div class="col g-0">';
                echo '<div class="leftside">';
                echo '<div class="question-form">';
                    echo "<div> Choose from the list of Questions </div>";
                    echo '<div class = "content">';
                        echo "<div id='listquestions'> ";
                        $temp =1;
                        foreach ($final_response->msg as $q) {

                            echo "<span id='".$q->id."'>";
                                echo "<br>";
                                echo $temp." .- ".$q->question;
                                //echo " status = ".$q->status;
                            echo "</span>";
                            //echo '<div class="action">';
                            echo "<button onClick='addToFinalQuestions(".$q->id.");'> ADD </button>";
                            //echo "</div>";
                            $temp++;
                        }
                        echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            echo '<div class="col g-0">';
                echo '<div class="rightside">';
                echo '<div class="question-form">';
                    echo "<h1>NEW TEST</h1>";
                    echo '<div class = "content">';
                    echo "Name of test : <input type='text' id='nametest'>";

                    echo "<div id='finalquestions'>";
                    echo "</div>";
                    //echo '<div class="action">';
                    echo "<button onClick='saveExam();'>SAVE</button>";
                    //echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            echo "</div>";

        }
        echo '</div>';

        ?>
        <?php

        die();
        break;


    case "reviewtests":
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=getlistteststaken');
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
            echo "<h1> LIST OF TEST TAKEN </h1>";


            foreach ($final_response->msg as $q) {
                echo "<br>";
                echo $temp.".- ".$q->testname." ";
                echo " / student ".$q->user;
                echo "<a href='https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=reviewtest&id=".$q->id."'> [REVIEW]</a>";
                $temp++;
            }
            echo "<br>";

            ?>
                <br>
                <a href="https://afsaccess4.njit.edu/~ec378/teacher2.php"> &nbsp; CONTINUE...</a>
            <?php
        }
        die();
        break;

    case "reviewtest":

        $responsex = file_get_contents('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=gettakentestforreview&id='.$_GET["id"]);

        /*
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=gettakentestforreview&id='.$_GET["id"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));

        //curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $responsex = curl_exec($ch);
        */

        print $responsex;

        $final_response = json_decode($reponsex);
        
        var_dump($final_response);
        //curl_close($ch);



     
        die();


        


        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else{
            if (is_array($final_response->msg) || is_object($final_response->msg)){
            $temp =1;
            echo "<h1> REVIEW TEST  </h1>";

            echo "<form action='https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=savereviewtest' method='POST'>";
                foreach ($final_response->msg as $q) {
                    echo "<br>";
                    echo $temp.".- Question : ".$q->question." ";
                    echo "<br>";

                    echo "Answer : ".$q->answer;
                    echo "<br>";
                    echo "Grade   <input name='grades[]' type ='number' value='".$q->grade."'><br>";
                    echo "Comment <input name='comments[]' type ='text' value='".$q->comment."'><br>";
                    echo "<input name='ids[]' type ='hidden' value='".$q->id."'><br>";
                    //echo "<a href='https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=reviewtest&id=".$q->id."'> [REVIEW]</a>";
                    $temp++;
                }
                echo "<br>";
                echo "<button>SAVE REVIEW</button>";
                echo "<br>";
            echo "</form>";
            }

            ?>
            <br>
            <a href="https://afsaccess4.njit.edu/~ec378/teacher2.php"> &nbsp; CONTINUE...</a>
            <?php
        }
        die();
        break;

    case "savereviewtest":



        $fields_string = http_build_query($_POST);
        $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model2.php?cmd=savereviewtest');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($ch);
        curl_close($ch);



        $final_response = json_decode($response);



        if($final_response->result == "error"){
            echo("error :".$final_response->msg);
        }
        else {
            // do nothing everything is ok
        }
        break;

    case "checkscores":
        echo "Checking scores";
        die();
        break;

}

?>


<div class="">
    <h1>Welcome Teacher</h1>
    <p> <a href ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=listquestions"> List questions from bank  </a></p>
    <p> <a href ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=createquestion"> Create question  </a></p>
    <p> <a href ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=createtest"> Create Test  </a></p>
    <p> <a href ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=checkscores"> Auto-Score Test </a></p>
    <p> <a href ="https://afsaccess4.njit.edu/~ec378/teacher2.php?cmd=reviewtests"> Review tests taken </a></p>
</div>





</body>
</html>
