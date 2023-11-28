<?php
require_once './app/models/liquidadores.model.php';
require_once './app/views/liquidadores.view.php';
//require_once './app/helpers/liquidadores.helper.php';    
    class LiquidadoresController{
        private $model;
        private $view;

        public function __construct(){
            //AuthHelper::Verify();

            $this->model= new LiquidadoresModel();
            $this->view= new LiquidadoresView();
        }

        public function mostrarLiquidadores() {
            $liquidadores = $this->model->getLiquidador();

            $this->view->showLiquidadores($liquidadores);
        }

        public function agregarLiquidadores() {

            // obtengo los datos del usuario
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $contacto = $_POST['contacto'];
            $email = $_POST['email'];
    
            // validaciones
            if (empty($nombre) || empty($apellido)|| empty($contacto)|| empty($email)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
    
            $id = $this->model->insertLiquidador($nombre, $apellido, $contacto, $email);
            if ($id) {
                header('Location: ' . BASE_URL);
            } else {
                $this->view->showError("Error al insertar el liquidador");
            }
        }

        function borrarLiquidador($id) {
            $this->model->deleteLiquidador($id);
            header('Location: ' . BASE_URL);
        }
        
        function editarLiquidadork($id) {
            $this->model->updateLiquidador($id);
            header('Location: ' . BASE_URL);
        }
    }



?>