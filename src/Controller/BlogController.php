<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    private $blogList = array("1" => "blog 1", "2" => "blog 2", "3" => "blog 3");
    private $blogListPage = array(
                                    "1" => array("blog 1", "blog 2", "blog 3"), 
                                    "2" => array("blog 4", "blog 5", "blog 6"), 
                                    "3" => array("blog 7", "blog 8", "blog 9"), 
                                 );
    /**
     * @Route("/blog", name="blog_list" )
     */
    public function blogList()
    {
        return $this->render("blog/index.html.twig", ["blogList" => $this->blogList]);
    }
    
    /**
     * @Route("/blog/{id}", name="blog_specific", requirements={"id"="\d+"})
     */
    public function blogSpecific($id)
    {
        $blog =  $this->blogList[$id];
        return $this->render("blog/blogSpecific.html.twig", ["blog" => $blog]);
    }
    
    /**
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function blogShow($slug) 
    {
        foreach ($this->blogList as $k => $v)
        {
            if($v == $slug)
            {
                $blog=$this->blogList[$k];
                break;
            }
        }
        return $this->render("blog/blogShow.html.twig", ["blog" => $blog]);
    }
    
    /**
     * @Route("/blogPaginated/{page}", name="blog_paginated")
     */
    public function blogPagination($page = 2)
    {
        
    return $this->render("blog/blogPagination.html.twig", ["blogList" => $this->blogListPage, "blogPaginated" => $this->blogListPage[$page]]);
    }
}
