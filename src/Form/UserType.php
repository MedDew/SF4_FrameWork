<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\DataTransformer\DateTimeTransformer;
use \Symfony\Component\Form\Extension\Core\Type\HiddenType;
use \Symfony\Component\Form\Extension\Core\Type\TextType;
use \App\Entity\User;
use Symfony\Component\Validator\Constraints\NotNull;


class UserType extends AbstractType
{
    private $dateTimeTransformer;
    
    public function __construct(DateTimeTransformer $transformer)
    {
        $this->dateTimeTransformer = $transformer;
    }
    
    function buildForm(FormBuilderInterface $builder, array $options) 
    {
        //$now = new \DateTime("now");
        
        //parent::buildForm($builder, $options);
        $builder->add(
                        "firstName", 
                        TextType::class, 
                        array(
                                "label" => "First Name", 
                                "attr" => array("placeholder" => "Your First Name"),
                                "data" => "", 
                                "empty_data" => "" , 
                                "constraints" => array(new NotNull(array("message" => "Please fill your first name")))
                             )
                      )//"constraints" => array(new \Symfony\Component\Validator\Constraints\NotNull(array("message" => "Please fill your first name")))
                ->add(
                        "lastName", 
                        TextType::class, 
                        array(
                                "label" => "Last Name", 
                                "attr" => array("placeholder" => "Your Last Name"), 
                                "data" => "", 
                                "empty_data" => ""
                              )
                      )//"constraints" => array(new \Symfony\Component\Validator\Constraints\NotNull(array("message" => "Please fill your last name")))
                ->add(
                        "creationDate", 
                        HiddenType::class, 
                        array(
                                //"label" => "Creation Date", 
                                "attr" => array("readonly" => true)
                             )
                     )//"data" => $now
                ->add(
                        "lastLogginDate", 
                        HiddenType::class, 
                        array(
                                //"label" => "Last Login Date", 
                                "attr" => array("readonly" => true)
                             )
                     )//"data" => ""  |  "data" => $now->format("Y-m-d H:i:s")
                ->add(
                        "isLogged", 
                        HiddenType::class, 
                        array(
                                //"label" => "Connected" , 
                                "attr" => array("readonly" => true), 
                                "data" => 0
                             )
                     )
                ->add("Save", SubmitType::class);
        
        $builder->get("creationDate")->addModelTransformer($this->dateTimeTransformer);
        $builder->get("lastLogginDate")->addModelTransformer($this->dateTimeTransformer);
    }
    
    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) 
    {
//        parent::configureOptions($resolver);
        $resolver->setDefaults(
                                array( "data_class" => User::class)
                              );
    }


}
