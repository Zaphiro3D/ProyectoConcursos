<?php

class validador
{   
    public function string ($value){
        return strlen(trim($value)) === 0;
    }
}