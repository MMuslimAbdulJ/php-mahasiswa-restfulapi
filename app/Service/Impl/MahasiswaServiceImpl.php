<?php
/**
 * This is services for Mahasiswa
 */
namespace muslim\restfulapi\Service\Impl;

use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Entity\Mahasiswa;
use muslim\restfulapi\Exception\validationException;
use muslim\restfulapi\Model\DeleteMahasiswaRequest;
use muslim\restfulapi\Model\GetMahasiswaRequest;
use muslim\restfulapi\Model\MahasiswaResponse;
use muslim\restfulapi\Model\UpdateMahasiswaRequest;
use muslim\restfulapi\Repository\MahasiswaRepository;
use muslim\restfulapi\Service\MahasiswaService;
use muslim\restfulapi\Model\CreateMahasiswaRequest;

class MahasiswaServiceImpl implements MahasiswaService
{

    private MahasiswaRepository $mahasiswaRepository; // Define mahasiswa repository property

    public function __construct(MahasiswaRepository $mahasiswaRepository)
    {
        $this->mahasiswaRepository = $mahasiswaRepository; // Define mahasiswa repository object that will injected from the parameter
    }

    // Service for create mahasiswa
    public function create(CreateMahasiswaRequest $createMahasiswaRequest): MahasiswaResponse
    {
        $this->validateMahasiswaCreateRequest($createMahasiswaRequest);
        try {
            Database::beginTransaction();

            $mahasiswaInDB = $this->mahasiswaRepository->findByNim($createMahasiswaRequest->nim);
            if ($mahasiswaInDB != null) {
                throw new validationException("Mahasiswa with NIM {$createMahasiswaRequest->nim} is already exists");
            }

            $mahasiswa = new Mahasiswa();
            $mahasiswa->nim = $createMahasiswaRequest->nim;
            $mahasiswa->nama = $createMahasiswaRequest->nama;
            $mahasiswa->fakultas = $createMahasiswaRequest->fakultas;
            $mahasiswa->prodi = $createMahasiswaRequest->prodi;
            $this->mahasiswaRepository->save($mahasiswa);

            Database::commitTransaction();

            $response = new MahasiswaResponse();
            $response->mahasiswa = $mahasiswa;

            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    // Service to get mahasiswa
    public function get(GetMahasiswaRequest $getMahasiswaRequest): MahasiswaResponse
    {
        $this->validateGetMahasiswaRequest($getMahasiswaRequest);
        $mahasiswa = $this->mahasiswaRepository->findByNim($getMahasiswaRequest->nim);
        if ($mahasiswa == null) {
            throw new validationException("Your NIM request is wrong");
        }
        $response = new MahasiswaResponse();
        $response->mahasiswa = $mahasiswa;
        return $response;
    }

    // Service to update mahasiswa
    public function update(UpdateMahasiswaRequest $updateMahasiswaRequest, string $nim): MahasiswaResponse
    {
        $this->validateMahasiswaUpdateRequest($updateMahasiswaRequest);
        try {
            Database::beginTransaction();
            $mahasiswa = $this->mahasiswaRepository->findByNim($nim);
            if ($mahasiswa == null) {
                throw new validationException("Your NIM request is wrong");
            }
            $mahasiswa->nama = $updateMahasiswaRequest->nama;
            $mahasiswa->fakultas = $updateMahasiswaRequest->fakultas;
            $mahasiswa->prodi = $updateMahasiswaRequest->prodi;

            $update = $this->mahasiswaRepository->update($mahasiswa);

            Database::commitTransaction();

            $response = new MahasiswaResponse();
            $response->mahasiswa = $update;

            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    // Service to delete mahasiswa
    public function delete(DeleteMahasiswaRequest $deleteMahasiswaRequest): string
    {
        $this->validateDeleteMahasiswaRequest($deleteMahasiswaRequest);
        try {
            Database::beginTransaction();
            $mahasiswa = $this->mahasiswaRepository->findByNim($deleteMahasiswaRequest->nim);
            if ($mahasiswa == null) {
                throw new validationException("Your NIM request is wrong");
            }
            $this->mahasiswaRepository->deleteByNim($mahasiswa->nim);
            Database::commitTransaction();
            return "Delete success";
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

/**
 * This side is to validate every service in above
 */
    private function validateMahasiswaCreateRequest(CreateMahasiswaRequest $createMahasiswaRequest)
    {
        if (
            $createMahasiswaRequest->nim == null || trim($createMahasiswaRequest->nim) == "" ||
            $createMahasiswaRequest->nama == null || trim($createMahasiswaRequest->nama) == "" ||
            $createMahasiswaRequest->fakultas == null || trim($createMahasiswaRequest->fakultas) == "" ||
            $createMahasiswaRequest->prodi == null || trim($createMahasiswaRequest->prodi) == ""
        ) {
            throw new validationException("Body request cannot null or empty");
        }
    }

    private function validateGetMahasiswaRequest(GetMahasiswaRequest $getMahasiswaRequest)
    {
        if ($getMahasiswaRequest->nim == null || trim($getMahasiswaRequest->nim) == "") {
            throw new validationException("Your GET request is not valid because NIM is null or empty");
        }
    }

    private function validateMahasiswaUpdateRequest(UpdateMahasiswaRequest $updateMahasiswaRequest)
    {
        if (
            $updateMahasiswaRequest->nama == null || trim($updateMahasiswaRequest->nama) == "" ||
            $updateMahasiswaRequest->fakultas == null || trim($updateMahasiswaRequest->fakultas) == "" ||
            $updateMahasiswaRequest->prodi == null || trim($updateMahasiswaRequest->prodi) == ""
        ) {
            throw new validationException("Body request cannot null or empty");
        }
    }

    private function validateDeleteMahasiswaRequest(DeleteMahasiswaRequest $deleteMahasiswaRequest)
    {
        if ($deleteMahasiswaRequest->nim == null || trim($deleteMahasiswaRequest->nim) == "") {
            throw new validationException("Your DELETE request is not valid because NIM is null or empty");
        }
    }

}

?>