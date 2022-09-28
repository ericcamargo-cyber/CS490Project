
<?php
    //this file sends the question from the create question page to the database
    $cmd = "";
    if (isset($_GET["cmd"]) && ($_GET["cmd"] != "")){
        $cmd = $_GET["cmd"];
    }
    switch($cmd) {
      case "savequestion":
          $error ="";
          $topic = $_POST['topic'];
          $level = $_POST['level'];
          $question = $_POST['question'];
          $test1 = $_POST['test1'];
          $answer1 = $_POST['answer1'];
          $test2 = $_POST['test2'];
          $answer2 = $_POST['answer2'];
          $post = [
            'topic'=> $topic,
            'level'=> $level,
            'question'=> $question,
            'test1'=> $test1,
            'answer1'=> $answer1,
            'test2'=> $test2,
            'answer2'=> $answer2
          ];
          $ch = curl_init('https://afsaccess4.njit.edu/~odt5/new_controller.php?cmd=savequestion');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
          $response = curl_exec($ch);
          curl_close($ch);
          break;

          case "listquestions" :
            $ch = curl_init('https://afsaccess4.njit.edu/~odt5/new_controller.php?cmd=listquestions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
            $data= curl_exec($ch);
            curl_close($ch);
            $data = json_decode($data);
            break;

          case "sendExam" :
            $ch = curl_init('https://afsaccess4.njit.edu/~odt5/new_controller.php?cmd=sendExam');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
            $data= curl_exec($ch);
            curl_close($ch);
            break;
        }
    /*$conn = new mysqli("sql1.njit.edu", "odt5", "2013627974OoSs!", "odt5");
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    }
    else{
      $stmt = $conn->prepare("INSERT INTO Testing(topic,`level`, question, test1,test2) values(?,?,?,?,?)");
      $stmt -> bind_param("sssss",$topic, $level, $question, $test1, $test2);
      $stmt -> execute();
      $stmt -> close();
      $conn -> close();
    }
    $filter1 = $_POST['filter1'];
    $filter2 = $_POST['filter2'];
    $conn = new mysqli("sql1.njit.edu", "odt5", "2013627974OoSs!", "odt5");
    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    }
    else{
      $stmt = $conn->query("SELECT id, question FROM Testing"); //preparing my select table ;//The result to check if data already exists in the database
      
        $data = $stmt->fetch_all(MYSQLI_ASSOC);//if num of rows is greater than 0 
      }*/
  
?>