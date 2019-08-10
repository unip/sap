<?php

$username		= isset($_POST['input_username'])?$_POST['input_username']:'';
$password		= isset($_POST['input_password'])?$_POST['input_password']:'';
$nama			= isset($_POST['input_nama'])?$_POST['input_nama']:'';
$perusahaan		= isset($_POST['input_perusahaan'])?$_POST['input_perusahaan']:'';
$nospbu			= isset($_POST['input_nospbu'])?$_POST['input_nospbu']:'';
$alamat			= isset($_POST['input_alamat'])?$_POST['input_alamat']:'';
$email			= isset($_POST['input_email'])?$_POST['input_email']:'';
$phone			= isset($_POST['input_phone'])?$_POST['input_phone']:'';
$lokasi			= isset($_POST['input_lokasi'])?$_POST['input_lokasi']:'';
$kapasitas		= isset($_POST['input_kapasitas'])?$_POST['input_kapasitas']:'';
$jenisBBM		= isset($_POST['input_jenis'])?$_POST['input_jenis']:'';



if(isset($_POST['input_simpan'])) {
	if($username == "") {
		$notif = "User Name harus diinputkan";
	} else if($password == "") { 
		$notif = "Password harus diinputkan"; 
	} else if($nama == "") {
		$notif = "Nama harus diinputkan";
	} else if($perusahaan == "") {
		$notif = "User Name harus diinputkan";
	} else if($nospbu == "") {
		$notif = "Nomor SPBU harus diinputkan";
	} else if($alamat == "") {
		$notif = "User Name harus diinputkan";
	} else if($email == "") {
		$notif = "Mail harus diinputkan";
	} else if($phone == "") {
		$notif = "Phone harus diinputkan";
	} else if($lokasi == "") {
		$notif = "Lokasi harus diinputkan";
	} else if($kapasitas == "") {
		$notif = "Kapasitas harus diinputkan";
	} else if($jenisBBM == "") {
		$notif = "Jenis BBM harus diinputkan";
	} else {
		$str1		= "INSERT INTO `user` ( `username`,`password`,`level`,`status` ) VALUE ( '$username','$password',1,'active' )";
		$q1			= $koneksi->query($str1);
		if($q1) {
		$str2	= "SELECT `id_user` FROM `user` WHERE `username`='$username' AND `password`='$password'";
		$q2		= $koneksi->query($str2);
		if($q2 && $q2->rowCount () > 0) {
			$load	= $q2->fetchAll(PDO::FETCH_NUM);
			$iduser	= $load[0][0];
			
			$str3	= "INSERT `customer` ( `id_user`,`nama_pemilik`,`nama_perusahaan`,`no_spbu`,`alamat`,`email`,`phone`,`lokasi`,`kapasitas`,`jenis_tersedia` ) VALUE ( '$iduser','$nama','$perusahaan','$nospbu','$alamat','$email','$phone','$lokasi','$kapasitas','$jenisBBM' )";
			$q3		= $koneksi->query($str3);
			
			if($q3) {
				header("Location: ?halaman=customer");
			} else {
				$error	= "Gagal menambahkan data customer";
			}			
		} else {
			
		}
		} else {
		$error		= "Gagal menambakan username, coba lagi";
		}
	}
	
	if (isset($notif)) {
      ?>
      <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          <center><?php echo $notif ?></center>
      </div>
      <?php 
	  }

      
}
 


if(isset($_POST['input_ubah'])) {
	$id			= getID();
	$str1		= "UPDATE `customer` SET `nama_pemilik`='$nama',`nama_perusahaan`='$perusahaan',`no_spbu`='$nospbu',`alamat`='$alamat',`email`='$email',`phone`='$phone',`lokasi`='$lokasi',`kapasitas`='$kapasitas',`jenis_tersedia`='$jenisBBM' WHERE `id_customer`='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil diubah";
	} else {
		$error	= "Gagal mengubah data";
	}
}

if(isset($_POST['input_ubah2'])) {
	$id			= getID();
	$str1		= "UPDATE `user` SET `username`='$username', `password`='$password' WHERE `id_user`='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil diubah";
	} else {
		$error	= "Gagal mengubah data";
	}
}

