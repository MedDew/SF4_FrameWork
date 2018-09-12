<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Entity\User;
use Psr\Log\LoggerInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list")
     */
    public function userList()
    {
        $em = $this->getDoctrine()->getManager();
        $userList = $em->getRepository(User::class)
                       ->findAll();
        
        return $this->render(
                             'user/userList.html.twig', 
                             ['userList' => $userList]
                            );
    }
    
    /**
     * @Route("/user/create" , name="user_create")
     */
    public function postUser(Request $request, LoggerInterface $log)
    {
        $user = new User();
//        $user->setCreationDate(new \DateTime("now") );
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
//        $form->get("lastLogginDate")->getData(),
//        $form->get("isLogged")->getData(),$form->getData(),$request);
        $log->info("First Name : ".$form->get("firstName")->getData());
        $log->info("Last Name : ".$form->get("lastName")->getData());
        $log->info("Creation Date : ".$form->get("creationDate")->getData()->format("Y-m-d H:i:s"));
        $log->info("Creation Date : ".$form->get("creationDate")->getData()->format("Y-m-d H:i:s"));
        //$log->info("Creation Date : ".var_dump($form->get("creationDate")->getData()));
        $log->info("Last Login Date : ".$form->get("lastLogginDate")->getData()->format("Y-m-d H:i:s"));
        $log->info("Is Logged : ".$form->get("isLogged")->getData());

        
        if($form->isSubmitted() && $form->isValid())//
        {
            var_dump($form->isValid());
//            $user = $form->getData();
            var_dump($user);
            
//        $form->get("lastLogginDate")->getData(),
//        $form->get("isLogged")->getData());
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
            
//            return $this->redirectToRoute(
//                                          "user_created", 
//                                          array("userId" => $user->getId())
//                                         ) ;
        }
//        var_dump($form->getErrors());
        
        return $this->render(
                             "user/userForm.html.twig", 
                             ["form" => $form->createView()]
                            );
    }
    
    /**
     * @Route("/user/created/{userId}", name="user_created")
     */
    public function postUserSuccess($userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
           ->find($userId);
        
        if(!$user)
        {
            throw $this->createNotFoundException("The user with id : ".$userId."you're looking for does not exist");
        }
        
        return $this->render(
                             "user/userCreationSuccess.html.twig", 
                             ["user" => $user]
                            );
    }
}
