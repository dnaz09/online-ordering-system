<?php
include("../config/connection.php");
include("../config/database.php");
include("../objects/Messages.php");
$database = new Database();
$db = $database->getConnection();
$message = new Messages($db);

if(isset($_POST["view"])) {
  if($_POST["view"] != '') {
    $message->update();
    // $update_query = "UPDATE tbl_contacts SET status = 1 WHERE status = 0";
    // $conn->query($update_query);
  }
  $stmt = $message->read();
  // $query = "SELECT * FROM tbl_contacts ORDER BY id DESC LIMIT 5";
  // $result = $conn->query($query);
  $output = '';
  if($stmt->rowCount()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // extract($row);
  // if($result->num_rows > 0) {
  //   while($row = $result->fetch_assoc()) {
    $output .= '
      <div>
        <a href="feedbacks.php" class="dropdown-item">
          <div class="dropdown-message small"><strong>'.$row["firstname"].' '.$row["lastname"].'</strong>
          </div>
          <span class="small text-muted">'.$row["message"].'</span>
        </a>
      
      <div class="dropdown-divider"></div>
      </div>
    ';
    }
    $output .= '<a class="dropdown-item small" href="feedbacks.php">View All Messages</a>';
  }
  else {
    $output .= 
      '<li class="dropdown-item">
        <h6 class="text-bold">No Messages Found</h6>
      </li>';
  }

  // $query_1 = "SELECT * FROM tbl_contacts WHERE status = 0";
  // $result_1 = $conn->query( $query_1);
  // $count = $result_1->num_rows;
  $stmt = $message->readOne();
  $count = $stmt->rowCount();
  $data = array(
    'messages'   => $output,
    'unseen_messages' => $count
  );
  echo json_encode($data);
}
?>
