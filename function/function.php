<?php

$conn = mysqli_connect("localhost", "root", "", "latihan_parkir");

function kendaraanMasuk($data)
{
  global $conn;

  $platNomor = $data["plat_nomor"];
  $kendaraan = $data["kendaraan_id"];
  $jamMasuk = $data["jam_masuk"];
  $tanggal = $data["tanggal"];

  mysqli_query($conn, "INSERT INTO parkir VALUES('', '$platNomor', '$kendaraan', '$tanggal', '$jamMasuk', '', 'process', '')");

  return mysqli_affected_rows($conn);
}

function bayarParkir($data)
{
  global $conn;

  $id = $data["id_parkir"];
  $tanggal = $data["tanggal"];
  $jam_keluar = $data["jam_keluar"];
  $totalBiaya = $data["total_biaya"];

  $queryUpdate = mysqli_query($conn, "UPDATE parkir SET 
                                      tanggal='$tanggal', 
                                      jam_keluar='$jam_keluar', 
                                      total_biaya='$totalBiaya',
                                      status='done'
                                      WHERE id_parkir = '$id'");
  return mysqli_affected_rows($conn);
}

function cariMotor($keyword)
{
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 1 AND plat_nomor LIKE '%$keyword%' ORDER BY tanggal DESC, jam_masuk DESC");

  return $query;
}

function cariMobil($keyword)
{
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM parkir JOIN kendaraan ON kendaraan.id_kendaraan = parkir.kendaraan_id WHERE kendaraan_id = 2 AND plat_nomor LIKE '%$keyword%' ORDER BY tanggal DESC, jam_masuk DESC");

  return $query;
}
