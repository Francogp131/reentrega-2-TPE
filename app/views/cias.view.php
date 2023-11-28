<?php
 class CiasView {
    
    public function showCias($cias) {
        $count = count($cias);
        
       
        require 'templates/ciasListar.phtml';
    }

    public function showCia($cia) {
       
        require 'templates/ciaListar.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showactualizarCia($cia) {
        require 'templates/actualizarCia.phtml';
    }
 }
?>