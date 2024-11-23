<?php
session_start();
include "../config/koneksi.php";

if ($_GET['aksi'] == "masuk") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

    if ($data) {
        $cek = mysqli_num_rows($data);

        if ($cek > 0) {
            $row = mysqli_fetch_assoc($data);

            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['status'] = "Login";
            $_SESSION['level'] = $row['role'];

            // Set timezone dan update terakhir login
            date_default_timezone_set('Asia/Jakarta');
            $id_user = $_SESSION['id_user'];
            $tanggal = date('d-m-Y');
            $jam = date('H:i:s');

            $query = "UPDATE user SET terakhir_login = '$tanggal ($jam)' WHERE id_user = $id_user";
            mysqli_query($koneksi, $query);

            if ($row['role'] == "Admin") {
                header("location: ../admin/dashboard.php");
            } elseif ($row['role'] == "Anggota") {
                header("location: ../user/dashboard.php");
            } else {
                $_SESSION['user_tidak_terdaftar'] = "Maaf, User tidak terdaftar pada database !!";
                header("location: ../masuk");
            }
        } else {
            $_SESSION['gagal_login'] = "Nama Pengguna atau Kata Sandi salah !!";
            header("location: ../masuk");
        }
    } else {
        $_SESSION['gagal_login'] = "Terjadi kesalahan saat mengakses database !!";
        header("location: ../masuk");
    }
}
?>
