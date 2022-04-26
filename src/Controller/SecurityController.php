<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\CoachFormType;
use App\Form\UserType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class SecurityController extends AbstractController
{


    public function __construct(FlashyNotifier $flashy)
    {
        $this->flashy = $flashy;
    }

    /**
     * @Route("/", name="first_page")
     */
    public function FirstPage(): Response
    {
        return $this->render('security/FirstPage.html.twig');
    }


    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/logged", name="logged_in")
     */
    public function loggedIn(): Response
    {
        return $this->render('security/logged.html.twig');
    }

    /**
     * @Route("/home", name="home")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function home(): Response
    {
        return $this->render('security/home.html.twig');
    }

    /**
     * @Route("/profile", name="profile")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function profile(): Response
    {
        return $this->render('security/profile.html.twig');
    }


    /**
     * @Route("/profile/setting/{id}", name="profile_settings")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function profileSettings(Request $request, $id): Response
    {
        $u = $this->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form2 = $this->createForm(CoachFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        $this->flashy->success('Your profile has been updated successfully', 'http://your-awesome-link.com');
        return $this->render("security/profileSetting.html.twig",
            array("formUser" => $form->createView(),"formCoach" => $form2->createView()));

    }

    /**
     * @Route("/profile/settingCoach/{id}", name="profileCoach_settings")
     * @IsGranted("ROLE_COACH")
     */
    public function profileSettingsCoach(Request $request, $id): Response
    {
        $u = $this->getUser()->getUsername();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(CoachFormType::class, $user);
        $form2 = $this->createForm(CoachFormType::class, $user);

        $form->handleRequest($request);
        if ($form2->isSubmitted() && $form->isSubmitted() ) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        $this->flashy->success('Your profile has been updated successfully', 'http://your-awesome-link.com');
        return $this->render("security/profileSetting.html.twig",
            array("formCoach" => $form->createView(),"formUser" => $form2->createView()));

    }


    /**
     * @Route("/desactivate/{id}",name="desactivate")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function desactivateAccount($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute("app_login");
    }


    /**
     * @Route("/resetPassword",name="resetPassword")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function resetPassword()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $em->flush();
        return $this->render("security/ResetPassword.html.twig");

    }


}
