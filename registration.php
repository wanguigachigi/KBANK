<?php
session_start();
$errors = array();

//connecting to db
$db = mysqli_connect("localhost", "root", "Hazel355", "authentication");

if (isset($_POST['register_btn'])){
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    $password2 = mysqli_real_escape_string($db,$_POST['password2']);
    
    if (empty($username)){
        array_push($errors, "Username is required");
    }
    if (empty($email)){
        array_push($errors, "Email is required");
    }
    
    if (empty($password)){
        array_push($errors, "Password is required");
    }
    if ($password != $password2){
        array_push($errors, "The two passwords do not match!");
    }
    if (count($errors)==0){
        $password = md5($password);
        $sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
        mysqli_query($db, $sql);
        $_SESSION['username'] = $username;
        $_SESSION['message'] = 'You have successfully registered';
        header("location: home.php"); //redirection
        
    }else{
        $_SESSION['message'] = 'The two passwords do not match';
        
        
    }
   
    
    
}
?>
<html>
<head>
<title>KBANK MOBILE BANKING</title>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<form action="registration.php" method="post">
<div class="header">
<h1>KBANK REGISTRATION PAGE</h1>
</div>

<?php include 'errors.php';
?>

<div class="fam">
<label>Username</label>
<input type="text" name="username">
</div>
<div class="fam">
<label>Email</label>
<input type="email" name="email">
</div>
<div class="fam">
<label>Password</label>
<input type="password" name="password">
</div>
<div class="fam">
<label>Password Again</label>
<input type="password" name="password2">
</div>
<div class="fam"></div>
<input type="submit" name="register_btn" value="Register" class="btn">
<p class="message"> Already Registered? <a href="login.php">Login</a></p>

</form>
</body>
</html>