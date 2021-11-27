<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Comment;
use App\Entity\Video;
use App\Entity\User;
class CommentController extends AbstractController
{
    
 
    //add a comment to the respected video function    

    /**
     * @Route("/comment/add/db", name="adddb") 
     */
    public function addcommentdb(Request $request ){
        if ($this->getUser()){
$id=$request->request->get('idvideo') ; 

        $comment = new Comment();
        $comment->setComments($request->request->get('comment'));
        $comment->setAddedat(new \DateTime(date("Y-m-d H:i:s")));
        $comment->setUser($this->getUser());
        $comment->setVid($this->getDoctrine()->getRepository(Video::class)->find($id));
        $entityManager = $this->getDoctrine()->getManager();
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($comment);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        return  new Response("your comment has been added go back to the show page");
        
        }
}
 //delete a comment for a respected user fuction

    /**
     * @Route("/comments/user/delete/{id}", name="deletecommentactionuser")
     */
    public function deletescommentdb($id )
    {
       if ($this->getUser()){  
        $i= $this->getDoctrine()
        ->getRepository(Comment::class)
        ->find($id)->getUser();
        if($this->getUser()== $i){

        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager ->getRepository(Comment::class)->find($id);
                
        $entityManager->remove($comment);
        $entityManager->flush();
        
        return  new Response("your comment is deleted go back to the show page");}
        else {
            return new Response("you can't delete this comment it's not yours, go back to the show page");
        }}
    }







}
