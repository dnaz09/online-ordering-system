<?php
 if(isset($_POST['send'])){
    $feedbacks = new Feedbacks($db);
    $feedbacks->id = $_POST['id'];
    $feedbacks->firstname = $_POST['firstname'];
    $feedbacks->lastname = $_POST['lastname'];
    $feedbacks->mobile = '+639'.''.$_POST['mobile'];
    $feedbacks->email = $_POST['email'];
    $feedbacks->message = $_POST['message'];

    if ($feedbacks->send()) {
        echo"
        <script type='text/javascript'>
            Swal.fire({ 
              title: 'Meesage Sent!',
              type: 'success' 
            }).then(function(){
                window.location.href = 'contact_us.php';
            });   
        </script>
        ";
    }
}
?>
