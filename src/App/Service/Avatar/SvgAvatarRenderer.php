<?php

namespace App\Service\Avatar;

class SvgAvatarRenderer{
    
    private $template;
    
    public function __construct(string $template){
        $this->template=$template;
    }
    
    public function render(AvatarMatrix $matrix){
        $matrix->build();
        $result=$matrix->getMatrix();
        ob_start(); // début de la temporisation

        include $this->template;
        return ob_get_clean();
    }
}
//Propiété
/*  -template
    
Méthode 
    -Constructeur
    -render(AvatarMatrix, $matrix)*/