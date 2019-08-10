<?php

$iduser		= $_SESSION['customer'];
$idlogin	= $_SESSION['id'];

$password	= isset($_POST['input_password'])?$_POST['input_password']:'';


if(isset($_POST['input_ubah2'])) {
	$id			= getID();
	$str1		= "UPDATE `user` SET `password`='$password' WHERE `id_user`='$idlogin'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil diubah";
	} else {
		$error	= "Gagal mengubah data";
	}
}


$str1		= "SELECT a.*,b.`username`,b.`password` FROM `customer` AS a LEFT JOIN USER AS b ON a.`id_user`=b.`id_user` WHERE a.`id_customer`='$iduser'";
$q1			= $koneksi->query($str1);

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Data Pemesanan</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
<?php

	if(isset($error) || isset($_GET['error'])) {
		if(isset($_GET['error'])) {
			$error		= $_GET['error'];
		}
		?>
		<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
        </div>
		<?php
	}

	?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Profil</strong>
                    </div>
                    <div class="card-body">
					<?php
					
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						
						<form method="post">
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="input_username" value="<?php echo $d[11] ?>" disabled />
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="input_password" value="<?php echo $d[12] ?>" />
							</div>
							
							<div class="form-group">
								<input type="submit" name="input_ubah2" class="form-control btn-primary" value="UBAH PASSWORD" />
							</div>
						</form>
						<hr />
						<h4>Detail Profil</h4>
						<table width="98%">
							<tr>
								<td width="25%">Nama Pemilik</td>
								<td>: <?php echo $d[2] ?></td>
							</tr>
							<tr>
								<td>Nama Perusahaan</td>
								<td>: <?php echo $d[3] ?></td>
							</tr>
							<tr>
								<td>No. SPBU</td>
								<td>: <?php echo $d[4] ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td>: <?php echo $d[5] ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>: <?php echo $d[6] ?></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td>: <?php echo $d[7] ?></td>
							</tr>
							<tr>
								<td>Lokasi</td>
								<td>: <?php echo $d[8] ?></td>
							</tr>
							<tr>
								<td>Kapasitas Tangki</td>
								<td>: <?php echo $d[9] ?></td>
							</tr>
							<tr>
								<td>Jenis BBM Tersedia</td>
								<td>: <?php echo $d[10] ?></td>
							</tr>
						</table>
					
		<?php
} else {
	echo "Data tidak ditemukan";
}
?>
					</div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->