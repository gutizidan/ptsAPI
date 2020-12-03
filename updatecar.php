<?php
include("conn.php");
if (isset($_POST['id_auth']) && isset($_POST['id']) && isset($_POST['kode']) && isset($_POST['merk']) && isset($_POST['jenis']) && isset($_POST['warna']) && isset($_POST['hargasewa'])) {
  $id_auth = $_POST['id_auth'];
  $id = $_POST['id'];
  $kode = $_POST['kode'];
  $merk = $_POST['merk'];
  $jenis = $_POST['jenis'];
  $warna = $_POST['warna'];
  $hargasewa = $_POST['hargasewa'];
  $json["SENDER"] = array();
  $json["STATUS"] = array();
  $json["MESSAGE"] = array();

  // Enkripsi Password
  // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
  $query = "SELECT roleuser FROM tbuser WHERE id = '$id_auth'";
  $result2 = mysqli_query($con, $query);
  $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
  if ($row2["roleuser"]== 2 ) {
    $sql = "UPDATE tbmobil SET kode = '$kode', merk = '$merk', jenis = '$jenis', warna = '$warna', hargasewa = '$hargasewa' WHERE id = '$id'";
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