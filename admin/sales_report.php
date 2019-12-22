<?php
  include '../config/database.php';
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
  $page_title = "Sales Report";
  include_once ('../layouts/layout_header.php'); 
?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Sales Report</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user"></i>
            Sales Report
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr class="text-center font-weight-bold">
                    <th>Order Date</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Full Name</th>
                    <th>Email Address</th>
                    <th>Contact Number</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $incrementTotal = 0;
                $format = "0";
                $sales = new Sales($db);
                $stmt = $sales->read();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  $incrementTotal += str_replace(',','', $total);
                  $format = number_format($incrementTotal, 2, '.', ',');
                  $total = number_format($total, 2, '.', ',');
                  $price = number_format($price, 2, '.', ',');
                  
                  echo "
                    <tr class='text-center'>
                      <td>$order_date</td>
                      <td>$title</td>
                      <td>$price</td>
                      <td>$quantity</td>
                      <td>$total</td>
                      <td>$firstname $lastname</td>
                      <td>$email</td>
                      <td>$contact</td>
                    </tr>
                  ";
                }
                echo "
                <div class='row'>
                  <div class='col-sm-4 input-group mb-3'>
                    <div class='input-group-prepend'>
                      <span class='input-group-text bg-dark text-white font-weight-bold'>Total Sales:</span>
                    </div>
                    <input type='text' class='form-control font-weight-bold' value='$format' readonly
                  </div>
                </div>
              ";
                ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

        <p class="small text-center text-muted my-5">
          <em>More table examples coming soon...</em>
        </p>

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
