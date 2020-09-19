<?php
include("conn.php");
if (isset($_POST['id'])&& isset($_POST['id_delete'])) {
    $u_id = $_POST['id'];
    $u_id_delete = $_POST['id_delete'];

    $sql2 = "SELECT roleuser FROM tbuser WHERE id = '$u_id'";
    $result2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
  if ($row2["roleuser"]== 2 ){
    $sql = "DELETE FROM tbuser WHERE id = '$u_id_delete'";
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

  }
  else {
    $json["SENDER"] = "RentalMobil";
    $json["STATUS"] = "FAILED";
    $json["MESSAGE"] = "ORA ADMIN";}

}
echo json_encode($json);
mysqli_close($con);