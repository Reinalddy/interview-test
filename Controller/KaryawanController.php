<?php
require_once 'Model/Karyawan.php';

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
        include 'View/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->store($_POST);
            header("Location: index.php");
        }
    }
}