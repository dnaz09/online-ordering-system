<?php
if (isset($_POST['send'])) {
    $order = new Orders($db);
    $order->id = $_POST['id'];
    $order->title = $_POST['title'];
    $order->price = str_replace(",", "", $_POST['price']);
    $order->quantity = $_POST['quantity'];
    $order->total = str_replace(",", "", $_POST['total']);
    $order->firstname = $_POST['firstname'];
    $order->lastname = $_POST['lastname'];
    $order->email = $_POST['email'];
    $order->contact = '+639'.''.$_POST['contact'];
    $order->order_status = $_POST['order_status'];

    if ($order->send()) {
        echo"
        <script type='text/javascript'>
            Swal.fire({ 
              title: 'Order Sent!',
              type: 'success' 
            }).then(function(){
                window.location.href = 'menu.php';
            });   
        </script>
        ";
    }
}
?>