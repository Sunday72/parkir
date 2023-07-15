<?php
$title = "Motor";
include "layouts/app.php";
include "../function/function.php";

$parkir_motor = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 1 ORDER BY tanggal DESC, jam_masuk DESC");
$no = 1;

if (isset($_POST['bayar'])) {
  if (bayarParkir($_POST)) {
    echo "<script>
        alert('Pembayaran Berhasil!');
        document.location.href = 'motor.php';
      </script>";
  }
}

if (isset($_POST['cari'])) {
  $keyword = $_POST['keyword'];
  $parkir_motor = cariMotor($keyword);
}
?>

<div class="row">
  <div class="col-md-5">
    <form action="" method="POST">
      <table class="table table-borderless">
        <tr>
          <td>
            <label for="plat">Cari Plat Nomor :</label>
          </td>
          <td>
            <div class="input-group mb-3">
              <input type="search" class="form-control" name="keyword" id="plat" placeholder="Masukkan Plat Nomor ...">
              <button type="submit" class="btn btn-dark" name="cari">Cari</button>
            </div>
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>

<hr>

<table class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Plat Nomor</th>
      <th>Tanggal</th>
      <th>Jam Masuk</th>
      <th>Jam Keluar</th>
      <th>Total Biaya</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($parkir_motor as $motor) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $motor['plat_nomor'] ?></td>
        <td><?= $motor['tanggal'] ?></td>
        <td><?= $motor['jam_masuk'] ?></td>
        <td><?= $motor['status'] == 'process' ? '-' : $motor['jam_keluar'] ?></td>
        <td><?= $motor['status'] == 'process' ? '-' : $motor['total_biaya'] ?></td>
        <td>
          <span class="badge bg-<?= $motor['status'] == 'process' ? 'warning' : 'success' ?>">
            <?= $motor['status'] ?>
          </span>
        </td>
        <td>
          <?php if ($motor['status'] == "process") : ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bayar<?= $motor['id_parkir'] ?>">
              BAYAR
            </button>

            <!-- Modal -->
            <div class="modal fade" id="bayar<?= $motor['id_parkir'] ?>" tabindex="-1" aria-labelledby="bayar<?= $motor['id_parkir'] ?>Label" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="bayar<?= $motor['id_parkir'] ?>Label">BAYAR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_parkir" value="<?= $motor['id_parkir'] ?>">
                    <input type="hidden" name="jam_keluar" value="<?= date('H:i:s') ?>">
                    <input type="hidden" name="tanggal" value="<?= $motor['tanggal'] ?>">


                    <div class="modal-body">
                      <table>
                        <tr>
                          <th>Plat Nomor</th>
                          <th>:</th>
                          <td>
                            <input type="text" value="<?= $motor['plat_nomor'] ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Tanggal</th>
                          <th>:</th>
                          <td>
                            <input type="date" value="<?= $motor['tanggal'] ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Jam Masuk</th>
                          <th>:</th>
                          <td>
                            <input type="time" value="<?= $motor['jam_masuk'] ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Jam Keluar</th>
                          <th>:</th>
                          <td>
                            <input type="time" value="<?= date('H:i:s') ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Selisih</th>
                          <th>:</th>
                          <td>
                            <?php
                            $timestampMasuk = strtotime($motor['jam_masuk']);
                            $timestampKeluar = strtotime(date('H:i:s'));
                            $selisihDetik = $timestampKeluar - $timestampMasuk;

                            $selisihJam = date('H', $selisihDetik);
                            ?>
                            <input type="number" value="<?= $selisihJam ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Biaya per Jam</th>
                          <th>:</th>
                          <td>
                            Rp <input type="number" value="<?= 2000 ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>TOTAL BAYAR</th>
                          <th>:</th>
                          <td>
                            <div class="bg-primary bg-opacity-10 text-primary border border-primary p-2 me-2 ">
                              <?php
                              $totalBiaya = $motor['biaya_per_jam'] + (2000 * $selisihJam) - 2000;
                              echo "Rp " . number_format($totalBiaya, 0, ", ", ".");
                              ?>
                              <input type="hidden" name="total_biaya" value="<?= $totalBiaya ?>">
                            </div>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="bayar" class="btn btn-primary">Bayar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>







<?php include "layouts/footer.php"; ?>