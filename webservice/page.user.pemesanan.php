<?php

$iduser		= $_SESSION['customer'];
$qty		= isset($_POST['input_qty'])?$_POST['input_qty']:'';
$jenisBBM	= isset($_POST['input_jenis'])?$_POST['input_jenis']:'';


if(isset($_POST['input_simpan'])) {
	$str1		= "INSERT INTO `pemesanan` ( `typeBBM`,`qty`,`customer`,`tanggal`,`status` ) VALUE ( '$jenisBBM','$qty','$iduser',NOW(),0 )";
	$q1			= $koneksi->query($str1);
	if($q1) {
		header("Location: ?halaman=pemesanan&error=".urlencode("Berhasil menambahkan data"));
	} else {
		$error		= "Gagal menambahkan data";
	}	
}

if(isset($_POST['input_ubah'])) {
	$id			= getID();
	$str1		= "UPDATE `pemesanan` SET `typeBBM`='$jenisBBM',`qty`='$qty' WHERE `id_pemesanan`='$id' AND customer='$iduser'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil diubah";
	} else {
		$error	= "Gagal mengubah data";
	}
}

if(isset($_POST['input_delete'])) {
	$id			= getID();
	$str1		= "DELETE FROM `pemesanan` WHERE `id_pemesanan`='$id' AND customer='$iduser'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil menghapus data";
	} else {
		$error	= "Gagal menghapus data";
	}
}

// -------------------------------------------------------------------------------

$string		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price` FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` where a.customer='$iduser' AND a.status=0 ORDER BY `tanggal`";
$q			= $koneksi->query($string);

if ($q && $q->rowCount () > 0) {
	$data 			= $q->fetchAll(PDO::FETCH_NUM);
	
} else {
	$data = array();
}


$strjenis	= "SELECT * FROM `typebbm` ORDER BY `gas_type`";
$qjenis		= $koneksi->query($strjenis);

if($qjenis && $qjenis->rowCount()>0) {
	$dataj	= $qjenis->fetchAll(PDO::FETCH_NUM);
} else {
	$dataj	= array();
}

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

switch(getPageSub()) {
	case 'tambah'	:
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Data Pemesanan</strong>
                    </div>
                    <div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Jenis BBM</label>
								<select name="input_jenis" class="form-control">
									<option value="">Pilih jenis bbm</option>
									<?php
									foreach((array)$dataj as $dj) {
										?><option value="<?php echo $dj[0] ?>"><?php echo $dj[1] ?></option><?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="text" name="input_qty" class="form-control" value="<?php echo $qty ?>" />
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
		$str1		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price` FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` WHERE a.`id_pemesanan`='$id' AND a.status=0 AND customer='$iduser'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Pemesanan</strong>
                        <br />
                        <a href="?halaman=pemesanan" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
                    </div>
                    <div class="card-body">
					<?php
					
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<div class="form-group">
								<label>Jenis BBM</label>
								<select name="input_jenis" class="form-control">
									<option value="">Pilih jenis bbm</option>
									<?php
									foreach((array)$dataj as $dj) {
										$selgas		= ($dj[0]==$d[1])?"selected":'';
										?><option value="<?php echo $dj[0] ?>" <?php echo $selgas ?>><?php echo $dj[1] ?></option><?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="text" name="input_qty" class="form-control" value="<?php echo $d[2] ?>" />
							</div>
							<div class="form-group">
								<input type="submit" name="input_ubah" class="form-control btn-primary" value="UBAH DATA" />
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
	case 'hapus'	:
		$id			= getID();
		$str1		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price` FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` WHERE a.`id_pemesanan`='$id' AND a.status=0";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Hapus Data Pemesanan</strong>
                        <br />
                        <a href="?halaman=pemesanan" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
                    </div>
                    <div class="card-body">
					<?php
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<div class="form-group">
								<label>Yakin untuk menghapus data ID : <?php echo $d[4] ?> ( No.SPBU : <?php echo $d[8] ?> / <?php echo $d[10] ?> / <?php echo $d[2] ?> )</label>
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
                    <strong class="card-title">Kelola Data Pemesanan</strong>
                </div>
                <div class="card-body">



                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            	<th>No</th>
                            	<th>ID</th>
                            	<th>Tanggal</th>
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
                            		<td><?php echo $d[8] ?></td>
                            		<td><?php echo $d[9] ?></td>
                            		<td><?php echo $d[2] ?></td>
                            		<td><?php echo $d[10] ?></td>
                            		<td>
                            			<a href="?halaman=pemesanan&aksi=ubah&id=<?php echo $d[0] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Ubah Data</a>
                            			<a href="?halaman=pemesanan&aksi=hapus&id=<?php echo $d[0] ?>" class="btn btn-primary btn-block"style="margin-bottom: 5px;">Hapus Data</a>
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