<?php
// core configuration
include_once "config/core.php";
 
// set page title
$page_title = "Reset Password";
 
// include login checker
include_once "login_checker.php";
 
// include classes
include_once "config/database.php";
include_once "objects/Accounts.php";
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$user = new Accounts($db);
 

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $page_title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

<?php

    // get given access code
    $access_code=isset($_GET['access_code']) ? $_GET['access_code'] : die("Access code not found.");
    
    // check if access code exists
    $user->access_code=$access_code;
    
    if(!$user->accessCodeExists()) {
        die('Access code not found.');
    }
    
    else {
        // if form was posted
        if($_POST) {
        
            // set values to object properties
            $user->password=$_POST['password'];
        
            // reset password
            if($user->updatePassword()) {
                echo "<div class='alert alert-info'>Password was reset. Please <a href='{$home_url}login'>login.</a></div>";
            }
        
            else {
                echo "<div class='alert alert-danger'>Unable to reset password.</div>";
            }
        }
 
        echo "
        <div class='container'>
            <div class='card card-login mx-auto mt-5'>
                <div class='card-header'>Reset Password</div>
                <div class='card-body'>
                    <div class='text-center mb-4'>
                        <h4>Forgot your password?</h4>
                        <p>Enter your email address and we will send you instructions on how to reset your password.</p>
                    </div>
                    <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?access_code={$access_code}' method='POST'>
                        <div class='form-group'>
                            <div class='form-label-group'>
                                <input type='password' name='password' id='inputPassword' class='form-control' placeholder='Enter new password' required='required' autofocus='autofocus'>
                                <label for='inputPassword'>Password</label>
                            </div>
                        </div>
                        <button type='submit' class='btn btn-primary btn-block'>Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
        ";
}
?>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
