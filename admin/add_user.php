<?php

  if(isset($_POST['add_user'])) {
    $user = new Accounts($db);
    $user->user_id = $_POST['user_id'];
    $user->password = md5($_POST['lastname']);
    $user->firstname = strtoupper($_POST['firstname']);
    $user->lastname = strtoupper($_POST['lastname']);
    $user->userlevel = $_POST['userlevel'];
    $user->user_status = $_POST['user_status'];

    if($user->create()) {
      echo"
          <script type='text/javascript'>
            Swal.fire({ 
              title: 'Successfully Added!',
              type: 'success', 
              }).then(function() {
                window.location.href = 'user_accounts.php';
              });   
          </script>
        ";
    }

    else {
      echo"
          <script type='text/javascript'>
            Swal.fire({ 
              title: 'Unable to create user!',
              type: 'error' 
              });   
          </script>
        ";
    }
  }
?>