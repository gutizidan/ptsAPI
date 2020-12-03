<?php
include("conn.php");
if (isset($_POST['kode']) && isset($_POST['merk']) && isset($_POST['jenis']) && isset($_POST['warna']) && isset($_POST['hargasewa'])) {
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
  $query = "SELECT * FROM tbmobil WHERE kode = '$kode'";
  $check = mysqli_num_rows(mysqli_query($con, $query));
  if ($check == 0) {
    $sql = "INSERT INTO tbmobil(kode, merk, jenis, warna, hargasewa) VALUES ('$kode', '$merk', '$jenis', '$warna', '$hargasewa')";
    $sql2 = "SELECT * FROM tbmobil WHERE kode = '$kode'";
    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con,$sql2);
    $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    if ($result && $result2) {
      $json["SENDER"] = "RentalMobil";
      $json["STATUS"] = "SUCCESS";
      $json["MESSAGE"] = "SUCCESS";
      $json["PAYLOAD"]["MOBIL_ID"] = $row["id"];
      $json["PAYLOAD"]["MOBIL_KODE"] = $row["kode"];

    } else {
      $json["SENDER"] = "RentalMobil";
      $json["STATUS"] = "FAILED";
      $json["MESSAGE"] = mysqli_error($con);
    }
  } else {
    $json["SENDER"] = "RentalMobil";
    $json["STATUS"] = "FAILED";
    $json["MESSAGE"] = "Duplicated Car Code";
  }
} else {
  $json["SENDER"] = "RentalMobil";
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = "INPUT NOT FOUND";
}

echo json_encode($json);
mysqli_close($con);