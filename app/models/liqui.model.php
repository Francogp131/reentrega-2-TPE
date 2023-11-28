<?php

    require_once 'app/models/model.php';

class LiquidadoresModel extends Model {

    /**
     * Obtiene y devuelve de la base de datos todos los siniestros.
     */
    
     function getLiquidadores() {

    
    
        $query =$this->db->prepare('SELECT * FROM liquidadores ');
        $query->execute();

        
        $stros = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $stros;
    }
}