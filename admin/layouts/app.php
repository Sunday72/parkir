<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Parkircoy | <?= $title ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="../public/build/css/style.css">
</head>

<body>
  <div class="container-fluid ps-0">
    <div class="row">
      <div class="col-2"> <!-- SIDEBAR -->
        <div class="text-bg-dark d-flex py-4 px-2 flex-column justify-content-between vh-100">
          <div class="sidebar-menu d-flex flex-column">
            <h4 class="text-center mb-5"> <!-- LOGO BRAND -->
              <span class="text-primary">PARKIR</span><span class="text-info">COY</span>
            </h4>
            <a href="index.php" class="nav-link py-2 px-3 <?= $title == 'Dashboard' ? 'active' : '' ?> rounded">Dashboard</a>
            <a href="motor.php" class="nav-link py-2 px-3 <?= $title == 'Motor' ? 'active' : '' ?> rounded">Motor</a>
            <a href="mobil.php" class="nav-link py-2 px-3 <?= $title == 'Mobil' ? 'active' : '' ?> rounded">Mobil</a>
            <a href="pengaturan.php" class="nav-link py-2 px-3 <?= $title == 'Pengaturan' ? 'active' : '' ?> rounded">Pengaturan</a>
          </div>

          <a href="logout.php" class="btn btn-danger">Keluar</a>
        </div>
      </div>
      <div class="col-10 pt-3">
        <h2 class="mb-5"><?= $title ?></h2>