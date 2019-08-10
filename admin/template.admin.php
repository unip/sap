<?php
$koneksi		= koneksi();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HALAMAN MYSAP ADMINISTRATOR</title>
    <link href="image/logo.png" rel="shortcut icon"/>
    <meta name="description" content="HALAMAN ADMIN MYSAP">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./index.php"><img src="image/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./index.php"><img src="image/logo.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="./index.php"> <i class="menu-icon fa fa-dashboard"></i>Beranda</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i> Customer</a>
                        <ul class="sub-menu children dropdown-menu">
                        	<li><i class="fa fa-plus"></i><a href="?halaman=customer&aksi=tambah">Tambah Data Customer</a></li>
                            <li><i class="fa fa-user"></i><a href="?halaman=customer">Data Customer</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Jenis BBM</a>
                        <ul class="sub-menu children dropdown-menu">
                        	<li><i class="fa fa-table"></i><a href="?halaman=jenisbbm&aksi=tambah">Tambah Data Jenis BBM</a></li>
                            <li><i class="fa fa-table"></i><a href="?halaman=jenisbbm">Jenis BBM</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Pemesanan</a>
                        <ul class="sub-menu children dropdown-menu">
                        	<li><i class="fa fa-table"></i><a href="?halaman=pemesanan&aksi=tambah">Tambah Data Pemesanan</a></li>
                            <li><i class="fa fa-table"></i><a href="?halaman=pemesanan">Daftar Pemesanan</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>History Penjualan</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="?halaman=penjualan&aksi=tambah">Tambah Data Loading Order</a></li>
                            <li><i class="fa fa-table"></i><a href="?halaman=penjualan">Data Penjualan</a></li>
                        </ul>
                    </li>
					<li class="menu-item">
                        <a href="?halaman=admin" > <i class="menu-icon fa fa-user"></i>Kelola Admin</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2019
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            
        </nav>
        
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu row">
                <div class="col-12 col-md-6">
                	<span>Aplikasi MySAP</span>
				    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-compress" style="transform: rotate(45deg);"></i></a>
                </div>

                <div class="col-12 col-md-6 d-flex justify-content-end align-items-center">
                    <div>
                        <i class="fa fa-calendar fa-fw " ></i> 
                        <strong><?php echo date("l, d F Y | H:i "); ?></strong>
                    </div>
                    <div class="user-area dropdown ml-4">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="image/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="?halaman=logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

	   <!-- CONTENT PAGE -->
        <?php

	   if(file_exists("./page.admin.".getPage().".php")) {
		   include_once "./page.admin.".getPage().".php";
	   } else {
		   ?>
		   <div class="breadcrumbs">
			   <div class="page-header"><div class="col-md-12"><h1>Halaman Tidak Ditemukan</h1></div></div>
		   </div>
		   <?php
	   }

	   ?>
	   <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script>
    	var $=jQuery.noConflict();
    	$(document).ready(function() {
	    	$('#bootstrap-data-table').DataTable({
		        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
		    });
		
		    $('#bootstrap-data-table-export').DataTable({
		        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
		        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
		    });
		
			$('#row-select').DataTable( {
		        initComplete: function () {
						this.api().columns().every( function () {
							var column = this;
							var select = $('<select class="form-control"><option value=""></option></select>')
								.appendTo( $(column.footer()).empty() )
								.on( 'change', function () {
									var val = $.fn.dataTable.util.escapeRegex(
										$(this).val()
									);
		
									column
										.search( val ? '^'+val+'$' : '', true, false )
										.draw();
								} );
		
							column.data().unique().sort().each( function ( d, j ) {
								select.append( '<option value="'+d+'">'+d+'</option>' )
							});
					});
				}
			});
	    })
    </script>


</body>

</html>
