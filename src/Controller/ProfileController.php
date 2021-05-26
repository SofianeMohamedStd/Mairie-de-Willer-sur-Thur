<?php


namespace App\Controller;


use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractInertiaController
{

    /**
     * @return Response
     */
    #[Route('/profile', name: 'profile')]
    public function profile(): Response
    {
        $user = $this->getUser();
        return $this->renderWithInertia('Profile', ['prop' => $user]);
    }

    /**
     * @return Response
     */
    #[Route('/editEmail', name: 'page_edit_email')]
    public function PageEditEmail(): Response
    {
        $user = $this->getUser();
        return $this->renderWithInertia('EditEmail',['prop'=>$user]);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param EmailVerifier $emailVerifier
     * @return RedirectResponse
     */
    #[Route('/confirmEditEmail', name: 'edit_email')]
    public function editEmail(Request $request, EntityManagerInterface $em,EmailVerifier $emailVerifier): RedirectResponse
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        dd($data);
        $user = $this->getUser();

        $user->setEmail($data['email']);
        $user->setIsVerified(false);
        $em->persist($user);
        $em->flush();

        $emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('ne-pas-repondre@willersurthur.fr', 'Mairie de Willer-sur-Thur'))
                ->to($user->getEmail())
                ->replyTo('mairie@willersurthur.fr')
                ->subject('Vérifiez votre adresse email')
                ->htmlTemplate('email/confirmation_email.html.twig')
        );
        return $this->redirectToRoute('profile');

    }

    /**
     * @param InertiaInterface $inertia
     * @return Response
     */
    #[Route('/editPassword', name: 'page_edit_password')]
    public function PageEditPassword(InertiaInterface $inertia): Response
    {
        $user = $this->getUser();
        return $this->renderWithInertia('EditPassword',['prop'=>$user]);
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param EntityManagerInterface $em
     * @param MailerInterface $mailer
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     */
    #[Route('/confirmEditPassword', name: 'edit_password')]
    public function editPassword(Request $request,UserPasswordEncoderInterface $passwordEncoder,
                                 EntityManagerInterface $em,MailerInterface $mailer): RedirectResponse
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        //dd($data);
        $user = $this->getUser();
        $encodedPassword = $passwordEncoder->encodePassword(
            $user,
            $data['passwordOne']
        );
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $email = (new TemplatedEmail())
            ->from(new Address('ne-pas-repondre@willersurthur.fr', 'Mairie de Willer-sur-Thur'))
            ->to($user->getEmail())
            ->replyTo('mairie@willersurthur.fr')
            ->subject('Votre demande de changement de mot de passe')
            ->htmlTemplate('email/email_reset_password_done.html.twig');

        $mailer->send($email);

        return $this->redirectToRoute('profile');
    }


}
