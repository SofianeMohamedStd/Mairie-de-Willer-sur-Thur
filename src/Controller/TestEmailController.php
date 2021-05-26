<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;
use Symfony\Component\Routing\Annotation\Route;

class TestEmailController extends AbstractController
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Route('/test/email/confirm', name: 'test_email')]
    public function index(): Response
    {
        // generate a signed url and email it to the user

        $message = (new TemplatedEmail())
            ->from(new Address('ne-pas-repondre@willersurthur.fr', 'Mairie de Willer-sur-Thur'))
            ->to('pipo@gmail.com')
            ->subject('Demande de confirmation d\'email')
            ->replyTo('mairie@willersurthur.fr')
            ->htmlTemplate('email/confirmation_email_test.html.twig');

        $this->mailer->send($message);

        // do anything else you need here, like send an email
        return new Response(null);
    }
}
