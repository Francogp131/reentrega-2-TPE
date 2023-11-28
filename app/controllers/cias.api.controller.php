<?php
    require_once 'app/controllers/api.controller.php';

    require_once 'app/models/cias.model.php';
    require_once 'app/views/api.view.php';

    
    class CiasApiController extends ApiController {
        private $model;
        

        function __construct() {
            parent::__construct();
            $this->model = new CiasModel();
           
        }

        function getAll($params = null) {
            $parametro = [];
            if (isset($_GET ['sort'])){
                $parametro['sort'] = ($_GET ['sort']);
            }
            if (isset($_GET ['order'])){
                $parametro['order'] = ($_GET ['order']);
            };
            $cias = $this->model->getCias($parametro);
            $this->view->response($cias, 200);
        }

        function get($params = null){
            $cia = $this->model->getCia($params[':ID']);
            if(!empty($cia)) {
                                    
                $this->view->response($cia, 200);
            } else {
                $this->view->response('La Compañia con el id='.$params[':ID'].' no existe.', 404);
            }
        }


  

            function delete($params = []) {
                $id = $params[':ID'];
                $cia = $this->model->getCia($id);

               if($cia) {
                   $this->model->deleteCia($id);
                   $this->view->response('La Compañia con id='.$id.' ha sido borrada.', 200);
               } else {
                $this->view->response('La Compañia con id='.$id.' no existe.', 404);
            }
        }

            function create($params = []) {
               $body = $this->getData();

               $id_Cia =$body->id_Cia;
               $nombre_cia = $body->nombre_cia;
               $direccion_cia = $body->direccion_cia;
               $contacto = $body->contacto;
               $email = $body->email;
               

            $id = $this->model->insertCia($id_Cia, $nombre_cia, $direccion_cia, $contacto, $email);
            
             $this->view->response('El Siniestro fue insertada con el id='.$id_Cia, 201);
        }

            function update($params = []) {
            $id = $params[':ID'];
            $cia = $this->model->getCia($id);

            if($cia) {
                $body = $this->getData();
                $nombre_cia = $body->nombre_cia;
                $direccion_cia = $body->direccion_cia;
                $contacto = $body->contacto;
                $email = $body->email;

                $this->model->updateCiaData($id, $nombre_cia, $direccion_cia, $contacto, $email);

                $this->view->response('La Compañia con id='.$id.' ha sido modificada.', 200);
            } else {
                $this->view->response('La Compañia con id='.$id.' no existe.', 404);
            }
        }
   }