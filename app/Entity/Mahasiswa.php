<?php 
/**
 * Class to represent the tables in the database
 */
namespace muslim\restfulapi\Entity;

class Mahasiswa {
    public string $nim; // unique, varchar
    public string $nama; // varchar
    public string $fakultas; // varchar
    public string $prodi; // varchar
}

?>