<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Libro_model;

class Libros extends Controller{

    //Metodo que retorn la vista de lista de libros
    public function index(){

        $libro = new Libro_model();
        $datos['libros']= $libro->orderBy('id','ASC')->findAll();

        $datos['header']= view('template/header');
        $datos['footer']= view('template/footer');
        return view('libros/listar',$datos);
    }

    //Metodo que retorna vista de crear libro
    public function create(){

        $datos['header']= view('template/header');
        $datos['footer']= view('template/footer');
        return view('libros/crear', $datos);
    }

    //Metodo para guardar libro
    public function save(){

        $libro = new Libro_model();

        $validacion = $this->validate([
            'bookName'=>'required|min_length[3]',
            'image'=>[
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]'
            ]
        ]);

        if(!$validacion){
            $session = session();
            $session -> setFlashdata('mensaje', 'Todos los campos son requeridos');
            return redirect()->back()->withInput();
        }

        if($imagen = $this->request->getFile('image')){
            $newName = $imagen->getRandomName();
            $imagen->move('../public/uploadsImages', $newName);
            $data = [
                'nombre' => $this->request->getVar('bookName'),
                'imagen' => $newName
            ];
            $libro->insert($data);
        }
        return $this->response->redirect(base_url('/listar'));
    }

    //Metodo para eliminar un libro
    public function delete($id = null){

        $libro = new Libro_model();
        $dataBook = $libro->where('id', $id)->first();

        $ruta=('../public/uploadsImages/'.$dataBook['imagen']);
        unlink($ruta);

        $libro->where('id', $id)->delete($id);

        return $this->response->redirect(base_url('/listar'));
    }

    //Metodo que retorna vista de editar
    public function update($id = null){

        $datos['header']= view('template/header');
        $datos['footer']= view('template/footer');

        $libro = new Libro_model();
        $datos['libro'] = $libro->where('id',$id)->first();
        
        return view('libros/editar', $datos);
    }

    //Metodo para editar el libro
    public function edit($id = null){

        $libro = new Libro_model();
        $data = [
            'nombre'=> $this->request->getVar('bookName')
        ];
        $id = $this->request->getVar('id');
        $imagen = $this->request->getFile('image');

        $validacion = $this->validate([
            'bookName'=>'required|min_length[3]',
            'image'=>[
                'uploaded[image]',
                'mime_in[image,image/jpg,image/jpeg,image/png]'
            ]
        ]);

        if(!$validacion){
            $session = session();
            $session -> setFlashdata('mensaje', 'Todos los campos son requeridos');
            return redirect()->back()->withInput();
        }

        $libro->update($id,$data);
        
            if($imagen){

                $dataBook = $libro ->where('id', $id)->first();

                $ruta=('../public/uploadsImages/'.$dataBook['imagen']);
                unlink($ruta);               

                $newName = $imagen->getRandomName();
                $imagen->move('../public/uploadsImages/',$newName);
                $data=['imagen'=>$newName];
                
                $libro->update($id,$data);
            }
        return $this->response->redirect(base_url('/listar'));
    }
}