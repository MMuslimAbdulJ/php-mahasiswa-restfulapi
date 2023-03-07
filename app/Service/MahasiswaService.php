<?php 

namespace muslim\restfulapi\Service;
use muslim\restfulapi\Model\CreateMahasiswaRequest;
use muslim\restfulapi\Model\MahasiswaResponse;
use muslim\restfulapi\Model\UpdateMahasiswaRequest;

interface MahasiswaService {
    function create(CreateMahasiswaRequest $createMahasiswaRequest) : MahasiswaResponse;
    function get(string $nim) : MahasiswaResponse;
    function update(UpdateMahasiswaRequest $updateMahasiswaRequest) : MahasiswaResponse;
    function delete(string $nim);
}

?>