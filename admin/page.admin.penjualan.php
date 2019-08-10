<?php

$pemesanan		= isset($_POST['input_pemesanan'])?$_POST['input_pemesanan']:'';
$referensi		= isset($_POST['input_referensi'])?$_POST['input_referensi']:'';

if(isset($_POST['input_simpan'])) {
	if($pemesanan>0) {
		$str1		= "INSERT INTO `loading_order` ( `no_referensi`,`pemesanan`,`tanggal`,`berkas` ) VALUE ( '','$pemesanan',NOW(),'' )"; echo $str1;
		$q1			= $koneksi->query($str1);
		if($q1) {
			$str2	= "SELECT * FROM `loading_order` WHERE `pemesanan`='$pemesanan'";echo $str2;
			$q2		= $koneksi->query($str2);
			$str3	= "UPDATE `pemesanan` SET `status`='1' WHERE `id_pemesanan`='$pemesanan'";
			$q3		= $koneksi->query($str3);
			
			if($q2 && $q2->rowCount () > 0) {
				$d2 			= $q2->fetchAll(PDO::FETCH_NUM);
				header("Location: ?halaman=penjualan&aksi=setlo&id=".$d2[0][0]);
			} else {
				$error		 = "Data gagal ditambahkan";
			}
		} else {
			$error		= "Gagal menambahkan data";
		}
	} else {
		$error		= "Pilih terlebih dahulu pemesanan yang akan diproses";
	}
}

if(isset($_POST['input_unggah'])) {
	$id			= getID();
	$namafile	= "LO-$id.pdf";
	$upload		= uploadPDF($_FILES['input_berkas'],$namafile);
	
	if($upload==true) {
		$str1		= "UPDATE `loading_order` SET `no_referensi`='$referensi',`berkas`='$namafile' WHERE `id_lo`='$id'";
		$q1			= $koneksi->query($str1);
		
		if($q1) {
			$error	= "Berhasil memperbaharui data";
		} else {
			$error	= "Gagal menyimpan database";
		}
	} else {
		$error		= "Berkas gagal diunggah";
	}
}

if(isset($_POST['input_delete'])) {
	$id			= getID();
	$str1		= "DELETE FROM `loading_order` WHERE `id_lo`='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$str2	= "UPDATE `pemesanan` SET `status`='0' WHERE `id_pemesanan`='$pemesanan'";
		$q2		= $koneksi->query($str2);
		$error	= "Berhasil membatalkan data LO";
	} else {
		$error	= "Gagal membatalkan data LO";
	}
}

$string		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price`,d.`id_lo`,d.no_referensi FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` LEFT JOIN `loading_order` AS d ON a.`id_pemesanan`=d.`pemesanan` WHERE a.status=1 GROUP BY a.`id_pemesanan` ORDER BY d.`tanggal`";
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
                <h1>Data Penjualan</h1>
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

