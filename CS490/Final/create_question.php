<?php require_once("send_question.php");?>
<!DOCTYPE html>
<html>
<head>
<title>CREATE QUESTIONS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="create_question.css">
</head>
<body>
    <div class="row g-0">
        <div class="col g-0">
            <div class="leftside">
                <div class="question-form">
                    <h1>Create Question</h1>
                        <form method = "POST" action>
                            <div class = "content">
                                <select class="form-select" id = "select1" aria-label="Default select example">
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <select class="form-select" id = "select2" aria-label="Default select example">
                                    <option value="forLoop">For Loop</option>
                                    <option value="lists">Lists</option>
                                    <option value="recursion">Recursion</option>
                                </select>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label" required>Enter a new question</label>
                                    <textarea name="questions" class="form-control" id="question" rows="3" required></textarea>
                                    <input name ="tests1" type="text" id="testCase1" placeholder="Test case 1" required>
                                    <input name ="answer1" type="text" id="answer1" placeholder="Answer 1" required>
                                    <input name ="tests2" type="text" id="testCase2" placeholder="Test case 2" required>
                                    <input name ="answer2" type="text" id="answer2" placeholder="Answer 2" required>
                                </div>
                                <div class="action">
                                    <button onclick="getOption()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>

        </div>
        <div class="col g-0">
            <div class="rightside">
            <div class="question-form">
                    <h1>Bank Questions</h1>
                        <form method = "POST" action>
                            <div class = "content">
                                <select class="form-select" id = "filter1" aria-label="Default select example">
                                    <option value="all">All</option>
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <select class="form-select" id = "filter2" aria-label="Default select example">
                                    <option value="all">All</option>
                                    <option value="forLoop">For Loop</option>
                                    <option value="lists">Lists</option>
                                    <option value="recursion">Recursion</option>
                                </select>
                                <div class="action">
                                    <button onclick="selectOption()">Submit</button>
                                </div>
                            </div>
                        </form>
                        <h1>List of Questions</h1>
                         <table class="table table-dark">
                            <thead>
                                <th>Id</th>
                                <th>Question</th>
                                <??>
                            </thead>
                            <tbody>
                            <?php if (is_array($data) || is_object($data)):?>
                                
                            <?php foreach($data as $record):?>
                            <tr>
                                <td><?php echo $record->id;?></td>
                                <td><?php echo $record->question;?></td>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
            </div>
               
        </div>
    </div>
</body>
</html>
<script>

    function getOption(){

        var select_topic = document.querySelector('#select1');
        var topic = select_topic.options[select_topic.selectedIndex].value;
        var select_difficulty = document.querySelector('#select2');
        var difficulty = select_difficulty.options[select_difficulty.selectedIndex].value;
        var question = document.getElementById('question').value;
        var test_case1 = document.getElementById('testCase1').value;
        var answer1 = document.getElementById('answer1').value;
        var test_case2 = document.getElementById('testCase2').value;
        var answer2 = document.getElementById('answer2').value;

        passQuestion(topic,difficulty,question,test_case1,answer1,test_case2,answer2);
    }
    function selectOption(){

        var selectFilter1 = document.querySelector('#filter1');
        var filter1 = selectFilter1.options[selectFilter1.selectedIndex].value;
        var selectFilter2 = document.querySelector('#filter2');
        var filter2 = selectFilter2.options[selectFilter2.selectedIndex].value;
        passFilter(filter1,filter2);
    }
    function passQuestion(topic, level,question,test_case1,answer1,test_case2,answer2){
        var sending_data = {};
        sending_data.topic = topic;
        sending_data.level = level;
        sending_data.question = question;
        sending_data.test1 = test_case1;
        sending_data.answer1 = answer1;
        sending_data.test2 = test_case2;
        sending_data.answer2 = answer2;
        console.log(sending_data);
        $.ajax({
            url:"https://afsaccess4.njit.edu/~ec378/send_question.php?cmd=savequestion",
            method: "POST", 
            data: sending_data,
            success: function(res){
                console.log(res);
            }
        })


    }
    function passFilter(filter1, filter2){
        var filter_data = {};
        filter_data.filter1 = filter1;
        filter_data.filter2 = filter2;
        $.ajax({
            url:"https://afsaccess4.njit.edu/~ec378/send_question.php?cmd=listquestions",
            method: "POST",
            data: filter_data,
            success: function(res){
                console.log(res);
            }
        })


    }
    function sendBack(sending_data){
        $.ajax({
            url:"https://afsaccess4.njit.edu/~ec378/create_question.php",
            method: "POST",
            data: sending_data,
            success: function(res){
                console.log(res);
            }
        })


    }
</script>