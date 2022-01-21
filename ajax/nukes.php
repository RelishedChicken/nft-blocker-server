<?php

//Server deets
$servername = "";
$username = "";
$password = "";
$dbname = "";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


//Set get?
if(isset($_REQUEST['method'])){
  $method = $_REQUEST['method'];
}else{
  $method = 'get';
}


//Set get data
if($method == 'get'){

  $sql = 'SELECT * from `nukes`';
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
   echo json_encode($row);
  }

}else{

  $nukes_dropped = 0;
  $sql = 'SELECT * from `nukes`';
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
    $nukes_dropped = $row['nukes_dropped'];
  }

  $nukes_dropped++;

  $sql = 'UPDATE `nukes` SET `nukes_dropped` = ?';
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('i', $nukes_dropped);
  $stmt->execute();

  $sql = 'SELECT * from `nukes`';
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) {
   echo json_encode($row);
  }

}


mysqli_close($conn);
