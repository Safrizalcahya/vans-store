<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VANS STORE</title>
</head>
<style>
    * {
  box-sizing: border-box;
}
body {	margin:0;}
img {
  width: 100%;
  height: auto;
}
.row:after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
  text-align: center;
}

  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.footer {
  background-color: #000;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}
.head1 {display:flex;
    background-color:white;
	flex-wrap:wrap;
	justify-content:space-between; 
	align-content:space-between; 
	}
.head1 > div {
	flex-wrap:wrap;
	margin:1px;
	padding:5px;
	}
ul li{
    list-style: none;
}
li a {
    text-decoration: none;
    color: #000;
}
[class*="col-"] a {
  text-decoration: none;
  color: #000;
}
.head1{
    position: relative;
    text-align: left;
}
.head1 img {
    position: relative;
    display: flex;
    width: 100%;
    background-repeat: no-repeat;
    background-size: 100% auto;
}
.head1 .middle-left{
    position: absolute;
    top: 40%;
    left: 15px;
}
.head1 .middle-left h1{
    background: white;
}
.middle-left a{
    background: white;
    border: 3px solid green;
    border-radius: 5px;
    padding: 5px 10px;
    transition: 0.3s;
}
.middle-left a:hover{
    background: green;
    color: white;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="row">
        <div class="col-3">
            <img src="img/lt.jpg" style="width:70%;height:auto;">
            <ul>
                <li class="menu-kiri">
                    <a href="about.html">Tentang</a>
					</li>
                <li class="menu-kiri">
                    <a href="find.html">Lokasi Toko</a>
					</li>
                <li class="menu-kiri">
                    <a href="Terms.html">syarat & ketentuan</a>
					</li>
				<li class="menu-kiri">
					<a href="contact.html">kontak</a>
					</li>
				</ul>
        </div>

        <div class="col-9">
            <div class="row">
            <div class="col-5"><a href="index.html">Halaman</a></div>
                    <div class="col-5"><a href="index.php">buku tamu</a></div>
                    <div class="col-5"><a href="#">keranjang</a></div>
                    <div class="col-5"><a href="login.html">masuk</a></div>
            </div>
            <div class="head1">
                <img src="img/ff.jpg" alt="banner">
                <div class="middle-left">
                    <h1>VANS STORE </h1>
                    <a href="#">Buy Now</a>
                </div>
            </div>
<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "datamahasiswa";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$nim        = "";
$nama       = "";
$alamat     = "";
$fakultas   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id         = $_GET['id'];
    $sql1       = "delete from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from mahasiswa where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $nim        = $r1['nim'];
    $nama       = $r1['nama'];
    $alamat     = $r1['alamat'];
    $fakultas   = $r1['fakultas'];

    if ($nim == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $fakultas   = $_POST['fakultas'];

    if ($nim && $nama && $alamat && $fakultas) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update mahasiswa set nim = '$nim',nama='$nama',alamat = '$alamat',fakultas='$fakultas' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into mahasiswa(nim,nama,alamat,fakultas) values ('$nim','$nama','$alamat','$fakultas')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>

    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <section>
        <div class="mx-auto">
            <!-- untuk memasukkan data -->
            <div class="card">
                <div class="card-header">
                    Silahkan Memasukan Data Diri Anda
                </div>
                <div class="card-body">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                        header("refresh:5;url=index.php"); //5 : detik
                    }
                    ?>
                    <?php
                    if ($sukses) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sukses ?>
                        </div>
                    <?php
                        header("refresh:5;url=index.php");
                    }
                    ?>
                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nim" name="nim" value="<?php echo $nim ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="fakultas" class="col-sm-2 col-form-label">Mengetahui Dari</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="fakultas" id="fakultas">
                                    <option value="">- Pilih Option -</option>
                                    <option value="sendiri" <?php if ($fakultas == "sendiri") echo "selected" ?>>sendiri</option>
                                    <option value="keluarga" <?php if ($fakultas == "keluarga") echo "selected" ?>>keluarga</option>
                                    <option value="teman" <?php if ($fakultas == "teman") echo "selected" ?>>teman</option>
                                    <option value="mediasosial" <?php if ($fakultas == "mediasosial") echo "selected" ?>>media sosial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>

            <!-- untuk mengeluarkan data -->
            <div class="card">
                <div class="card-header text-white bg-secondary">
                    Data Mahasiswa
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Mengetahui</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql2   = "select * from mahasiswa order by id desc";
                            $q2     = mysqli_query($koneksi, $sql2);
                            $urut   = 1;
                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id         = $r2['id'];
                                $nim        = $r2['nim'];
                                $nama       = $r2['nama'];
                                $alamat     = $r2['alamat'];
                                $fakultas   = $r2['fakultas'];

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nim ?></td>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $alamat ?></td>
                                    <td scope="row"><?php echo $fakultas ?></td>
                                    <td scope="row">
                                        <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </section>
</body>

</html>