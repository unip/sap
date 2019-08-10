<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Beranda</h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
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
                <div class="card w-100">
                    <div class="card-header">
                        <strong class="card-title">Selamat Datang,</strong>
                    </div>
                    <div class="card-body text-center">
                    	<img src="./image/gas.png" class="h-100 w-auto" />
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->