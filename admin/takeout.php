<?php

  if(isset($_POST['takeout'])) {
    $takeout = new Sales($db);
    $confirm = new Orders($db);
    $takeout->id = $_POST['id'];
    $takeout->order_date = $_POST['order_date'];
    $takeout->title = $_POST['title'];
    $takeout->price = $_POST['price'];
    $takeout->quantity = $_POST['quantity'];
    $takeout->total = $_POST['total'];
    $takeout->firstname = $_POST['firstname'];
    $takeout->lastname = $_POST['lastname'];
    $takeout->email = $_POST['email'];
    $takeout->contact = $_POST['contact'];
    $confirm->id = $_POST['id'];
    $confirm->status = $_POST['status'];

    if ($takeout->takeout() && $confirm->update()) {
      echo "
      <script type='text/javascript'>
        Swal.fire({ 
          title: 'Success!',
          type: 'success', 
          }).then(function() {
            window.location.href = 'order_tracking.php';
          });   
      </script>
      
      ";
    }
  }
  
?>