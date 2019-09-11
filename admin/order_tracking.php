<?php
  include '../config/database.php';
  include '../objects/Orders.php';
  include '../objects/Sales.php';
  // core configuration
  include_once "../config/core.php";
  // check if logged in as admin
  include_once "login_checker.php";
  $database = new Database();
  $db = $database->getConnection();
  date_default_timezone_set('Asia/Manila');
  $firstname = $_SESSION['firstname'];
  $lastname = $_SESSION['lastname'];
?>

<?php 
  $page_title = "Order Tracking";
  include_once ('../layouts/layout_header.php'); 
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Orders</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user"></i>
            Orders
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="text-center font-weight-bold">
                    <th>Order Date</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $orders = new Orders($db);
                  $stmt = $orders->read();

                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  
                  echo "
                    <tr class='text-center'>
                      <td>$order_date</td>
                      <td>$title</td>
                      <td>$quantity</td>
                      <td>$firstname $lastname</td>
                      <td>$email</td>
                      <td>$contact</td> 
                  ";
                ?>
                      <td>
                        <?php 
                          if ($order_status == "pending") {
                            echo "<span class='badge badge-pill badge-danger'>Pending</span>";
                          }
                          else if ($order_status == "confirmed") {
                            echo "<span class='badge badge-pill badge-success'>Confirmed</span>";
                          }
                        ?>
                        
                      </td>
                      <td>
                      <?php 
                        if ($order_status == "pending") {
                      ?>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                          <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                          <input type="hidden" name="order_date" value="<?php echo $order_date; ?>"/>
                          <input type="hidden" name="title" value="<?php echo $title; ?>"/>
                          <input type="hidden" name="price" value="<?php echo $price; ?>"/>
                          <input type="hidden" name="quantity" value="<?php echo $quantity; ?>"/>
                          <input type="hidden" name="total" value="<?php echo $total; ?>"/>
                          <input type="hidden" name="firstname" value="<?php echo $firstname; ?>"/>
                          <input type="hidden" name="lastname" value="<?php echo $lastname; ?>"/>
                          <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                          <input type="hidden" name="contact" value="<?php echo $contact; ?>"/>
                          <input type="hidden" name="order_status" value="<?php echo $order_status; ?>"/>
                          <button type="submit" class="btn btn-success btn-sm" name="takeout" id="takeout"><i class="fa fa-check"></i></button>
                        </form>
                      <?php
                        }
                        else if ($order_status == "confirmed") {
                          echo "<h5><span class='badge badge-danger'><i class='fa fa-times'></i></span></h5>";
                        }
                      ?>
                      </td>
                    </tr>

                    <?php
                      }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

       
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <!-- <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer> -->

    </div>
    <!-- /.content-wrapper -->

<?php include_once ('../layouts/layout_footer.php'); ?>

<?php include 'takeout.php'; ?>