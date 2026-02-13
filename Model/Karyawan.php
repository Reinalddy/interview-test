<?php
class Karyawan
{
    private $db;

    public function __construct($db_connection)
    {
        $this->db = $db_connection;
    }

    public function getAll()
    {
        $query = "SELECT k.*, j.nama_jabatan, kt.nama_kota 
                  FROM tr_karyawan k
                  LEFT JOIN ms_jabatan j ON k.id_jabatan = j.id_jabatan
                  LEFT JOIN ms_kota kt ON k.id_kota = kt.id_kota";
        return $this->db->query($query);
    }

    public function store($data)
    {
        $sql = "INSERT INTO tr_karyawan (nama_karyawan, tanggal_lahir, id_jabatan, id_kota) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$data['nama'], $data['tgl_lahir'], $data['jabatan'], $data['kota']]);
    }
    // Fungsi Update & Delete mengikuti pola yang sama
}