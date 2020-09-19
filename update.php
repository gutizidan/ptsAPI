<?php
include("conn.php");
if (isset($_POST['id_auth']) && isset($_POST['id']) && isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['noktp']) && isset($_POST['nohp']) && isset($_POST['alamat'])) {
  $id_auth = $_POST['id_auth'];
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $nohp = $_POST['nohp'];
  $noktp = $_POST['noktp'];
  $alamat = $_POST['alamat'];
  $json["SENDER"] = array();
  $json["STATUS"] = array();
  $json["MESSAGE"] = array();

  // Enkripsi Password
  // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
  $query = "SELECT roleuser FROM tbuser WHERE id = '$id_auth'";
  $result2 = mysqli_query($con, $query);
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
  if ($row2["roleuser"]== 2 ) {
    $sql = "UPDATE tbuser SET nama = '$nama', noktp = '$noktp', nohp = '$nohp', alamat = '$alamat', email = '$email' WHERE id = '$id'";
    $json["STATUS"] = array();
    $json["MESSAGE"] = array();
    $result = mysqli_query($con, $sql);
    if ($result) {
        $json["SENDER"] = "RentalMobil";
        $json["MESSAGE"] = "SUCCESS";
        $json["STATUS"] = "SUCCESS";
    } else {
        $json["SENDER"] = "RentalMobil";
        $json["STATUS"] = "FAILED";
    }
  } else {
    $json["SENDER"] = "RentalMobil";
    $json["STATUS"] = "FAILED";
    $json["MESSAGE"] = "ORA ADMIN";
  }
}

echo json_encode($json);
mysqli_close($con);