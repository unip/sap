<?php
class Pemesanan{
 
    // database connection and table name
    private $conn;
    private $table_name = "pemesanan";
 
    // object properties
    public $id_pemesanan;
    public $no_referensi;
    public $tanggal;
    public $nama_pemilik;
    public $nama_perusahaan;
    public $no_spbu;
    public $lokasi;
    public $qty;
    public $gas_type;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    
    }
    // read data
    function read(){
 
    // select all query
    $query = "SELECT p.id_pemesanan, l.no_referensi, p.tanggal, c.nama_pemilik, c.nama_perusahaan, c.no_spbu, c.lokasi, p.qty, t.gas_type 
	    FROM pemesanan p 
            INNER JOIN customer c 
	            ON p.customer = c.id_customer 
            INNER JOIN loading_order l
	            ON l.pemesanan = p.id_pemesanan
            INNER JOIN typebbm t
	            ON t.id_typeBBM = p.typeBBM";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}

}