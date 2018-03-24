<?php
session_start();

?>

<html>
<head>
<title>KBANK MOBILE BANKING</title>
<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
<div class="header">
</div>
<h1>HOME</h1>
<div class="content">
<h2>Welcome <?php echo $_SESSION['username']; ?> </h2></div>
<p><a href="logout.php">LOGOUT</a></p>
</body>
</html>
