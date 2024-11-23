<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "tambah") {
    $kode_petugas = $_POST['kodePetugas'];
    $nis = $_POST['nis'];
    $fullname = $_POST['namaLengkap'];
    $username = addslashes(strtolower($_POST['username']));
    $password = $_POST['password'];
    $kls = $_POST['kelas'];
    $jrs = $_POST['jurusan'];
    $kelas = $kls . $jrs;
    $alamat = $_POST['alamat'];
    $verif = "Tidak";
    $role = "Petugas";
    $join_date = date('d-m-Y');

    $sql = "INSERT INTO user(kode_user,nis,fullname,username,password,kelas,alamat,verif,role,join_date)
        VALUES('" . $kode_petugas . "','" . $nis . "','" . $fullname . "','" . $username . "','" . $password . "','" . $kelas . "','" . $alamat . "','" . $verif . "','" . $role . "','" . $join_date . "')";
    $sql .= mysqli_query($koneksi, $sql);

    if ($sql) {
        $_SESSION['berhasil'] = "Petugas berhasil ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Petugas gagal ditambahkan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else if ($_GET['aksi'] == "edit") {

    $id_user = $_POST['idUser'];
    $nis = htmlspecialchars($_POST['nis']);
    $nama_lengkap = htmlspecialchars(addslashes($_POST['namaLengkap']));
    $username = htmlspecialchars(strtolower($_POST['uSername']));
    $password = htmlspecialchars(trim($_POST['pAssword']));
    $kelas = htmlspecialchars(addslashes($_POST['kElas']));
    $alamat = htmlspecialchars(addslashes($_POST['aLamat']));

    $query = "UPDATE user SET nis = '$nis', fullname = '$nama_lengkap', username = '$username', 
          password = '$password', kelas = '$kelas', alamat = '$alamat'";

    $query .= "WHERE id_user = '$id_user'";

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        $_SESSION['berhasil'] = "Data petugas berhasil dirubah !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data Petugas gagal dirubah !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} else if ($_GET['aksi'] == "hapus") {
    $id_user = $_GET['id'];

    $sql = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");

    if ($sql) {
        $_SESSION['berhasil'] = "Petugas berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Petugas gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
}
