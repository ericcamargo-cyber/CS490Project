<?php

    $u = $_POST["username"];
    $p = $_POST["password"];
    //echo ($u ." ". $p);

// set post fields
$post = [
    'username' => $u,
    'password' => $p
];


//echo 'Curl: ', function_exists('curl_version') ? 'Enabled' : 'Disabled';

$ch = curl_init('https://afsaccess4.njit.edu/~odt5/middle.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = curl_exec($ch);
curl_close($ch);

$final_response = json_decode($response);
//var_dump($final_response);
switch ($final_response->user) {
    case "student":
        header('Location: https://afsaccess4.njit.edu/~ec378/student.php');

        break;
    case "teacher":
        
header('Location: https://afsaccess4.njit.edu/~ec378/teacher.php');

        break;
    default:
        
        header('Location: https://afsaccess4.njit.edu/~ec378/login.php?error=invalid credentials. try again');
        //echo "Error front";
        break;
}



?>