if(isset($_POST['input_delete'])) {
	$id			= getID();
	$str1		= "DELETE FROM `customer` WHERE	`id_customer` ='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$username	= isset($_POST['username'])?$_POST['username']:'';
		$password	= isset($_POST['password'])?$_POST['password']:'';
		$str2	= "DELETE FROM `user` WHERE `username`='$username' AND `password`='$password'";
		$q2		= $koneksi->query($str2);
		$error	= "Berhasil menghapus data";
	} else {
		$error	= "Gagal menghapus data";
	}
}






// -------------------------------------------------------------------------------

$string		= "SELECT a.*,b.`username`,b.`password` FROM `customer` AS a LEFT JOIN USER AS b ON a.`id_user`=b.`id_user` ORDER BY a.nama_pemilik";
$q			= $koneksi->query($string);

if ($q && $q->rowCount () > 0) {
	$data 			= $q->fetchAll(PDO::FETCH_NUM);
	
} else {
	$data = array();
}

?>


<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Data Admin</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
<?php

	if(isset($error)) {
		?>
		<div class="col-md-12">
		<div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
        </div>
		<?php
	}

switch(getPageSub()) {
	case 'tambah'	:
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Data Customer</strong>
                    </div>
                    <div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="input_username" value="<?php echo $username ?>" />
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="input_password" value="<?php echo $password ?>" />
							</div>
							<div class="form-group">
								<label>Nama Pemilik</label>
								<input type="text" class="form-control" name="input_nama" value="<?php echo $nama ?>" />
							</div>
							<div class="form-group">
								<label>Nama Perusahaan</label>
								<input type="text" class="form-control" name="input_perusahaan" value="<?php echo $perusahaan ?>" />
							</div>
							<div class="form-group">
								<label>No. SPBU</label>
								<input type="text" class="form-control" name="input_nospbu" value="<?php echo $nospbu ?>" />
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" name="input_alamat"><?php echo $alamat ?></textarea>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" name="input_email" value="<?php echo $email ?>" />
							</div>
							<div class="form-group">
								<label>No. Phone</label>
								<input type="text" class="form-control" name="input_phone" value="<?php echo $phone ?>" />
							</div>
							<div class="form-group">
								<label>Lokasi</label>
								<input type="text" class="form-control" name="input_lokasi" value="<?php echo $lokasi ?>" />
							</div>
							<div class="form-group">
								<label>Kapasitas</label>
								<input type="text" class="form-control" name="input_kapasitas" value="<?php echo $kapasitas ?>" />
							</div>
							<div class="form-group">
								<label>Jenis BBM</label>
								<input type="text" class="form-control" name="input_jenis" value="<?php echo $jenisBBM ?>" />
								<p class="text-help"></p>
							</div>
							<div class="form-group">
								<input type="submit" name="input_simpan" class="form-control btn-primary" value="SIMPAN DATA" />
							</div>
						</form>
					</div>
                </div>
            </div>
		<?php
		break;
	case 'ubah'		:
		$id			= getID();
		$str1		= "SELECT a.*,b.`username`,b.`password` FROM `customer` AS a LEFT JOIN USER AS b ON a.`id_user`=b.`id_user` WHERE a.`id_customer`='$id'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Customer</strong><br />
                        <a href="?halaman=customer" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
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
								<input type="text" disabled="disabled" class="form-control" name="input_username" value="<?php echo $d[11] ?>" />
							</div>
							<div class="form-group">
								<label>Nama Pemilik</label>
								<input type="text" class="form-control" name="input_nama" value="<?php echo $d[2] ?>" />
							</div>
							<div class="form-group">
								<label>Nama Perusahaan</label>
								<input type="text" class="form-control" name="input_perusahaan" value="<?php echo $d[3] ?>" />
							</div>
							<div class="form-group">
								<label>No. SPBU</label>
								<input type="text" class="form-control" name="input_nospbu" value="<?php echo $d[4] ?>" />
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" name="input_alamat"><?php echo $d[5] ?></textarea>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" class="form-control" name="input_email" value="<?php echo $d[6] ?>" />
							</div>
							<div class="form-group">
								<label>No. Phone</label>
								<input type="text" class="form-control" name="input_phone" value="<?php echo $d[7] ?>" />
							</div>
							<div class="form-group">
								<label>Lokasi</label>
								<input type="text" class="form-control" name="input_lokasi" value="<?php echo $d[8] ?>" />
							</div>
							<div class="form-group">
								<label>Kapasitas</label>
								<input type="text" class="form-control" name="input_kapasitas" value="<?php echo $d[9] ?>" />
							</div>
							<div class="form-group">
								<label>Jenis BBM</label>
								<input type="text" class="form-control" name="input_jenis" value="<?php echo $d[10] ?>" />
								<p class="text-help">Jika Jenis lebih dari satu pisahkan dengan koma</p>
							</div>
							<div class="form-group">
								<input type="submit" name="input_ubah" class="form-control btn-primary" value="SIMPAN DATA" />
							</div>
						</form>
						<?php
					} else {
						echo "Data customer tidak ditemukan";
					}
						
					?>
					</div>
                </div>
            </div>
		<?php
		break;
	case 'ubahakun'	:
		$id			= getID();
		$str1		= "SELECT `username`,`password` FROM `user` WHERE `id_user`='$id' AND `level`='1'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Akun Customer</strong>
                       	<br />
                        <a href="?halaman=customer" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
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
								<input type="text" class="form-control" name="input_username" value="<?php echo $d[0] ?>" />
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="input_password" value="<?php echo $d[1] ?>" />
							</div>
							
							<div class="form-group">
								<input type="submit" name="input_ubah2" class="form-control btn-primary btn-block" value="UBAH DATA" />
							</div>
						</form>
							
						<?php
					} else {
						echo "Data customer tidak ditemukan";
					}
						
					?>
					</div>
                </div>
            </div>
		<?php
		break;
	case 'hapus'	:
		$id			= getID();
		$str1		= "SELECT a.*,b.`username`,b.`password` FROM `customer` AS a LEFT JOIN USER AS b ON a.`id_user`=b.`id_user` WHERE a.`id_customer`='$id'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Hapus Data Customer</strong>
                    </div>
                    <div class="card-body">
					<?php
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<input type="hidden" name="username" value="<?php echo $d[11] ?>" />
							<input type="hidden" name="password" value="<?php echo $d[12] ?>" />	
							<div class="form-group">
								<label>Yakin untuk menghapus data ID : <?php echo $d[2] ?> ( username : <?php echo $d[11] ?>)</label>
							</div>
							<div class="form-group">
								<input type="submit" class="form-control btn-primary" name="input_delete" value="YA" />
							</div>
							<div class="form-group">
								<a href="?halaman=customer" class="form-control btn-primary text-center">Kembali</a>
							</div>
						</form>
						<?php
					} else {
						echo "Data tidak ditemukan";
					}
					?>
					</div>
                </div>
            </div>
		<?php	
		break;
	default :
		?>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Kelola Data Customer</strong>
                    </div>
                    <div class="card-body">


	                    <div class="table-responsive">
	                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
	                            <thead>
	                                <tr>
	                                	<th>No</th>
	                                    <th>Username</th>
	                                    <th>Password</th>
	                                    <th>Nama Pemilik</th>
	                                    <th>Nama Perusahaan</th>
	                                    <th>No SPBU</th>
	                                    <th>Alamat</th>
	                                    <th>Email</th>
	                                    <th>No Phone</th>
	                                    <th>Lokasi SPBU</th>
	                                    <th>Kapasitas Tangki</th>
	                                    <th>Jenis BBM</th>
	                                    <th>Aksi</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php
	                                $i		= 1;
	                                foreach((array)$data as $d) {
	                                	?>
	                                	<tr>
	                                		<td><?php echo $i++ ?></td>
	                                		<td><?php echo $d[11] ?></td>
	                                		<td><?php echo $d[12] ?></td>
	                                		<td><?php echo $d[2] ?></td>
	                                		<td><?php echo $d[3] ?></td>
	                                		<td><?php echo $d[4] ?></td>
	                                		<td><?php echo $d[5] ?></td>
	                                		<td><?php echo $d[6] ?></td>
	                                		<td><?php echo $d[7] ?></td>
	                                		<td><?php echo $d[8] ?></td>
	                                		<td><?php echo $d[9] ?></td>
	                                		<td><?php echo $d[10] ?></td>
	                                		<td>
	                                			<a href="?halaman=customer&aksi=ubah&id=<?php echo $d[0] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Ubah Data</a>
	                                			<a href="?halaman=customer&aksi=ubahakun&id=<?php echo $d[1] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Ubah Password</a>
	                                			<a href="?halaman=customer&aksi=hapus&id=<?php echo $d[0] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Hapus Data</a>
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
            </div>
		<?php
}
?>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->