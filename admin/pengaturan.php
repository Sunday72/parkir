<?php
$title = "Pengaturan";
include "layouts/app.php";
include "../function/function.php";

$parkir_motor = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 1");
$parkir_mobil = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 2");
?>

<div class="row">
  <div class="col-md-5">
    <form action="" method="post">
      <div class="mb-3">
        <label for="cek" class="form-label">cek</label>
        <input type="text" class="form-control" placeholder="cek..">
      </div>
    </form>
  </div>
</div>






<?php include "layouts/footer.php"; ?>