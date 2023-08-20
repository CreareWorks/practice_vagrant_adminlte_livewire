<?php
namespace App\Http\Services;

abstract class PracticeAbstractUserService
{
    abstract public function test();

    public function tset2()
    {
        $result = $this->test();
        return $result;
    }
}



?>