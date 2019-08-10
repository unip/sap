<?php

function getPage() {
	return isset($_GET['halaman'])?$_GET['halaman']:'home';
}

function getPageSub() {
	return isset($_GET['aksi'])?$_GET['aksi']:'';
}

function getDo() {
	return isset($_GET['do'])?$_GET['do']:'';
}

function getID() {
	return isset($_GET['id'])?$_GET['id']:0;
}

function uploadImage($file,$name='') {
	$type		= $file['type'];
	$dir		= dirname(__FILE__)."/upload/";
	if($name=='') {
		$dir	.= convertName($file['name']);
	} else {
		$dir 	.= convertName($name);
	}
	if($file['error']>0) {
		return "Error Upload Foto";
	} else if($type=="image/png" || $type=="image/gif" || $type=="image/bmp" || $type=="image/x-windows-bmp" ||
				$type=="image/jpeg" || $type=="image/pjpeg" ) {
		if(!move_uploaded_file($file['tmp_name'],$dir)) {
			return "Gagal menyimpan foto";
		} else {
			return true;
		}
	} else {
		return "Periksa kembali file anda";
	}
}

function uploadVideo($file,$name='') {
	$type		= $file['type'];
	$dir		= dirname(__FILE__)."/upload/";
	if($name=='') {
		$dir	.= convertName($file['name']);
	} else {
		$dir 	.= convertName($name);
	}
	if($file['error']>0) {
		return "Error Upload Video".$file['error'];
	} else if($type=="video/x-flv" || $type=="video/mp4" || $type=="application/x-mpegURL" || $type=="video/MP2T" || $type=="video/3gpp" ||
						$type=="video/quicktime" || $type=="video/x-msvideo" || $type=="video/x-ms-wmv" ) {
		if(!move_uploaded_file($file['tmp_name'],$dir)) {
			return "Gagal menyimpan video";
		} else {
			return "true";
		}
	} else {
		return "Periksa kembali video anda";
	}
}

function uploadXls($file,$name="") {


}

function uploadPDF($file,$name="") {
	$type		= $file['type'];
	$dir		= dirname(__FILE__)."/upload/";
	if($name=='') {
		$dir	.= convertName($file['name']);
	} else {
		$dir 	.= convertName($name);
	}
	if($file['error']>0) {
		return "Error Upload Berkas".$file['error'];
	} else if($type=="application/pdf" || $type=="application/x-pdf" ) {
		if(!move_uploaded_file($file['tmp_name'],$dir)) {
			return "Gagal menyimpan berkas";
		} else {
			return "true";
		}
	} else {
		return "Periksa kembali berkas anda";
	}
}

function checkUploadPdf($file) {
	$dir		= "./upload/";
	if(file_exists($dir.$file)) {
		return true;
	} else {
		return false;
	}
}

function convertName($name) {
	if(!empty($name)) {
		$ex	= explode(".",$name);
		$eks	= count($ex)-1;
		$ret	= '';
		if(count($ex)>2) {
			for($i=0;$i<count($ex);$i++) {
				if($i==0) {
					$ret	= $ex[$i];
				} else {
					$ret .= ".".$ex[$i];
				}
			}
		} else {
			$ret	= $ex[0];
		}

		return urlencode($ret).".".$ex[$eks];
	} else {
		return '';
	}
}

function getURL() {
    $act_url  = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) ? 'https' : 'http';
    $act_url .= '://' . $_SERVER['SERVER_NAME'];
    $act_url .= in_array( $_SERVER['SERVER_PORT'], array( '80', '443' ) ) ? '' : ":" . $_SERVER['SERVER_PORT'];
    $act_url .= $_SERVER['REQUEST_URI'];
    return $act_url;
}

function getRootURL() {
	$act_url  = ( isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ) ? 'https' : 'http';
	$act_url .= '://' . $_SERVER['SERVER_NAME'];
	return $act_url;
}

?>
