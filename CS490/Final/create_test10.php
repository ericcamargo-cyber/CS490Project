<?php include("nav.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>CREATE TEST</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="create_question.css">
<script>
        function addToFinalQuestions(id) {
            var elem = document.getElementById(id);
            const clone = elem.cloneNode(true);

            var test = document.querySelector('#finalquestions');

            test.appendChild(clone);

            var myedit = document.createElement("input");
            myedit.setAttribute('type', 'text');
            myedit.setAttribute('class', 'form-control');
            myedit.setAttribute('placeholder', 'Enter Points');
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

            fetch("https://afsaccess4.njit.edu/~brt22/model10.php?cmd=savetest", {
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
                    window.location.replace("https://afsaccess4.njit.edu/~ec378/teacher10.php");
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    </script>
</head>
<body>
<div class="row g-0">
        <div class="col g-0">
            <div class="leftside">
                <div class="question-form">
                <h1>NEW TEST</h1>
                <div class = "content">
                <input type='text' id='nametest' class="form-control" placeholder="Enter name of Exam" rows="3" required>
                <div id='finalquestions'> </div>
                <div class="action">
                    <button onClick="saveExam()">SAVE</button>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class="col g-0">
            <div class="rightside">
            <div class="question-form">
                    <h1>Bank Questions</h1>
                        <form action ="https://afsaccess4.njit.edu/~ec378/create_test10.php?cmd=getlistquestions" method = "POST">
                            <div class = "content">
                                <label for="exampleFormControlTextarea1" class="form-label" required>Difficulty</label>
                                <select class="form-select" name = "difficulty" aria-label="Default select example">
                                    <option value="all">All</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <label for="exampleFormControlTextarea1" class="form-label" required>Topic</label>
                                <select class="form-select" name = "topic" aria-label="Default select example">
                                    <option value="all">All</option>
                                    <option value="for">For Loop</option>
                                    <option value="while">While Loop</option>
                                    <option value="recursion">Recursion</option>
                                </select>
                                <div class="mb-3">
                                    <input name="keyword" class="form-control" id="question" rows="3" placeholder = "Keyword"></input>
                                </div>
                                <div class="action">
                                    <button >Submit</button>
                                </div>
                            </div>
                        </form>
                        <h1>List of Questions</h1>
                        <?php
                        $cmd = "";
                        if (isset($_GET["cmd"]) && ($_GET["cmd"] != "")){
                            $cmd = $_GET["cmd"];
                        }
                        
                        switch($cmd){
                            case "getlistquestions" :
                            $ch = curl_init('https://afsaccess4.njit.edu/~brt22/model10.php?cmd=getlistquestions');
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            $data = json_decode($response);
                            if($data->result == "error"){
                                echo("error :".$data->msg);
                            }
                            else{
                                    echo '<table class="table table-dark">';
                                    echo  '<thead>';
                                        echo '<th>Question</th>';
                                        echo '<th>Action</th>';
                                    echo '</thead>';
                                    echo '<tbody>';
                                    if (is_array($data) || is_object($data)){
                                        $temp =1;
                                            foreach ($data as $row=>$q) {
                                                echo '<tr>';
                                                echo '<td>';
                                                echo "<span id='".$q->id."'>";
                                                    echo "<br>";
                                                    echo $temp." .- ".$q->question;
                                                echo "</span>";
                                                echo '</td>';
                                                echo '<td>';
                                                echo '<div class="action">';
                                                echo "<button onClick='addToFinalQuestions(".$q->id.");'> ADD </button>";
                                                echo '</div>';
                                                echo '</td>';
                                                $temp++;
                                            }
                                    }
                                echo '</tbody>';
                            echo '</table>';
                        }
                        break;
                    }?>
                        </div>
                    </div>
            </div>
        </div>
</body>
</html>