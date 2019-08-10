<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/pemesanan.php';
 
// instantiate database and data object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$pemesanan = new Pemesanan($db);
 
// query data
$stmt = $pemesanan->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // data array
    $pemesanan_arr=array();
    $pemesanan_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $pemesanan_item=array(
            "id_pemesanan" => $id_pemesanan,
            "no_referensi" => $no_referensi,
            "tanggal" => $tanggal,
            "nama_pemilik" => $nama_pemilik,
            "nama_perusahaan" => $nama_perusahaan,
            "no_spbu" => $no_spbu,
            "lokasi" => $lokasi,
            "qty" => $qty,
            "gas_type" => $gas_type
        );
 
        array_push($pemesanan_arr["records"], $pemesanan_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show data data in json format
    echo json_encode($pemesanan_arr);
}
 
// no data found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no data found
    echo json_encode(
        array("message" => "No data found.")
    );
}
