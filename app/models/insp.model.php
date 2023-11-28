<?php

    require_once 'app/models/model.php';

class InspectoresModel extends Model {

    /**
     * Obtiene y devuelve de la base de datos todos los siniestros.
     */
    
     function getInspectores() {

    
    
        $query =$this->db->prepare('SELECT * FROM inspectores ');
        $query->execute();

        
        $insp = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $insp;
    }
}