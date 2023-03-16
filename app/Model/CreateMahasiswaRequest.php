<?php 
/**
 * Class for API request : create mahasiswa
 */
namespace muslim\restfulapi\Model;

class CreateMahasiswaRequest {
    public ?string $nim = null;
    public ?string $nama = null;
    public ?string $fakultas = null;
    public ?string $prodi = null;
}

?>