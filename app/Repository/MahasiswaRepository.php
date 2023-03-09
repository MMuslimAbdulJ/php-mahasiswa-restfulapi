<?php 

namespace muslim\restfulapi\Repository;
use PDO;
use muslim\restfulapi\Config\Database;
use muslim\restfulapi\Entity\Mahasiswa;

class MahasiswaRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

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

    public function deleteByNim(string $id) : void {
        $statement = $this->connection->prepare('DELETE FROM mahasiswa WHERE nim = ?');
        $statement->execute([$id]);
    }

    public function deleteAll() : void {
        $this->connection->exec('DELETE FROM mahasiswa');
    }
}

?>