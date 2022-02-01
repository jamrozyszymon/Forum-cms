<?php

namespace Test;

class Check
{
    public function dump($var)
    {
        echo '<pre>';
        print_r($var);
        '</pre>';
    }
}

/*
$check_var= new Check();
$chech_var->dump($var);
*/