<?php
include "function/function.php";

$kendaraans = mysqli_query($conn, "SELECT * FROM kendaraan");

if (isset($_POST["masuk"])) {
  if (kendaraanMasuk($_POST)) {
    echo "<script>
            alert('Silakan Masuk!');
            document.location.href = '';
        </script>";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Parkircoy</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="public/build/css/style.css">
</head>

<body>
  <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="wrapper">
      <div class="position-absolute start-50 translate-middle text-center" style="top:60px;"> <!-- Judul -->
        <h3>
          <span class="text-primary">PARKIR</span><span class="text-info">COY</span>
        </h3>
        <p class="m-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, libero.</p>
      </div>
      <div class="row">
        <div class="col-md-6"> <!-- Hero Image -->
          <img src="public/img/hero.png" alt="hero_image" class="img-fluid">
        </div>
        <div class="col-md-6"> <!-- Form Data Kendaraan -->
          <div class="border rounded shadow-sm p-4">
            <div class="text-center">
              <h5 class="mb-4">DATA KENDARAAN</h5>
            </div>

            <form action="" method="post"> <!-- FORM PARKIR -->
            <input type="hidden" name="tanggal" value="<?= date('Y-m-d'); ?>">
              <input type="hidden" name="jam_masuk" value="<?= date('H:i:s'); ?>">

              <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select" name="kendaraan_id">
                  <?php foreach ($kendaraans as $kendaraan) : ?>
                    <option value="<?= $kendaraan['id_kendaraan'] ?>"><?= $kendaraan['jenis_kendaraan'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-4">
                <label class="form-label" for="plat_nomor">Plat Nomor</label>
                <input type="text" class="form-control" id="plat_nomor" placeholder="Contoh: B 3172 UDG" name="plat_nomor">
              </div>

              <button type="submit" class="btn btn-primary w-100" name="masuk">Masuk</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>