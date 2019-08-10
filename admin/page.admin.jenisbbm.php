<?php

$nama			= isset($_POST['input_nama'])?$_POST['input_nama']:'';
$harga			= isset($_POST['input_harga'])?$_POST['input_harga']:'';

if(isset($_POST['input_simpan'])) {
	$str1		= "INSERT INTO `typebbm` ( `gas_type`,`price` ) VALUE ( '$nama','$harga' )";
	$q1			= $koneksi->query($str1);
	if($q1) {
		header("Location: ?halaman=jenisbbm&error=".urlencode("Berhasil menambahkan data"));
	} else {
		$error		= "Gagal menambahkan data";
	}	
}

if(isset($_POST['input_ubah'])) {
	$id			= getID();
	$str1		= "UPDATE `typebbm` SET `gas_type`='$nama',`price`='$harga' WHERE `id_typeBBM`='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil diubah";
	} else {
		$error	= "Gagal mengubah data";
	}
}

if(isset($_POST['input_delete'])) {
	$id			= getID();
	$str1		= "DELETE FROM `typebbm` WHERE `id_typeBBM`='$id'";
	$q1			= $koneksi->query($str1);
	if($q1) {
		$error	= "Berhasil menghapus data";
	} else {
		$error	= "Gagal menghapus data";
	}
}

// -------------------------------------------------------------------------------

$string		= "SELECT * FROM `typebbm` ORDER BY `gas_type`";
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
                <h1>Data Jenis BBM</h1>
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
                        <strong class="card-title">Tambah Data Jenis BBM</strong>
                    </div>
                    <div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Gas Type / Nama BBM</label>
								<input type="text" class="form-control" name="input_nama" value="<?php echo $nama ?>" />
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="text" class="form-control" name="input_harga" value="<?php echo $harga ?>" />
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
		$str1		= "SELECT * FROM `typebbm` WHERE `id_typeBBM`='$id'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Jenis BBM</strong>
                    </div>
                    <div class="card-body">
					<?php
					
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<div class="form-group">
								<label>Gas Type / Nama BBM</label>
								<input type="text" class="form-control" name="input_nama" value="<?php echo $d[1] ?>" />
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="text" class="form-control" name="input_harga" value="<?php echo $d[2] ?>" />
							</div>
							<div class="form-group">
								<input type="submit" name="input_ubah" class="form-control btn-primary" value="UBAH DATA" />
							</div>
						</form>
						<?php
					} else {
						echo "Data Jenis BBM tidak ditemukan";
					}
						
					?>
					</div>
                </div>
            </div>
		<?php
		break;
	case 'hapus'	:
		$id			= getID();
		$str1		= "SELECT * FROM `typebbm` WHERE `id_typeBBM`='$id'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Hapus Data Jenis BBM</strong>
                    </div>
                    <div class="card-body">
					<?php
					if($q1 && $q1->rowCount() > 0) {
						$data	= $q1->fetchAll(PDO::FETCH_NUM);
						$d		= $data[0];
						?>
						<form method="post">
							<div class="form-group">
								<label>Yakin untuk menghapus data ID : <?php echo $d[1] ?> ( Harga : <?php echo $d[2] ?>)</label>
							</div>
							<div class="form-group">
								<input type="submit" class="form-control btn-primary" name="input_delete" value="YA" />
							</div>
							<div class="form-group">
								<a href="?halaman=jenisbbm" class="form-control btn-primary text-center">Kembali</a>
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
                    <strong class="card-title">Kelola Data Jenis BBM</strong>
                </div>
                <div class="card-body">



                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            	<th>No</th>
                                <th>Nama Jenis</th>
                                <th>Harga</th>
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
                            		<td><?php echo $d[1] ?></td>
                            		<td><?php echo $d[2] ?></td>
                            		
                            		<td>
                            			<a href="?halaman=jenisbbm&aksi=ubah&id=<?php echo $d[0] ?>" class="btn btn-primary"style="margin-bottom: 5px;">Ubah Data</a>
                            			<a href="?halaman=jenisbbm&aksi=hapus&id=<?php echo $d[0] ?>" class="btn btn-primary"style="margin-bottom: 5px;">Hapus Data</a>
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
	