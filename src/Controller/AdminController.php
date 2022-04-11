<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/users", name="users_list")
     */
    public function ListOfUsers()
    {
        $users= $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/user.html.twig',array("tabUsers"=>$users));
    }


    /**
     * @Route("/deleteUser/{id}",name="UserDelete")
     */
    public function deleteUser($id)
    {
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        $em= $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("app_admin");
    }


    /**
     * @Route("/updateUser/{id}",name="updateUser")
     */
    public function updateUser(Request $request,$id)
    {
        $user= $this->getDoctrine()->getRepository(User::class)->find($id);
        $form= $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em= $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("users_list");
        }
        return $this->render("admin/updateuser.html.twig",
            array("formUser"=>$form->createView()));
    }



}
