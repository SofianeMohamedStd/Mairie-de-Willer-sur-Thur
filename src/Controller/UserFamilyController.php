<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserFamilyController extends AbstractInertiaController
{
    #[Route('/family', name: 'user_family')]
    public function index(): Response
    {
        return $this->renderWithInertia('User/Family/AddFamilyMember');
    }
}
