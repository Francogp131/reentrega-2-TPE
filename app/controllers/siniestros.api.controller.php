<?php
    require_once 'app/controllers/api.controller.php';

    require_once 'app/models/siniestros.model.php';
    require_once 'app/views/api.view.php';

    
    class SiniestrosApiController extends ApiController {
        private $model;
        

        function __construct() {
            parent::__construct();
            $this->model = new SiniestrosModel();
           
        }

        function getAll($params = null) {
            $parametro = [];
            if (isset($_GET ['sort'])){
                $parametro['sort'] = ($_GET ['sort']);
            }
            if (isset($_GET ['order'])){
                $parametro['order'] = ($_GET ['order']);
            };
            $siniestros = $this->model->getSiniestros($parametro);
            $this->view->response($siniestros, 200);
        }

        function get($params = null){
            $siniestro = $this->model->getSiniestro($params[':ID']);
            if(!empty($siniestro)) {
                                    
                $this->view->response($siniestro, 200);
            } else {
                $this->view->response('El Siniestro con el id='.$params[':ID'].' no existe.', 404);
            }
        }
       /* public function get($params = []) {
            
                if (empty($params)){
                    $siniestros = $this->model->getSiniestros();
                    $this->view->response($siniestros, 200);
                } 
                else {
                                $siniestro = $this->model->getSiniestro($params[':ID']);
                                if(!empty($siniestro)) {
                                   
                                        $this->view->response($siniestro, 200);
                                } else {
                                    $this->view->response(
                                        'El siniestro con el id='.$params[':ID'].' no existe.'
                                        , 404);
                                }
                            }
                        }
        */

  

            public function delete($params = []) {
                $id = $params[':ID'];
                $siniestro = $this->model->getSiniestro($id);

               if($siniestro) {
                   $this->model->deleteSiniestro($id);
                   $this->view->response('El siniestro con id='.$id.' ha sido borrado.', 200);
               } else {
                $this->view->response('El siniestro con id='.$id.' no existe.', 404);
            }
        }

            public function create($params = []) {
               $body = $this->getData();

               $id_Stro = $body->id_Stro;
               $id_Cia = $body->id_Cia;
               $tipo_Stro = $body->tipo_Stro;
               $nombre_Asegurado = $body->nombre_Asegurado;
               $apellido_Asegurado = $body->apellido_Asegurado;
               $fecha_Stro = $body->fecha_Stro;
               $direccion_Aseg = $body->direccion_Aseg;
               $localidad = $body->localidad;
               $contacto_Asegurado = $body->contacto_Asegurado;   
               $id_liquidador = $body->id_liquidador;
               $id_inspector = $body->id_inspector;

            $id = $this->model->insertSiniestro($id_Stro, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro,  $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector);

                $this->view->response('El Siniestro fue insertada con el id='.$id, 201);
        }

          function update($params = []) {
            $id = $params[':ID'];
            $siniestro = $this->model->getSiniestro($id);

            if($siniestro) {
                $body = $this->getData();
                $id_Cia = $body->id_Cia;
                $tipo_Stro = $body->tipo_Stro;
                $nombre_Asegurado = $body->nombre_Asegurado;
                $apellido_Asegurado = $body->apellido_Asegurado;
                $fecha_Stro = $body->fecha_Stro;
                $direccion_Aseg = $body->direccion_Aseg;
                $localidad = $body->localidad;
                $contacto_Asegurado = $body->contacto_Asegurado;   
                $id_liquidador = $body->id_liquidador;
                $id_inspector = $body->id_inspector;

                $this->model->updateSiniestroData($id, $id_Cia, $tipo_Stro,$nombre_Asegurado, $apellido_Asegurado,$fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector);

                $this->view->response('El Siniestro con id='.$id.' ha sido modificado.', 200);
            } else {
                $this->view->response('El Siniestro con id='.$id.' no existe.', 404);
            }
        }
   }