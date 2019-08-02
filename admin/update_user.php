<?php
if(isset($_POST['update_users'])) {

    $user = new Accounts($db);
    $user->id = $_POST['id'];
    $user->user_id = $_POST['user_id'];
    $user->password = md5($_POST['lastname']);
    $user->firstname = strtoupper($_POST['firstname']);
    $user->lastname = strtoupper($_POST['lastname']);
    $user->userlevel = $_POST['userlevel'];

    if($user->update()) {
      echo"
          <script type='text/javascript'>
            Swal.fire({ 
              title: 'Successfully Updated!',
              type: 'success' 
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
              title: 'Unable to update!',
              type: 'error' 
              });   
          </script>
        ";
    }
  }