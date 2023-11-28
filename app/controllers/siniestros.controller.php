
<?php
require_once './app/models/siniestros.model.php';
require_once './app/models/cias.model.php';
require_once './app/models/liqui.model.php';
require_once './app/models/insp.model.php';
require_once './app/views/siniestros.view.php';
require_once './app/helpers/auth.helper.php';  
  
    class siniestrosController{
        private $model;
        private $view;
        private $modelcia;
        private $modelinsp;
        private $modelliqui;

        public function __construct(){
            AuthHelper::Verify();

            $this->model= new SiniestrosModel();
            $this->modelcia= new CiasModel();
            $this->modelliqui= new LiquidadoresModel();
            $this->modelinsp= new InspectoresModel();
            $this->view= new SiniestrosView();
        }

        public function mostrarSiniestros() {

            $stros = $this->model->getSiniestros();
            $cias = $this->modelcia->getCias();
            $liquis = $this->modelliqui->getLiquidadores();
            $insps = $this->modelinsp->getInspectores();
            $this->view->showSiniestros($stros, $cias,$liquis, $insps);
        }
        public function agregarStro() {
            $stros = $this->model->getSiniestros();
            $id = count($stros) ;
            // obtengo los datos del usuario
            //$id = $_POST['idstro'];
            $nombrecia = $_POST['nombre_cia'];
            $tipo = $_POST['tipo_stro'];
            $nombre = $_POST['nombre_asegurado'];
            $apellido = $_POST['apellido_asegurado'];
            $fecha = $_POST['fecha'];
            $direccion = $_POST['direccion'];
            $localidad = $_POST['localidad'];
            $contacto = $_POST['contactoaseg'];
            $liquidador = $_POST['nombre_liqui'];
            $inspector = $_POST['nombre_insp'];
    
            // validaciones
            if (empty($id) ||empty($nombrecia) ||empty($tipo) ||empty($apellido) ||empty($fecha) ||empty($localidad) ||empty($liquidador) || empty($nombre) || empty($direccion)|| empty($contacto)|| empty($inspector)) {
                $this->view->showError("Debe completar todos los campos");
                return;
            }
            
            $ultimo_id = $this->model->agregarStro($id, $nombrecia, $tipo, $nombre, $apellido, $fecha, $direccion, $localidad,  $contacto, $liquidador, $inspector);
            
            //if ($ultimo_id) {
                header('Location: ' . BASE_URL);
            //} else {
                //$this->view->showError("Error al insertar el liquidador");
           // }
        }
        function removeStro($id) {
            $this->model->deleteStro($id);
            header('Location: ' . BASE_URL);
        }

        public function actualizarStro($id) {
            $stro = $this->model->getSiniestro($id);
            $cias = $this->modelcia->getCias();
            $liquis = $this->modelliqui->getLiquidadores();
            $insps = $this->modelinsp->getInspectores();
            $this->view->showactualizarStro($stro, $cias, $liquis, $insps);
            
        }

        public function updateStro() {
           
            $id = $_POST['idstro'] ;
            // obtengo los datos del usuario
            //$id = $_POST['idstro'];
            $nombrecia = $_POST['nombre_cia'];
            $tipo = $_POST['tipo_stro'];
            $nombre = $_POST['nombre_asegurado'];
            $apellido = $_POST['apellido_asegurado'];
            $fecha = $_POST['fecha'];
            $direccion = $_POST['direccion'];
            $localidad = $_POST['localidad'];
            $contacto = $_POST['contactoaseg'];
            $liquidador = $_POST['nombre_liqui'];
            $inspector = $_POST['nombre_insp'];
            // validaciones
           // if (empty($nombrecia) || empty($tipo) || empty($apellido) || empty($fecha) || empty($localidad) || empty($liquidador) || empty($nombre) || empty($direccion)|| empty($contacto) || empty($inspector)) {
          //      $this->view->showError("Debe completar todos los campos");
            //    return;
          //  }
            $ultimo_id = $this->model->upStro($id, $nombrecia, $tipo, $nombre, $apellido, $fecha, $direccion, $localidad,  $contacto, $liquidador, $inspector);
           
            //var_dump($ultimo_id);
            //if ($ultimo_id) {
                header('Location: ' . BASE_URL);
            //} else {
                //$this->view->showError("Error al insertar el liquidador");
           // }   
    }


    public function listarCiasStro (){
        $stros = $this->model->getSiniestros();
        $cias = $this->modelcia->getCias();
        $this->view->showverCias($stros, $cias);

    }

    public function verStrosporCia() {
        $id = $_POST['nombre_cia'];
        $stros = $this->model->getSiniestrosCia($id);
        $this->view->showverStrosporCia($stros);
    }
        


    }
    
?>