switch(getPageSub()) {
	case 'tambah'	:
		$str1		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price` FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` where a.status=0 ORDER BY `tanggal`";
		$q1			= $koneksi->query($str1);
		if($q1 && $q1->rowCount() > 0) {
			$data	= $q1->fetchAll(PDO::FETCH_NUM);
		} else {
			$data	= array();
		}
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Loading Order</strong>
                    </div>
                    <div class="card-body">
						<form method="post">
							<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
		                        <thead>
		                            <tr>
		                            	<th>No</th>
		                            	<th>ID</th>
		                            	<th>Tanggal</th>
		                                <th>Nama Pemilik</th>
		                                <th>Nama Perusahaan</th>
		                                <th>No SPBU</th>
		                                <th>Lokasi SPBU</th>
		                                <th>QTY</th>
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
		                            		<td><?php echo $d[0] ?></td>
		                            		<td><?php echo $d[4] ?></td>
		                            		<td><?php echo $d[6] ?></td>
		                            		<td><?php echo $d[7] ?></td>
		                            		<td><?php echo $d[8] ?></td>
		                            		<td><?php echo $d[9] ?></td>
		                            		<td><?php echo $d[2] ?></td>
		                            		<td><?php echo $d[10] ?></td>
		                            		<td><input type="radio" name="input_pemesanan" class="form-control" value="<?php echo $d[0] ?>" /></td>
		                            	</tr>
		                            	
		                            	<?php
		                            }
		                            
		                            ?>
		                        </tbody>
		                    </table>
							<div class="form-group">
								<input type="submit" name="input_simpan" class="form-control btn-primary" value="LANJUT KE UNGGAH DATA" />
							</div>
						</form>
					</div>
                </div>
            </div>
		<?php
		
		break;
	case 'setlo'	:
		$id		= getID();
		$str1		= "SELECT * FROM `loading_order` WHERE `id_lo`='$id'";
		$q1			= $koneksi->query($str1);
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Unggah Berkas Loading Order</strong>
                        <br />
                        <a href="?halaman=penjualan" class="btn btn-primary">Kembali ke halaman loading order</a>
                    </div>
                    <div class="card-body">
                    <?php
					
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						$namafile	= "LO-$id.pdf";
						$file		= checkUploadPdf($namafile);
						
					?>
						<form method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label>No Referensi</label>
								<input type="text" class="form-control" name="input_referensi" value="<?php echo $d[1] ?>" />
								
							</div>
							<div class="form-group">
								<label>Berkas LO</label>
								<input type="file" class="form-control" name="input_berkas" />
								<?php
								if($file==true) { ?>
									<p class="text-help">Berkas telah terunggah : <a href="./upload/<?php echo $namafile ?>">Unduh</a></p>
								<?php } ?>
							</div>
							
							<div class="form-group">
								<input type="submit" name="input_unggah" class="form-control btn-primary" value="UNGGAH DATA" />
							</div>
						</form>
						<?php
					} else {
						echo "Data LO tidak ditemukan";
					}
						
					?>
					</div>
                </div>
            </div>
		<?php
		
		break;
	case 'cancello'	:
		$id			= getID();
		$str1		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price`,d.`id_lo` FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` LEFT JOIN `loading_order` AS d ON a.`id_pemesanan`=d.`pemesanan` WHERE a.status=1 AND d.id_lo='$id' GROUP BY a.`id_pemesanan` ORDER BY d.`tanggal`";
		$q1			= $koneksi->query($str1);
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Batalkan Loading Order</strong>
                        <br />
                        <a href="?halaman=penjualan" class="btn btn-primary">Kembali ke halaman loading order</a>
                    </div>
                    <div class="card-body">
                    <?php
					
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<input type="hidden" name="input_pemesanan" value="<?php echo $d[0] ?>" />
							<div class="form-group">
								<label>Yakin untuk membatalkan data Load ID : <?php echo $d[0] ?> ( Pemilik : <?php echo $d[6] ?> ) ( No.SPBU : <?php echo $d[8] ?> / <?php echo $d[10] ?> / <?php echo $d[2] ?> )</label>
							</div>
							<div class="form-group">
								<input type="submit" class="form-control btn-primary" name="input_delete" value="YA" />
							</div>
							<div class="form-group">
								<a href="?halaman=pemesanan" class="form-control btn-primary text-center">Kembali</a>
							</div>
						</form>
						<?php
					} else {
						echo "Data LO tidak ditemukan";
					}
						
					?>
					</div>
                </div>
            </div>
		<?php				
		break;
	default	:
		?>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Kelola Data Penjualan</strong>
                </div>
                <div class="card-body">



                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>ID</th>
                            	<th>No Referensi</th>
                            	<th>Tanggal</th>
                                <th>Nama Pemilik</th>
                                <th>Nama Perusahaan</th>
                                <th>No SPBU</th>
                                <th>Lokasi SPBU</th>
                                <th>QTY</th>
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
                            		<td><?php echo $d[0] ?></td>
                            		<td><?php echo $d[13] ?></td>
                            		<td><?php echo $d[4] ?></td>
                            		<td><?php echo $d[6] ?></td>
                            		<td><?php echo $d[7] ?></td>
                            		<td><?php echo $d[8] ?></td>
                            		<td><?php echo $d[9] ?></td>
                            		<td><?php echo $d[2] ?></td>
                            		<td><?php echo $d[10] ?></td>
                            		<td>
                            			<a href="?halaman=penjualan&aksi=setlo&id=<?php echo $d[12] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Ubah LO</a>
                            			<a href="?halaman=penjualan&aksi=cancello&id=<?php echo $d[12] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Batalkan LO</a>
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
	<?php
		
}
?>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->