<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Comment;
use App\Entity\Video;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class AdminController extends AbstractController
{
    //show list of users to delete  fuction

    /**
     * @Route("/delete/user", name="deleteuser")
     */ 
    public function showusers()  {  

        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

        $user = $this->getDoctrine()
        ->getRepository(User::class)
        ->findAll();
      
        return  $this->render('admin/members/edit.html.twig',[
        'user' => $user,]);
        }

    }

     //delete a user fuction

    /**
     * @Route("/user/delete/{id}", name="deleteuseraction")
     */
    public function deleteUser($id)
    {

 
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager ->getRepository(User::class)->find($id);
        $entityManager->remove($user);
        $entityManager->flush();}

        return  $this->redirect("/delete/user"); 
    }





     //show list of comments to delete  fuction

    /**
     * @Route("/delete/comments", name="deletecomments")
     */
    public function showcomment()
    {
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){ 

        $comment = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findAll();
    
        return  $this->render('admin/comments/edit.html.twig',[
        'comment' => $comment,]);
        }

    }
     
      //delete a comment fuction

    /**
     * @Route("/comments/delete/{id}", name="deletecommentaction")
     */
    public function deletecomment($id)
    {
        
 
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

            $entityManager = $this->getDoctrine()->getManager();
            $comment = $entityManager ->getRepository(Comment::class)->find($id);
            $entityManager->remove($comment);
            $entityManager->flush();}
           
        return  $this->redirect("/delete/comments"); 
    }


    //show list of videos to delete  fuction 

    /**
     * @Route("/delete/video", name="deletevideo")
     */
    public function showvideos()
    {
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

        $video = $this->getDoctrine()
        ->getRepository(Video::class)
        ->findAll();
      
        return  $this->render('admin/videos/edit.html.twig',[
        'video' => $video,]);
        }

    }

    //delete a video fuction

    /**
     * @Route("/video/delete/{id}", name="deletevideoaction")
     */
    public function deletevideo($id)
    {

 
        if($this->getUser()->getRoles()[0] == "ROLE_ADMIN"){

        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager ->getRepository(Video::class)->find($id);

       // unlink($this->get('kernel')->getProjectDir().'/public/uploads'.$video->getTitle());
        $entityManager->remove($video);
        $entityManager->flush(); 
    }
           
        return  $this->redirect("/delete/video"); 
    }



    //show a form to add a video function

    /**
     * @Route("/video/add", name="addvideo")
     */
    public function addvideo()
    {
        
        if ( $this->getUser()) { if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){

        return $this->render('admin/videos/add.html.twig');}
         
        else{

        return  $this->redirect("/");
        } }
        
    }

    
    //upload a video into application function

     /** 
     * @Route("/video/add/db", name="addvideodb")
     */
    public function addvideodb(Request $request){
        
        if ( $this->getUser()->getRoles()[0] == "ROLE_ADMIN" ){

                    //get pic from http request
                    $Image = $request->files->get('cover'); 
                    $Content = $request->files->get('content'); 
                    //dd($Image);
                      
                    //generate a unique name for pic
                    $picName = uniqid().'-'.$Image->getClientOriginalName();
                      //generate a unique name for pic
                    $vidName = uniqid().'-'.$Content->getClientOriginalName();

                    //move pic to a directory
                    $Image->move(
                            $this->getParameter('covers_directory'),
                            $picName
                        );
                     //move pic to a directory
                     $Content->move(
                        $this->getParameter('videos_directory'),
                        $vidName
                    ); 

                    $video = new Video();
                    $video->setTitle($request->request->get('title'));
                    $video->setDescription($request->request->get('description'));
                    $video->setCover($picName);
                    $video->setContent($vidName);
                    $video->setCategory($request->request->get('category'));
                    $video->setAddedAt(new \DateTime(date("Y-m-d H:i:s")));
                    $video->setModifiedAt(new \DateTime(date("Y-m-d H:i:s")));
                    
                    $entityManager = $this->getDoctrine()->getManager();

                      // tell Doctrine you want to (eventually) save the Product (no queries yet)
                    $entityManager->persist($video);

                    // actually executes the queries (i.e. the INSERT query)
                    $entityManager->flush();
           
                     return new Response("files uploaded");}
                     else
                     {
                     return  $this->redirect("/");
                     }
                     }


}
?>