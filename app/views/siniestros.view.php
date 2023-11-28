<?php
class SiniestrosView {
    public function showSiniestros($stros, $cias, $liquis,$insps ) {
        $count = count($stros);
        
        require 'templates/strosListar.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
    public function showactualizarStro($stro, $cias,   $liquis,$insps ) {
       
        require 'templates/actualizarStro.phtml';
    }
    public function mostrarHome(){
        require 'templates/header.phtml';
        require 'templates/footer.phtml';
    }
    public function showverCias($stros, $cias) {
       
        require 'templates/verCias.phtml';
    }
    public function showverStrosporCia($stros) {
       
        require 'templates/verSiniestrosCias.phtml';
    }
}
?>

