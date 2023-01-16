<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro_model;

class Home extends BaseController
{
    public function index()
    {
        $libro = new Libro_model();
        $datos['libros']= $libro->orderBy('id','ASC')->findAll();

        $datos['header']= view('template/header');
        $datos['footer']= view('template/footer');
        return view('libros/listar', $datos);
    }

}
