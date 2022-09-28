<?php include("nav.php"); ?>
<!DOCTYPE html>
<html>
<head>
<title>AUTOGRADE</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="create_question.css">
</head>
<body>
<?php
    $ch = curl_init('https://afsaccess4.njit.edu/~odt5/grader.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
    $final_response = json_decode($response);
    echo '<div class="rightside">';
    echo '<div class="question-form">';
    echo "<h1> AUTOGRADE </h1>";
    echo '<div class = "content">';
    echo '<h1>ALL TAKEN TESTS ARE GRADED</h1>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
?>

</body>
</html>