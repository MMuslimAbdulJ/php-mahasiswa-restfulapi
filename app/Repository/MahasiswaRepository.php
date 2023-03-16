<?php
/**
 * This is a repository class for mahasiswa
 */
namespace muslim\restfulapi\Repository;
use PDO;
use muslim\restfulapi\Entity\Mahasiswa;

class MahasiswaRepository {
    private PDO $connection;

    // This construct will receive (inject) an object from database
    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    // This method is useful as a place to store data from the service to the database
    public function save(Mahasiswa $mahasiswa) : Mahasiswa {
        $statement = $this->connection->prepare('INSERT INTO mahasiswa (nim, nama, fakultas, prodi) VALUES (?,?,?,?)');
        $statement->execute([
            $mahasiswa->nim,
            $mahasiswa->nama,
            $mahasiswa->fakultas,
            $mahasiswa->prodi
        ]);
        return $mahasiswa;
    }

    // This method is to find a data (one) in the database
    public function findByNim(string $nim) : ?Mahasiswa {
        $statement = $this->connection->prepare('SELECT nim, nama, fakultas, prodi FROM mahasiswa WHERE nim = ?');
        $statement->execute([$nim]);
        try{
            if ($row = $statement->fetch()) {
                $mahasiswa = new Mahasiswa;
                $mahasiswa->nim = $row['nim'];
                $mahasiswa->nama = $row['nama'];
                $mahasiswa->fakultas = $row['fakultas'];
                $mahasiswa->prodi = $row['prodi'];
                return $mahasiswa;
            } else {
                return null;
            }
        } finally{
            $statement->closeCursor();
        }
    }

    // This method is for update the data in the database
    public function update(Mahasiswa $mahasiswa) : Mahasiswa {
        $statement = $this->connection->prepare('UPDATE mahasiswa SET nama = ?, fakultas = ?, prodi = ? WHERE nim = ?');
        $statement->execute([
            $mahasiswa->nama,
            $mahasiswa->fakultas,
            $mahasiswa->prodi,
            $mahasiswa->nim
        ]);
        return $mahasiswa;
    }

    // This method is used for delete the a data in the database
    public function deleteByNim(string $id) : void {
        $statement = $this->connection->prepare('DELETE FROM mahasiswa WHERE nim = ?');
        $statement->execute([$id]);
    }

    // This method is used for delete all data in the database
    // I only use this method for the unit tetst
    public function deleteAll() : void {
        $this->connection->exec('DELETE FROM mahasiswa');
    }
}

?>