<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Adim login</title>
 <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  <h2>Admin Login</h2>
  </div>
	 <form class="form" method="post" action="adminlog.php">
	<?php include('errors.php'); ?>
  	<div class="input-group">
  	<label>Username</label>
  	<input type="text" name="username" class="login-input" >
  	</div>
  <div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" class="login-input">
  </div>
  	<div class="input-group">
  <button type="submit"class="btn"name="login_user"><a href="admin/brands.php">Login</a></button>
  	</div>
  	

<p>
  		Not yet a member? <a href="adminreg.php">Sign up</a>
  </p>
 

 </form>
</body>
</html>
