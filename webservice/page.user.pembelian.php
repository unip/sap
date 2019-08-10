<?php


$iduser		= $_SESSION['customer'];
$string		= "SELECT a.*,b.`nama_pemilik`,b.`nama_perusahaan`,b.`no_spbu`,b.`lokasi`,c.`gas_type`,c.`price`,d.`id_lo`,d.no_referensi FROM `pemesanan` AS a LEFT JOIN `customer` AS b ON a.`customer`=b.`id_customer` LEFT JOIN `typebbm` AS c ON a.`typeBBM`=c.`id_typeBBM` LEFT JOIN `loading_order` AS d ON a.`id_pemesanan`=d.`pemesanan` WHERE a.status=1 AND a.customer='$iduser' GROUP BY a.`id_pemesanan` ORDER BY d.`tanggal`";
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
                <h1>Data Pembelian</h1>
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
                                <th>Berkas LO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $url	= "http://".$_SERVER['SERVER_NAME'];
							$requ	= $_SERVER['REQUEST_URI'];
							
							$subs	= explode("?", $requ);
							$subs	= str_replace("index.php", "", $subs);
							
							$ssubs	= $subs[0];
							$impl	= str_replace("webservice", "admin", $ssubs);
							$url	.=$impl."upload/";
                            
                            $i		= 1;
                            foreach((array)$data as $d) {
                            	$namafile	= "LO-{$d[12]}.pdf";
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
                            			<a href="<?php echo $url.$namafile ?>" class="btn btn-primary"style="margin-bottom: 5px;">Unduh berkas LO</a>
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
	
	?>
	
</div>
    </div><!-- .animated -->
</div><!-- .content -->