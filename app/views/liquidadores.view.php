<?php
 class LiquidadoresView {
    
    public function showLiquidadores($liquidadores) {
        $count = count($liquidadores);
        
       
        require 'templates/liquidadores.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
 }
?>