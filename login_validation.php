<?php
if (isset($_POST['login'])) {          
  
  $user_id = $_POST['user_id'];
  $password = md5($_POST['password']);
  $query = "SELECT * FROM tbl_users WHERE user_id='$user_id' AND password='$password' AND user_status = 'active'";
  $stmt = $conn->prepare($query);
      $stmt->bind_param("isssssss", $id, $user_id, $password, $firstname, $lastname, $userlevel, $user_status, $created);
      $stmt->execute();
      $stmt->bind_result($id, $user_id, $password, $firstname, $lastname, $userlevel, $user_status, $created);

    if ($stmt->fetch())
      {
        if ($userlevel == 'admin') {        
           	$_SESSION['id']=$id;
            $_SESSION['user_id'] = $user_id;
      			$_SESSION['firstname'] = $firstname;
      			$_SESSION['lastname'] = $lastname;
      			$_SESSION['password'] = $password;
      			$_SESSION['userlevel'] = $userlevel;
            $_SESSION['user_status'] = $user_status;
            $_SESSION['created'] = $created;
      			$_SESSION['id'];

        echo '<script type="text/javascript">
                window.location = "admin/dashboard.php"
              </script>';
        }
  
        if ($userlevel == 'user') {  
           	$_SESSION['id'] = $id;
            $_SESSION['user_id'] = $user_id;
      			$_SESSION['firstname'] = $firstname;
      			$_SESSION['lastname'] = $lastname;
      			$_SESSION['password'] = $password;
      			$_SESSION['userlevel'] = $userlevel;
            $_SESSION['user_status'] = $user_status;
            $_SESSION['created'] = $created;
      			$_SESSION['id'];

            echo '<script type="text/javascript">';
            echo 'window.location = "user/uploadmenu.php"';
            echo '</script>';
          }
        }

      else {
        echo "<script type='text/javascript'>
            alert('Login Credentials Not Valid!');
          </script>";
      }
}
?>