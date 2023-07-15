<?php
$title = "Mobil";
include "layouts/app.php";
include "../function/function.php";

$parkir_mobil = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 2 ORDER BY tanggal DESC, jam_masuk DESC");
$no = 1;

if (isset($_POST['bayar'])) {
  if (bayarParkir($_POST)) {
    echo "<script>
        alert('Pembayaran Berhasil!');
        document.location.href = 'mobil.php';
      </script>";
  }
}
if (isset($_POST['cari'])) {
  $keyword = $_POST['keyword'];
  $parkir_mobil = cariMobil($keyword);
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
    <?php foreach ($parkir_mobil as $mobil) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $mobil['plat_nomor'] ?></td>
        <td><?= $mobil['tanggal'] ?></td>
        <td><?= $mobil['jam_masuk'] ?></td>
        <td><?= $mobil['jam_keluar'] ?></td>
        <td><?= $mobil['total_biaya'] ?></td>
        <td>
          <span class="badge bg-<?= $mobil['status'] == 'process' ? 'warning' : 'success' ?>">
            <?= $mobil['status'] ?>
          </span>
        </td>
        <td>
          <?php if ($mobil['status'] == "process") : ?>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bayar<?= $mobil['id_parkir'] ?>">
              BAYAR
            </button>

            <!-- Modal -->
            <div class="modal fade" id="bayar<?= $mobil['id_parkir'] ?>" tabindex="-1" aria-labelledby="bayar<?= $mobil['id_parkir'] ?>Label" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="bayar<?= $mobil['id_parkir'] ?>Label">BAYAR</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="" method="post">
                    <input type="hidden" name="id_parkir" value="<?= $mobil['id_parkir'] ?>">
                    <input type="hidden" name="jam_keluar" value="<?= date('H:i:s') ?>">
                    <input type="hidden" name="tanggal" value="<?= $mobil['tanggal'] ?>">


                    <div class="modal-body">
                      <table>
                        <tr>
                          <th>Plat Nomor</th>
                          <th>:</th>
                          <td>
                            <input type="text" value="<?= $mobil['plat_nomor'] ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Tanggal</th>
                          <th>:</th>
                          <td>
                            <input type="date" value="<?= $mobil['tanggal'] ?>" disabled>
                          </td>
                        </tr>
                        <tr>
                          <th>Jam Masuk</th>
                          <th>:</th>
                          <td>
                            <input type="time" value="<?= $mobil['jam_masuk'] ?>" disabled>
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
                            $timestampMasuk = strtotime($mobil['jam_masuk']);
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
                            <div class="d-flex align-items-center">
                              <div class="bg-primary bg-opacity-10 text-primary border border-primary p-2 me-2  ">
                                <?php
                                $totalBiaya = $mobil['biaya_per_jam'] + (2000 * $selisihJam) - 2000;
                                echo "Rp " . number_format($totalBiaya, 0, ", ", ".");
                                ?>
                                <input type="hidden" name="total_biaya" value="<?= $totalBiaya ?>">
                              </div>
                              <span>Rp <?= $mobil['biaya_per_jam'] . ' + ('
                                          . 'Rp 2.000' . ' * ' . $selisihJam . ' Jam) - 2000' ?></span>
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