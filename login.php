<?php 
session_start();
$errors = array();

$db = mysqli_connect("localhost", "", "", "authentication");


if (isset($_POST['login_btn'])){
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']); 
    if (empty($username)){
        array_push($errors, "Username is required");
    }
    if (empty($password)){
        array_push($errors, "Password is required");
    }
    if (count($errors) == 0){
        $password =md5($password);
        $q = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $q);
        if(mysqli_num_rows($result) == 1){
            $_SESSION['username'] = $username;
            $_SESSION['message'] = 'You have successfully logged in';
            header("location: home.php"); //redirection
        }else{
            array_push($errors, "The username and password do not match");
            header('location: login.php');
        }
    }
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style3.css">

</head>
<body>

<form action="login.php" method="post">
<?php include 'errors.php';?>
<div class="header">
<h1>KBANK LOGIN PAGE</h1>
</div>
<div class="fam">
<label>Username</label>
<input type="text" name="username">
</div>
<div class="fam">
<label>Password</label>
<input type="password" name="password">
</div>
<div class="fam"></div>
<input type="submit" name="login_btn" value="Login" class="btn">
<p class="message"> Not yet Registered? <a href="registration.php">Register</a></p>
</form>
</body>
</html>
