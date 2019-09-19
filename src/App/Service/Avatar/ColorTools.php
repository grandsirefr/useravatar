<?php 

namespace App\Service\Avatar;

class ColorTools{
    public static function getRandomColor():string{
       $chars = str_split('ABCDEF0123456789');
        $color = '#';
        for($i = 0 ; $i < 6 ; $i++){
    	   $color .= $chars[rand(0, count($chars) - 1)];
        }
        return $color;
    }
    
    static function getRandomColors(int $n):array{
        $colors=array_fill(0,$n,null);
        return array_map(function($avlue){
            return self::getRandomColor();
        },$colors);
    }
}
