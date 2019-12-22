<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Login";
 
// include login checker
$require_login = false;
include_once "login_checker.php";
 
// default to false
$access_denied = false;
 
// if the login form was submitted
if($_POST) {

// include classes
include_once "config/database.php";
include_once "objects/Accounts.php";
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new Accounts($db);
 
// check if email and password are in the database
$user->email=$_POST['email'];
 
// check if email exists, also get user details using this emailExists() method
$email_exists = $user->emailExists();
 
// validate login
if ($email_exists && password_verify($_POST['password'], $user->password) && $user->status==1) {
 
    // if it is, set the session value to true
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user->id;
    $_SESSION['access_level'] = $user->access_level;
    $_SESSION['firstname'] = htmlspecialchars($user->firstname, ENT_QUOTES, 'UTF-8') ;
    $_SESSION['lastname'] = $user->lastname;
 
    // if access level is 'Admin', redirect to admin section
    if($user->access_level=='Admin') {
        header("Location: {$home_url}admin/index.php?action=login_success");
    }
 
    // else, redirect only to 'Customer' section
    else {
        header("Location: {$home_url}admin/index.php?action=login_success");
    }
}
// if username does not exist or password is wrong
else {
    $access_denied = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
      <?php
        // get 'action' value in url parameter to display corresponding prompt messages
        $action = isset($_GET['action']) ? $_GET['action'] : "";
    
        // tell the user he is not yet logged in
        if($action =='not_yet_logged_in') {
            echo "<div class='alert alert-danger mt-3' role='alert'>Please login.</div>";
        }
        
        // tell the user to login
        else if($action == 'please_login') {
            echo "<div class='alert alert-info'>
                <strong>Please login to access that page.</strong>
            </div>";
        }
        
        // tell the user email is verified
        else if($action == 'email_verified') {
            echo "<div class='alert alert-success'>
                <strong>Your email address have been validated.</strong>
            </div>";
        }
        
        // tell the user if access denied
        if($access_denied) {
            echo "<div class='alert alert-danger margin-top-40' role='alert'>
                Access Denied. <br> Your username or password maybe incorrect.
            </div>";
        }
      ?>
        <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required="required" autofocus="autofocus">
              <label for="email">Email Address</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div>
          <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot_password.php">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
