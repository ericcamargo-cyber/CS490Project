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
                    <h1>Create Exam</h1>
                        <form method="POST" action="https://afsaccess4.njit.edu/~ec378/send_exam.php">
                        <!--upon create exam action, exam is sent to send_exam.php page-->
							<div class = "content">
								<!--this is the code that handles the other page elements -->
								<div id="ExamMain" class="ExamItems ExamMain">
								<form id="SubmitExamForm" class="ExamItems ExamForm">
									<label for="Exam Name" class="ExamLabel ExamItems" required><strong>Enter an Exam Name </strong></label>
									<input type="text" name="Exam Name" placeholder="Exam Name" id="examname" class="ExamItems ExamInput"/>
									<!-- <input type="submit" value="Create Exam" class="ExamSubmit ExamItems"/> -->
									</form>
								<h3 id="response" class="ExamCreateResponse"></h3>
								<h2 id="examheader" class="ExamHeader"></h2>
								<!-- <label for="Filters" class="ExamLabel ExamItems"><strong>Filter to Search for Questions </strong></label> -->
                                </div>
                                <div id="ExamMain" class="ExamItems ExamMain">
								<form id="SubmitExamForm" class="ExamItems ExamForm">
									<label for="Question IDs" class="ExamLabel ExamItems" required><strong>Enter Questions ID Numbers </strong></label>
									<input type="text" name="Question IDs" placeholder="Question IDs" id="questionids" class="ExamItems ExamInput"/>
									</form>
								<h3 id="response" class="ExamCreateResponse"></h3>
								<h2 id="examheader" class="ExamHeader"></h2>
								
                                </div>
                                <div id="ExamMain" class="ExamItems ExamMain">
								<form id="SubmitExamForm" class="ExamItems ExamForm">
									<label for="Question IDs" class="ExamLabel ExamItems" required><strong>Enter Questions Respective Point Value </strong></label>
									<input type="text" name="Question IDs" placeholder="Question Points" id="question_points" class="ExamItems ExamInput"/> <!--may need to change around these values to get the correct output -->
									
									</form>
                                    <div class="content">
                                        <div class="action">
                                            <button onclick="EnterQuestion()">Create Exam</button>
                                        </div>
                        </div>

								<h3 id="response" class="ExamCreateResponse"></h3>
								<h2 id="examheader" class="ExamHeader"></h2>
								
                                </div>
                            
								<!--this is the code that handles the filters -- does not need to be on left side
							<select name="FilterTopic" id="ftopic" class="form-select" aria-label="Default select example">
									<option value="Recursion">Recursion</option>
									<option value="All">All</option>
									<option value="Math">Math</option>
       								<option value="Loops">Loops</option>
        							<option value="Lists">Lists</option>
	        						<option value="Strings">Strings</option>
								</select>
								<select name="FilterDifficulty" id="fdifficulty" class="form-select" aria-label="Default select example">
									<option value="Easy">Easy</option>
									<option value="All">All</option>
									<option value="Medium">Medium</option>
									<option value="Hard">Hard</option>
								</select> 
                            --> 
		
				<!--this is the code that handles the results -- does not need to be on the left side
								<div id="split" class="ExamSplit">
									    <div id="QuestionList" class="ExamItems ExamQuestions">
									    </div>
								    <div id="SelectedQuestions" class="ExamItems ExamSelections">
				
										<p> Results: </p>
									</div>
         
								</div>
                            -->
                        </div>
                        </form>

                </div>
            </div>
        </div>
        <div class="col g-0">
            <div class="rightside">
            <div class="question-form">
                    <h1>Bank Questions</h1>
                        <form>
                            <!-- instead of posting to that page we need to pull from somewhere-->
                            <div class = "content">
                                <select class="form-select" id = "filter1" aria-label="Default select example">
                                    <option value="easy">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <select class="form-select" id = "filter2" aria-label="Default select example">
                                    <option value="forLoop">For Loop</option>
                                    <option value="lists">Lists</option>
                                    <option value="recursion">Recursion</option>
                                </select>
                                <div class="action">
                                    <button onclick="selectOption()">Submit</button>
                                </div>
                            </div>
                        </form>
                        <table class="table table-dark">
                            <thead>
                                <th>Id</th>
                                <th>Questions</th>
                            </thead>
                            <tbody>
                            <?php if (is_array($data) || is_object($data)):?>
                            <?php foreach($data as $record):?>
                            <tr>
                                <td><?php echo $record->id;?></td>
                                <td><?php echo $record->question;?></td> <!--this accesses the element from the db and gets the id and question -->
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            
                        </table>
                        <!-- need to have a get method that produces the correct questions from the filter-->
                        </div>
            </div>
               
        </div>
    </div>
</body>
</html>

</html>
<script>
    //this code is going to have to handle getting the correct version of the
    //selected questions from above so that it can be sent to the back, and then sent to 
    //take_exam.php
    
 //this is where the code will need to start differing from create_question
    function EnterQuestion(){
        var examname = document.getElementById('examname').value;
        var questionid = document.getElementById('questionid').value;
        var question_points = document.getElementById('question_points').value;
        //can set up all of the data from pass question here and then only use pass question to set up
        //the array and substring get

        
        passQuestion(examname,questionid,question_points);
    }
    function passQuestion(examname,questionid,question_points) {//instead of this I am adding the different variables for sending the selected exam questions(topic, level,question,test_case1,test_case2){
        
        var length = (((parseInt(questionid.length))/3)+1);
        var sending_data = {}; //this is the one getting sent to middle
        
        var j=2;
        var i=0;
        for (let step=0; step < length; step++) { //interim array to get values
            var store_data ={};
            store_data.questionid = questionid.substring(i, j);
            store_data.question_points = questionid.substring(i, j);
            sending_data.push(store_data); //pushing both together
            i++;
            i++;
            i++;
            j++;
            j++;
            j++;
        }

        
        

        //sending_data.examname = examname;
        //sending_data.questionid = questionid;
        //sending_data.question_points = question_points;
        console.log(sending_data);

        
        $.ajax({
            url:"https://afsaccess4.njit.edu/~ec378/send_question.php?cm=sendExam",
            method: "POST", 
            data: sending_data,
            success: function(res){
                console.log(res);
            }
        })


    }
    
</script>
<?php
    echo ($_POST);
?>