<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Video;
use App\Entity\User;
use App\Entity\Basket;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;



class VideoController extends AbstractController
{
    //show a list of videos fuction

    /**
     * @Route("/list", name="videos")
     */
    public function index()
    {
        $video = $this->getDoctrine()
        ->getRepository(Video::class) 
        ->findAll();
        if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
         return  $this->render('admin/videos/list.html.twig',[
        'video' => $video, ]);}

        else{
        return  $this->render('member/videos/list.html.twig',[
        'video' => $video,]);
        }
        }

    //show a video fuction

    /**
     * @Route("/video/{id}/show", name="showvideo")
     */
    public function show($id){
        $video = $this->getDoctrine()
        ->getRepository(Video::class)
        ->find($id);
//dd($video->getComments()[0]);
        if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
        return  $this->render('admin/videos/show.html.twig',[
        'video' => $video, ]);} 

         else{
        return  $this->render('member/videos/show.html.twig',[
        'video' => $video, ]);
                        }
                        }

    //search a video fuction

     /**
     * @Route("/search", name="search")
     */
    public function search(Request $request ) {

      
       $title = $request->request->get('title') ;
      // dd($title);
     $em=$this->getDoctrine()->getManager() ;
   $sql= "SELECT `*` FROM `video` WHERE `title`LIKE '%$title%'" ;
  $result=$em->getConnection()->prepare($sql) ;
  $result->execute() ;
  $donnees=$result->fetchAll() ;
        
         

      if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
        return  $this->render('admin/videos/search.html.twig',[
        'donnees' => $donnees, ]);} 

         else{
       return  $this->render('member/videos/search.html.twig',[
        'donnees' => $donnees, ]);
                        } //return new Response($title) ;
                      
                    }


                    
     /**
     * @Route("/category", name="category") 
     */
    public function category(Request $request ) {

      
      $category = $request->request->get('category') ;
     // dd($title);
    $em=$this->getDoctrine()->getManager() ;
  $sql= "SELECT `*` FROM `video` WHERE `category` LIKE '%$category%'" ;
 $result=$em->getConnection()->prepare($sql) ;
 $result->execute() ;
 $donnees=$result->fetchAll() ;
       
        

     if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN"){
       return  $this->render('admin/videos/category.html.twig',[
       'donnees' => $donnees, ]);} 
 
        else{
      return  $this->render('member/videos/category.html.twig',[
       'donnees' => $donnees, ]);
                       } //return new Response($title) ;
                     
                   }





//add video to basket

    /**
     * @Route("/add/basket/{id}", name="addbasket") 
     */

    public function addbasket($id){

      
      if ( $this->getUser() )
     { $title = $this->getDoctrine()
      ->getRepository(Video::class)
      ->find($id)->getTitle();
      $description = $this->getDoctrine()
      ->getRepository(Video::class)
      ->find($id)->getDescription();
      $cover = $this->getDoctrine()
      ->getRepository(Video::class)
      ->find($id)->getCover();
      $content = $this->getDoctrine()
      ->getRepository(Video::class)
      ->find($id)->getContent();
      $v = $this->getDoctrine()
      ->getRepository(Video::class)
      ->find($id);
      
      
              $basket = new Basket();
            
              $basket->setTitle($title);
              $basket->setAddedat(new \DateTime(date("Y-m-d H:i:s")));
              $basket->setUser($this->getUser());
              $basket->setDescription($description);
              $basket->setCover($cover);
              $basket->setContent($content);
              $basket->setVideo($v);
             
              $entityManager = $this->getDoctrine()->getManager();
              // tell Doctrine you want to (eventually) save the Product (no queries yet)
              $entityManager->persist($basket);
              
              // actually executes the queries (i.e. the INSERT query)
              $entityManager->flush();
              return new Response("the movie is added to your basket") ;
                }
  
      }
        //show a list of videos fuction

    /**
     * @Route("/basket/video", name="basketvidtab")
     */
    public function basketvideo()
      {
      $a=$this->getUser()->getId() ;
      
      
      $em=$this->getDoctrine()->getManager() ;
      $sql= "SELECT`*`FROM `basket` WHERE `user_id` LIKE '%$a%' ";
     
     $result=$em->getConnection()->prepare($sql) ;
     $result->execute() ;
     $basket=$result->fetchAll() ;
     if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){return  $this->render('admin/videos/basket.html.twig',[
      'basket' => $basket,]) ; }
     else{
      return  $this->render('member/basket/basket.html.twig',[
        'basket' => $basket,]) ; 
     }
     
      }  


  
/**
     * @Route("/basket/delete/{id}", name="deletebasketvideo")
     */
    public function deletebasketvideo($id)
    {

      $entityManager = $this->getDoctrine()->getManager();
      $video = $entityManager ->getRepository(Video::class)->find($id)->getId();
   
      $em=$this->getDoctrine()->getManager() ;
      $sql= "DELETE FROM `basket` WHERE `video_id` LIKE '%$video%' ";
     
     $result=$em->getConnection()->prepare($sql) ;
     $result->execute() ;
    
        return  new Response("video deleted from basket") ;
    }


      
    }




