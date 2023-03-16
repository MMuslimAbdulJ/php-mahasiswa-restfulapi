<?php 
/**
 * Interface for contract to service implementation
 */
namespace muslim\restfulapi\Service;
use muslim\restfulapi\Model\CreateMahasiswaRequest;
use muslim\restfulapi\Model\DeleteMahasiswaRequest;
use muslim\restfulapi\Model\GetMahasiswaRequest;
use muslim\restfulapi\Model\MahasiswaResponse;
use muslim\restfulapi\Model\UpdateMahasiswaRequest;

interface MahasiswaService {
    function create(CreateMahasiswaRequest $createMahasiswaRequest) : MahasiswaResponse;
    function get(GetMahasiswaRequest $getMahasiswaRequest) : MahasiswaResponse;
    function update(UpdateMahasiswaRequest $updateMahasiswaRequest, string $nim) : MahasiswaResponse;
    function delete(DeleteMahasiswaRequest $deleteMahasiswaRequest) : string;
}

?>