<?php

namespace App\Controller;

use App\Entity\Student;
use App\Entity\classroom;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use App\Repository\classroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/student', name: 'app_student')]
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
        ]);
    }
    
    #[Route('/fetch', name: 'fetch')]
    public function fetch(StudentRepository $repo ) : Response
    {
        $result=$repo->findAll();
        return $this->render('student/test.html.twig', [
            'response' => $result,
        ]);
       
   
    
    }
   


    #[Route('/remove/{id}', name: 'remove')]
    public function remove(ManagerRegistry $mr , $id, StudentRepository $repo ):Response
    {

 $s=new Student();
 $em=$mr->getManager();
 $s = $repo->find($id);
 if (!$s) {
    throw $this->createNotFoundException('Student not found with id: ' . $id);
}
$em->remove($s); 
      $em->flush();
      return $this->redirectToRoute('fetch');


    }

   
 #[Route('/addF', name: 'addF')] 
    public function addF(ManagerRegistry $mr, classroomRepository $repo, Request $req):Response
    {
        
        $s=new student(); //1-instance 
        $form=$this->createForm(StudentType::class,$s);                  //2-creation de forumlaire (studenttype esm el class)
        $form->handleRequest($req);
        if ($form->isSubmitted())
        {
        $em=$mr->getManager();
        $em->persist($s);   //persit + flush
        $em->flush();
        //return new Response('added');
        return $this->redirectToRoute('fetch');
    }
        return $this->render('student/add.html.twig',[
            'f' =>$form->createView()
        ]);

    }

    #[Route('/modify/{id}', name: 'modify')]
    public function modify(ManagerRegistry $mr,classroomRepository $repo,Request $req,$id,StudentRepository $repostudent): Response
    {
        $user = $repostudent->find($id);
        // cette partie est juste poiur fournir une erreur si il n'a pas de user
        if (!$user) {
            throw $this->createNotFoundException(
                'No student found for id '.$id
            );
        }

        $form =$this->createForm(StudentType::class,$user); //on oublie pas le studenttype et le $s               
        $form->handleRequest($req);

        if($form->isSubmitted())
        {

            $em=$mr->getManager();
            $em->persist($user);           // persist 
            $em->flush(); //equivalent a execute
            return $this->redirectToRoute('fetch'); 
        }
            return $this->render('student/index.html.twig',[
                'form'=>$form->createView()
            ]);

        

    }

}
     
   

