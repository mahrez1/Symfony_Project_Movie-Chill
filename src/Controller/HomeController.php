<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Video;
class HomeController extends AbstractController
{

    //show the home page of the application function

    /**
     * @Route("/", name="welcome")
     */
    public function index()
    {

        return $this->render('home/index.html.twig');
   
    }
    
        
   
        
       
    
}
?>