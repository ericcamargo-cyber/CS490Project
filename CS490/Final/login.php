<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Alpha Login Form</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="final-style.css">


<body>


<div class="login-form">
    
        <h1>Alpha Login</h1>
        <form method="POST" action="https://afsaccess4.njit.edu/~ec378/front.php">
            <div class="content">
                <div class="input-field">
                    <input name ="username" type="name" placeholder="Username">
                </div>
                <div class="input-field">
                    <input name = "password" type="password" placeholder="Password">
                </div>
            </div> 
	<div name ="error" id ="error"><?php echo $_GET["error"]; ?> </div>
            <div class="action">
                <button>Login</button>
            </div>
        </form>
</div>


</body>
</html>
