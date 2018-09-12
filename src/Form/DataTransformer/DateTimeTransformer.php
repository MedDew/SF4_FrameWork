<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Form\DataTransformer;
use \Symfony\Component\Form\DataTransformerInterface;
/**
 * Description of DateTimeTransformer
 *
 * @author Mehdi
 */
class DateTimeTransformer implements DataTransformerInterface
{
    public function reverseTransform($string) 
    {
        $dateTime = new \DateTime($string);
        //var_dump($dateTime, $dateTime->format("Y-m-d H:i:s"));
        
        return $dateTime;
    }

    public function transform($dateTimeObject) 
    {
        //var_dump($dateTimeObject, $dateTimeObject->format("Y-m-d H:i:s"));
        return $dateTimeObject->format("Y-m-d H:i:s");
    }

}
