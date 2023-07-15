<?php
$title = "Dashboard";
include "layouts/app.php";
include "../function/function.php";

$parkir_motor = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 1 LIMIT 10");
$parkir_mobil = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 2 LIMIT 10");
?>

<div class="row mb-4"> <!-- CARD -->
  <div class="col-md-3">
    <div class="border rounded shadow-sm p-3">
      <p class="fw-bold fs-4">10</p>
      <small class="text-muted">Pelanggan</small>
    </div>
  </div>
  <div class="col-md-3">
    <div class="border rounded shadow-sm p-3">
      <p class="fw-bold fs-4">10</p>
      <small class="text-muted">Pelanggan</small>
    </div>
  </div>
  <div class="col-md-3">
    <div class="border rounded shadow-sm p-3">
      <p class="fw-bold fs-4">10</p>
      <small class="text-muted">Pelanggan</small>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Plat Nomor</th>
          <th>Jam Masuk</th>
          <th>Jam Keluar</th>
          <th>Total Bayar</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($parkir_motor as $motor) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $motor['plat_nomor'] ?></td>
            <td><?= $motor['jam_masuk'] ?></td>
            <td><?= $motor['jam_keluar'] == '00:00:00' ? '-' : $motor['jam_keluar'] ?></td>
            <td>
              <?= $motor['status'] == 'process' ? '-' : $motor['total_biaya'] ?>
            </td>
            <td><?= $motor['status'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="col-md-6">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Plat Nomor</th>
          <th>Jam Masuk</th>
          <th>Jam Keluar</th>
          <th>Total Bayar</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($parkir_mobil as $mobil) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $mobil['plat_nomor'] ?></td>
            <td><?= $mobil['jam_masuk'] ?></td>
            <td><?= $mobil['jam_keluar'] == '00:00:00' ? '-' : $mobil['jam_keluar'] ?></td>
            <td>
              <?= $motor['status'] == 'process' ? '-' : $motor['total_biaya'] ?>
            </td>
            <td><?= $mobil['status'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>







<?php include "layouts/footer.php"; ?>