<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
  <section class="service">
    <div class="head-section">
      <h2>Nordic Farms<br></h2>
    </div>
    <ul class="service-list clearfix">
      <li>
        <p class="icon"><i class="fas fa-desktop"></i></p>
        <h3>Friman_metsola</h3>
        <p class="text">Location</p>
      </li>

      <li>
        <p class="icon"><i class="fas fa-mobile-alt"></i></p>
        <h3>Nooras_farm</h3>
        <p class="text">Location</p>
      </li>

      <li>
        <p class="icon"><i class="fab fa-whmcs"></i></p>
        <h3>Olssi_farm</h3>
        <p class="text">Location</p>
      </li>

      <li>
        <p class="icon"><i class="fab fa-whmcs"></i></p>
        <h3>PartialTech</h3>
        <p class="text">Location</p>
      </li>
    </ul>
  </section>

  <?php
  // define variables and set to empty values
  $Message = $ErrorUname = $ErrorPass = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $username = check_input($_POST["username"]);

      if (!preg_match("/^[a-zA-Z0-9_]*$/",$username)) {
        $ErrorUname = "Space and special characters not allowed but you can use underscore(_).";
      }
  	else{
  		$fusername=$username;
  	}

  	$fpassword = check_input($_POST["password"]);

    if ($ErrorUname!=""){
  	$Message = "Login failed! Errors found";
    }
    else{
    include('conn.php');

    $query=mysqli_query($conn,"select * from `user` where username='$fusername' && password='$fpassword'");
    $num_rows=mysqli_num_rows($query);
    $row=mysqli_fetch_array($query);

    if ($num_rows>0){
  	  $Message = "Login Successful!";
    }
    else{
  	$Message = "Login Failed! User not found";
    }

    }
  }

  function check_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <section class="invite">
    <p class="icon"><i class="far fa-envelope"></i></p>
    <h2>Login To See Data</h2>
    <p class="info">Please enter valid username and password to login!</p>
    <p><span class="message">* required field.</span></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <p class="login">Username: <input type="text" name="username" required></p>
      <span class="message">* <?php echo $ErrorUname;?></span><br><br>
      <p class="login">Password: <input type="password" name="password" required></p>
      <span class="message">* <?php echo $ErrorPass;?></span><br><br>
      <p class="btn"><button type="submit">Login</button></p>
    </form>

    <span class="message">
    <?php
    	if ($Message=="Login Successful!"){
    		echo $Message;
    		echo 'Welcome, '.$row['fullname'];
    	}
    	else{
    		echo $Message;
    	}

    ?>
    </span>
  </section>

  <footer id="footer">
    <div class="inner clearfix">
      <div class="about-us">
        <h3>About us</h3>
        <p>Finnish Farms</p>
      </div>

      <div class="info-link">
        <h3>Quick Links</h3>
        <nav>
          <ul>
            <li><a href="./Register.html">Register</a></li>
            <li><a href="./">Data</a></li>
          </ul>
        </nav>
      </div>

      <div class="follow-us">
        <h3>Follow Us</h3>
        <ul>
          <li class="facebook"><a href="./"><i class="fab fa-facebook-f"></i></a></li>
          <li class="google-plus"><a href="./"><i class="fab fa-google-plus-g"></i></a></li>
          <li class="linkedin"><a href="./"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>
    </div>

    <p class="copyright">Tien Nguyen</p>
  </footer>
</body>
</html>
