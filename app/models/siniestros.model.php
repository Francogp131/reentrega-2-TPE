<?php

    require_once 'app/models/model.php';

class SiniestrosModel extends Model {

    /**
     * Obtiene y devuelve de la base de datos todos los siniestros.
     */
    
     function getSiniestros() {

    
    
        $query =$this->db->prepare('SELECT * FROM siniestros ');
        $query->execute();

        
        $stros = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $stros;
    }
    function agregarStro( $id, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector) {
        $query = $this->db->prepare('INSERT INTO siniestros ( id_Stro, id_Cia, tipo_Stro, nombre_Asegurado, apellido_Asegurado, fecha_Stro, direccion_Aseg, localidad, contacto_Asegurado, id_liquidador, id_inspector) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
        $query->execute([$id, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro,  $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector]);

        return $this->db->lastInsertId();
    }

    function deleteStro($id) {
        $query = $this->db->prepare('DELETE FROM siniestros WHERE id_Stro = ?');
        $query->execute([$id]);
    }
    function upStro($id, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector) {    
        $query = $this->db->prepare('UPDATE siniestros SET id_Cia = ?, tipo_Stro = ?, nombre_Asegurado = ?, apellido_Asegurado = ?, fecha_Stro = ?, direccion_Aseg = ?, localidad =?, contacto_Asegurado = ?, id_liquidador = ?, id_inspector = ?  WHERE id_Stro = ?');
        $query->execute([$id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector, $id ]);
    }

    
    function getSiniestro($id) {
        $query =$this->db->prepare('SELECT * FROM siniestros where id_Stro = ?' );
        $query->execute([$id]);

        // $stros es un arreglo de siniestros
        $stro = $query->fetch(PDO::FETCH_OBJ);
        
        return $stro;
    }

    function getSiniestrosCia($id) {
        $query =$this->db->prepare('SELECT * FROM siniestros where id_Cia = ?' );
        $query->execute([$id]);

        // $stros es un arreglo de siniestros
        $stros = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $stros;
    }
    /**
     * Elimina un stro de la base por id.
     */
    function deleteSiniestro($id) {
        $query = $this->db->prepare('DELETE FROM siniestros WHERE id_Stro = ?');
        $query->execute([$id]);
    }


    function getDetalleItem($id) {
        $query = $this->db->prepare("SELECT * FROM siniestros WHERE id_Stros = ?");
        $query->execute([$id]);

        // $tasks es un arreglo de tareas
        $ItemStro = $query->fetch(PDO::FETCH_OBJ);
        
        return $ItemStro;
    }

    /**
     * Inserta el siniestro en la base de datos
     */
    function insertSiniestro($id_Stro, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector) {
        $query = $this->db->prepare('INSERT INTO siniestros (id_Stro, id_Cia, tipo_Stro, nombre_Asegurado, apellido_Asegurado, fecha_Stro, direccion_Aseg, localidad, contacto_Asegurado, id_liquidador, id_inspector) VALUES(?,?,?,?,?,?,?,?,?,?,?)');
        $query->execute([$id_Stro, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro,  $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector]);

        return $this->db->lastInsertId();
    }
    

    /**
     * Modifica un siniestro de la base dado un id.
     */

    function updateSiniestroData($id, $id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro, $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector) {    
    $query = $this->db->prepare('UPDATE siniestros SET id_Cia = ?, tipo_Stro =?, nombre_Asegurado = ?, apellido_Asegurado = ?, fecha_Stro = ?, direccion_Aseg = ?, localidad = ?, contacto_Asegurado = ?, id_liquidador = ?, id_inspector = ? WHERE id_Stro = ?');
    $query->execute([$id_Cia, $tipo_Stro, $nombre_Asegurado, $apellido_Asegurado, $fecha_Stro,  $direccion_Aseg, $localidad, $contacto_Asegurado, $id_liquidador, $id_inspector, $id]);
}
}
?>