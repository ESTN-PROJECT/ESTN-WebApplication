<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AdminType;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\UtilisateurRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AdminController extends AbstractController
{
    public function __construct(FlashyNotifier $flashy)
    {
        $this->flashy = $flashy;
    }

    /**
     * @Route("/adminadmin", name="app_admin1")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/users", name="users_list")
     * @IsGranted("ROLE_ADMIN")
     */
    public function ListOfUsers(Request $req, PaginatorInterface $pag, UtilisateurRepository $rep)
    {
        $us = $rep->DisplayUsers();

        $users = $rep->DisplayUsers();

        $users = $pag->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            3 // Nombre de résultats par page
        );


        return $this->render('admin/user.html.twig', array("tabUsers" => $users, "all" => $us));
    }


    /**
     * @Route("/deleteUser/{id}",name="UserDelete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function deleteUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $user->setIsDeleted(1);
        //$em->remove($user);
        $em->flush();
        $this->flashy->success('User Banned Successfully', 'http://your-awesome-link.com');
        return $this->redirectToRoute("users_list");
    }


    /**
     * @Route("/updateUser/{id}",name="updateUser")
     * @IsGranted("ROLE_ADMIN")
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("users_list");
        }
        return $this->render("admin/updateuser.html.twig",
            array("formUser" => $form->createView()));
    }




    /**
     * @Route("/adminRegister",name="adminRegister")
     * @IsGranted("ROLE_ADMIN")
     */
    public function adminRegister(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, \Swift_Mailer $mailer): Response
    {
        $user = new User();

        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            // encode the plain password
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $user->setRoles(['ROLE_ADMIN']);
            $user->setIsdeleted(1);

            $entityManager->persist($user);
            $entityManager->flush();



        }

        return $this->render('admin/addAdmin.html.twig', [
            'formAdmin' => $form->createView(),
        ]);
    }


    /**
     * @Route("/sortedUsers",name="sortedUsers")
     * @IsGranted("ROLE_ADMIN")
     */
    public function sortedUsers(Request $req, PaginatorInterface $pag, UtilisateurRepository $rep)
    {
        $us = $rep->findAll();
        $users = $rep->orderById();
        $users = $pag->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            30 // Nombre de résultats par page
        );


        return $this->render('admin/user.html.twig', array("tabUsers" => $users, "all" => $us));
    }


    /**
     * @Route("/Coachs",name="findCoachs")
     * @IsGranted("ROLE_ADMIN")
     */
    public function findCoachs(Request $req, PaginatorInterface $pag, UtilisateurRepository $rep)
    {
        $users = $rep->findCoachs();
        $users = $pag->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            30 // Nombre de résultats par page
        );
        return $this->render('admin/user.html.twig', array("tabUsers" => $users));
    }


    /**
     * @Route("/search",name="search")
     * @IsGranted("ROLE_ADMIN")
     */
    public function search(Request $req, PaginatorInterface $pag, UtilisateurRepository $rep)
    {
        $us = $rep->findAll();
        $data = $req->get('search');
        $users = $rep->findBy(['username' => $data]);
        $users = $pag->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $req->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            30 // Nombre de résultats par page
        );
        return $this->render('admin/user.html.twig', array("tabUsers" => $users, "all" => $us));
    }

}
