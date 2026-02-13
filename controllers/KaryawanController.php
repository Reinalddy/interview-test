<?php
require_once 'models/Karyawan.php';

class KaryawanController
{
    private $model;
    public function __construct($db)
    {
        $this->model = new Karyawan($db);
    }

    public function index()
    {
        $data = $this->model->getAll();
        // Integrasi Soal No. 5: Hitung selisih dari 13/01/1980 ke hari ini
        $d1 = DateTime::createFromFormat('d/m/Y', '13/01/1980');
        $d2 = new DateTime();
        $selisih_demo = $d1->diff($d2)->format('%a hari');
        include 'views/karyawan/list.php';
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->save($_POST);
            header("Location: index.php");
            exit;
        }
        include 'views/karyawan/form.php';
    }

    public function edit($id)
    {
        $edit_data = $this->model->getById($id);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php");
            exit;
        }
        include 'views/karyawan/form.php';
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: index.php");
        exit;
    }
}