<?php

namespace App\Controller;


use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractInertiaController
{
    /**
     * @return Response
     */
    #[Route('', name: 'home')]
    public function index(): Response {
        //redirect to login
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {
            return $this->redirectToRoute('app_login');
        }

        return $this->renderWithInertia(
            'Dashboard/Home',
            [
                'prop' => 'propValue'
            ]
        );
    }

    /**
     * @Route("/form", name="form")
     * @param InertiaInterface $inertia
     * @return Response
     */
    public function form(InertiaInterface $inertia): Response
    {
        return $inertia->render('Form', ['prop' => 'propValue']);
    }
}
