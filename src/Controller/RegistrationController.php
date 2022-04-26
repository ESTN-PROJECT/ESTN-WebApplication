<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Security\EmailVerifier as EmailVerifierAlias;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{


    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $userPasswordEncoder, GuardAuthenticatorHandler $guardHandler, UserAuthenticator $authenticator, EntityManagerInterface $entityManager, \Swift_Mailer $mailer): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $role_member = ["ROLE_MEMBER"];
        if ($form->isSubmitted() && $form->isValid()) {
            //nabathou l mail



            // encode the plain password
            $user->setPassword(
                $userPasswordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );


            $user->setRoles($form->get('roles')->getData());
            $user->setIsdeleted(0);
            //tzid lenna set roles -> role_member
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $message = (new \Swift_Message('Nouveau contact'))
                // On attribue l'expéditeur
                ->setFrom('estn2022@gmail.com')
                // On attribue le destinataire
                ->setTo($user->getEmail())
                // On crée le texte avec la vue
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'emails/contact.html.twig'
                    ),
                    'text/html'
                );
            $mailer->send($message);
            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi
            //abaath mail verification
            // generate a signed url and email it to the user
            /*
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('mlmines24@gmail.com', '295540nn45'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')

            );
            */
            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/verify/email", name="app_verify_email")
     */
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
