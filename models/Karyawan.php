<?php
class Karyawan
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        return $this->db->query("SELECT k.*, j.nama_jabatan, kt.nama_kota 
               FROM tr_karyawan k 
               JOIN ms_jabatan j ON k.id_jabatan = j.id_jabatan 
               JOIN ms_kota kt ON k.id_kota = kt.id_kota")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM tr_karyawan WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($data)
    {
        $sql = "INSERT INTO tr_karyawan (nama_karyawan, tanggal_lahir, id_jabatan, id_kota) VALUES (?,?,?,?)";
        return $this->db->prepare($sql)->execute([$data['nama'], $data['tgl_lahir'], $data['jabatan'], $data['kota']]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tr_karyawan SET nama_karyawan=?, tanggal_lahir=?, id_jabatan=?, id_kota=? WHERE id=?";
        return $this->db->prepare($sql)->execute([$data['nama'], $data['tgl_lahir'], $data['jabatan'], $data['kota'], $id]);
    }

    public function delete($id)
    {
        return $this->db->prepare("DELETE FROM tr_karyawan WHERE id = ?")->execute([$id]);
    }
}