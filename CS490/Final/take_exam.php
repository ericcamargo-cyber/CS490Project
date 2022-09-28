<!DOCTYPE html>
<html>
<head>
<title>TAKE EXAM</title>
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
                    <h1>Take Exam</h1>
                        <form method="POST" action="https://afsaccess4.njit.edu/~ec378/send_answer.php">
                            <div class = "content">
                                <select class="form-select" id = "select1" aria-label="Default select example">
                                    <option value="question1">Question #1</option>
                                    <option value="question2">Question #2</option>
                                </select>
                                <div class="mb-3">
                                    <!-- <label for="exampleFormControlTextarea1" class="form-label">Enter a new question</label> must replace this with the question retrieved from the filter and from the db-->
                                    <textarea name="answer" class="form-control" id="exampleFormControlTextarea1" rows=5></textarea>
                                </div>
                                <div class="action">
                                    <button onclick="getOption()">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    //this code does the same that the create_question.php file does with send_question.php but instead of sending a question this needs to retrieve
    //a question from the database
    function callPHP(params) {
    var httpc = new XMLHttpRequest(); // simplified for clarity
    var url = "https://afsaccess4.njit.edu/~ec378/send_question.php";
    httpc.open("POST", url, true); // sending as POST

    httpc.onreadystatechange = function() { //Call a function when the state changes.
        if(httpc.readyState == 4 && httpc.status == 200) { // complete and no errors
            alert(httpc.responseText); // some processing here, or whatever you want to do with the response
        }
    };
    httpc.send(params);
}

    function getOption(){

        var selectElement1 = document.querySelector('#select1');
        var output1 = selectElement1.options[selectElement1.selectedIndex].value;
        var selectElement2 = document.querySelector('#select2');
        var output2 = selectElement2.options[selectElement2.selectedIndex].value;
        passVal(output1,output2);
    }
    function selectOption(){

        selectFilter1 = document.querySelector('#filter1');
        output3 = selectFilter1.options[selectFilter1.selectedIndex].value;
        selectFilter2 = document.querySelector('#filter2');
        output4 = selectFilter2.options[selectFilter2.selectedIndex].value;
    }
    function passVal(topic, level){
        var sending_data = {};
        sending_data.topic = topic;
        sending_data.level = level;
        
        $.ajax({
            url:"https://afsaccess4.njit.edu/~ec378/send_answer.php",
            method: "POST",
            data: sending_data,
            success: function(res){
                console.log(res);
            }
        })


    }
    
</script>