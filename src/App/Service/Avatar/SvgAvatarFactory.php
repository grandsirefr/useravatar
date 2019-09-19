<?php

namespace App\Service\Avatar;

class SvgAvatarFactory{
    
    
    static public function getAvatar(int $nbColors,int $size){
        
        $colors=ColorTools::getRandomColors($nbColors);
        $matrix=new AvatarMatrix();
        $matrix->setSize($size);
        $matrix->setColors($colors);

        $svgAvatarRenderer=new SvgAvatarRenderer('template/avatar.svg.tpl');
        $svg=$svgAvatarRenderer->render($matrix);
        return $svg;
    }
}