<?php

$username		= isset($_POST['input_username'])?$_POST['input_username']:'';
$password		= isset($_POST['input_password'])?$_POST['input_password']:'';

if(isset($_POST['input_ubah'])) {
	$id			= getID();
	$stru		= "UPDATE `user` set `username`='$username',`password`='$password' WHERE `id_user`='$id'";
	$qu			= $koneksi->query($stru);
	
	if($qu) {
		$error		= "Data berhasil diubah";
	} else {
		$error		= "Gagal mengubah data";
	}
}

if(isset($_POST['input_tambah'])) {
	$stri		= "INSERT INTO `user` (`username`,`password`,`level`,`status`) VALUE ('$username','$password','0','active')";
	$qi			= $koneksi->query($stri);
	
	if($qi) {
		header("Location: ?halaman=admin");
	} else {
		$error		= "Gagal menambah data";
	}
}


$string		= "SELECT * FROM `user` WHERE `level`=0";
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

$aksi		= isset($_GET['aksi'])?$_GET['aksi']:'';
switch($aksi) {
	case 'tambah'	:
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Admin</strong>
                       	<br />
                        <a href="?halaman=admin" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
                    </div>
                    <div class="card-body">
                    	<form method="post">
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="input_username" value="<?php echo $username ?>" />
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="text" class="form-control" name="input_password" value="<?php echo $password ?>" />
							</div>
							
							<div class="form-group">
								<input type="submit" name="input_tambah" class="form-control btn-primary" value="TAMBAH DATA" />
							</div>
						</form>
                     
                    </div>
                </div>
            </div>
            <?php  
		break;
	case 'ubah'		:
		$id			= getID();
		$str1		= "SELECT `username`,`password` FROM `user` WHERE `id_user`='$id' AND `level`='0'";
		$q1			= $koneksi->query($str1);
		
		?>
		<div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Ubah Data Admin</strong>
                       	<br />
                        <a href="?halaman=admin" class="btn btn-primary">Kembali ke halaman sebelumnya</a>
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
								<input type="submit" name="input_ubah" class="form-control btn-primary" value="UBAH DATA" />
							</div>
						</form>
							
						<?php
					} else {
						echo "Data admin tidak ditemukan";
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
                        <strong class="card-title">Kelola Data Admin</strong><br />
                        <a href="?halaman=admin&aksi=tambah" class="btn btn-primary">Tambah Admin</a>
                    </div>
                    <div class="card-body">



                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                	<th>No</th>
                                    <th>Username</th>
                                    <th>Status</th>
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
                                		<td><?php echo $d[4] ?></td>
                                		<td>
                                			<a href="?halaman=admin&aksi=ubah&id=<?php echo $d[0] ?>" class="btn btn-primary">Ubah data</a>
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