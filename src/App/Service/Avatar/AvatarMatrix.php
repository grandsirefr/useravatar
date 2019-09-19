<?php 

namespace App\Service\Avatar;

class AvatarMatrix{
    
    //Propriété
    const DEFAULT_SIZE=4;
    const DEFAULT_COLORS=['black','white'];
    private $size;
    private $colors;
    private $matrix;
    
    //Méthode
    
    public function __construct(){
        //$this->setSize($size);
        //$this->setColors($colors);
        //$this->matrix=generateMatrix($this->size,$this->colors);
        $this->size=self::DEFAULT_SIZE;
        $this->colors=self::DEFAULT_COLORS;
        $this->matrix=[];
        
    }
    
    public function build(){
        $avatar=$this->matrix;
        for($i = 0 ; $i < $this->size ; $i++){

	       $avatar[$i] = [];
    
                for($j = 0 ; $j < $this->size/2 ; $j++){
    
    	           $color = $this->colors[rand(0, count($this->colors) - 1)];
    	           $avatar[$i][$j] = $color;
                    $avatar[$i][$this->size -1 - $j] = $color;
                }
        }
        
        
        $this->matrix=$avatar;
        //var_dump($this->matrix);
    }

    
    public function getMatrix(){
        return $this->matrix;
    }
    
    function setSize($size){
        $this->size=$size;
    }
    
    function setColors($colors){
        $this->colors=$colors;
    }
    
    function getSize(){
        return $this->size;
    }
    function getColors(){
        return $this->colors;
    }
    
}
    
    /*private function generateMatrix(){
        //for($i = 0 ; $i < count($Colors) ; $i++){

	      // $colors[] = getRandomColor();
        //}
        
        $matrix = [];
        
        for($i = 0 ; $i < $size ; $i++){

	       $matrix[$i] = [];
    
                for($j = 0 ; $j < $size/2 ; $j++){
    
    	           $color = $colors[rand(0, count($colors) - 1)];
    	           $avatar[$i][$j] = $color;
                    $avatar[$i][$taille -1 - $j] = $color;
                }
        }

    }*/
