<?php
require_once './app/models/cias.model.php';
require_once './app/views/cias.view.php';

require_once './app/helpers/auth.helper.php';    
    class ciasController{
        private $model;
        private $view;

        public function __construct(){
            AuthHelper::Verify();

            $this->model= new CiasModel();
            $this->view= new CiasView();
        }


        // listar compañias
        public function listarCias() {
            $cias = $this->model->getCias();

            $this->view->showCias($cias);
        }

        // listar compañia
        public function listarCia($id) {
            $cia = $this->model->getCia($id);

            $this->view->showCia($cia);
        }

        // agregar compañias
        public function agregarCia() {

            // obtengo los datos del usuario
            $id = $_POST['idCia'];
            $nombre = $_POST['nombreCia'];
            $direccion = $_POST['direccion'];
            $contacto = $_POST['contacto'];
            $email = $_POST['email'];
    
            // validaciones
            if (empty($id) || empty($nombre) || empty($direccion)|| empty($contacto)|| empty($email)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            
            $ultimo_id = $this->model->insertCia($id, $nombre, $direccion, $contacto, $email);
            //var_dump($ultimo_id);
            //if ($ultimo_id) {
                header('Location: ' . BASE_URL);
            //} else {
                //$this->view->showError("Error al insertar el liquidador");
           // }
        }

        // eliminar compañia
            function removeCia($id) {
            $this->model->deleteCia($id);
            header('Location: ' . BASE_URL);
        }

        // mostrar detalle compañia
            function detalleCia($id) {

                $cia = $this->model->getCia($id);

                $this->view->showCia($cia);
        }  
   
        // actualizar compañia
        public function actualizarCia($id) {
            $cia = $this->model->getCia($id);
            $this->view->showactualizarCia($cia);

        }

        public function updateCia() {
            $id = $_POST['idCia'];
            $nombre = $_POST['nombreCia'];
            $direccion = $_POST['direccion'];
            $contacto = $_POST['contacto'];
            $email = $_POST['email'];

            // validaciones
            if (empty($nombre) || empty($direccion)|| empty($contacto)|| empty($email)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            $ultimo_id = $this->model->upCia($id, $nombre, $direccion, $contacto, $email);
           
            //var_dump($ultimo_id);
            //if ($ultimo_id) {
                header('Location: ' . BASE_URL);
            //} else {
                //$this->view->showError("Error al insertar el liquidador");
           // }
          
    }

}