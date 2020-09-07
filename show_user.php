<?php
include("conn.php");
if (isset($_POST['id'])) {
  $u_id = $_POST['id'];
  $sql2 = "SELECT roleuser FROM tbuser WHERE id = '$u_id'";
  $result2 = mysqli_query($con, $sql2);
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
if ($row2["roleuser"]== 2 ){


$sql = "SELECT * FROM tbuser";
$json["SENDER"] = array();
$json["STATUS"] = array();
$json["MESSAGE"] = array();
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);
if ($result) {
  $json["SENDER"] = "RentalMobil";
  $json["STATUS"] = "SUCCESS";
  $json["MESSAGE"] = "SUCCESS";
  if ($count > 0) {
    $json["PAYLOAD"]["DATA"] = [];
    while ($row = mysqli_fetch_array($result)) {
      $array["ID"] = $row['id'];
      $array["EMAIL"] = $row['email'];
      $array["NAMA"] = $row['nama'];
      $array["NOHP"] = $row['nohp'];
      $array["ALAMAT"] = $row['alamat'];
      $array["NOKTP"] = $row['noktp'];
      if ($row["roleuser"] == 1) {
        $array["ROLE"] = "customer";
      } elseif ($row["roleuser"] == 2) {
        $array["ROLE"] = "admin";
      }
      array_push($json["PAYLOAD"]["DATA"], $array);
    }
  } else {
    $json["PAYLOAD"]["DATA"] = "null";
  }
} else {
  $json["SENDER"] = "RentalMobil";
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = mysqli_error($con);
}
} else {
  $json["SENDER"] = "RentalMobil";
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = "ORA ADMIN SU";}

}
echo json_encode($json);
mysqli_close($con);