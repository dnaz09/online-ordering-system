<?php 
  // require_once 'config/connection.php';
  include_once 'objects/Orders.php';
  include_once 'objects/Menus.php';
  include 'config/database.php';
  $database = new Database();
  $db = $database->getConnection();
  date_default_timezone_set('Asia/Manila');
?>

<?php include 'layouts/_layout_header.php'; ?>

 
    
<div class="container mt-5">      
  <div class='row'>
      <?php
          $menus = new Menus($db);
          $stmt = $menus->read();
          
          if($stmt->rowCount()) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
      ?>  
        <div class='col-md-4'>
          <div class='card mt-5 mb-3'>
            <div class='card-header menu-header'>              
              <img class='card-img-top img-fluid img-thumbnail' src='images/<?php echo $image; ?>' alt='Card image cap'>
            </div>
            <div class='card-body'>
              <h3 class='card-title text-center'><?php echo $title; ?><br><small><?php echo '₱'.''.$price?></small></h3>
              <p class='card-text text-center' style='font-size: 15px;'><?php echo $content; ?></p>
            </div>
            <div class='card-footer text-center'>
              <a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#orderForm<?php echo $id; ?>'><i class='fa fa-shopping-cart'></i> Order Now!
              </a>
            </div>
          </div>
        </div>
        <?php include 'menu_modal.php'; ?>
        <?php } ?>
      
      <?php
      } 
      else {
      ?>
      <div class="col-md-12 mt-5 pt-5 mb-5">
        <div class="jumbotron mt-5 pt-5 mb-5 text-center">
          <i class="fa fa-frown fa-10x"></i>
            <h1>
              404 Menu Not Found!
            </h1>
        </div>
      </div>
      <?php                
          }
      ?>
  </div>  
</div>
<div class="footer pt-3 pb-3 mt-5 bg-dark text-center text-white m-0">
  <p> &copy; Copyright Your Website 2018</p>
</div>

<?php include 'layouts/_layout_footer.php'; ?>

<?php include 'send_orders.php'; ?>