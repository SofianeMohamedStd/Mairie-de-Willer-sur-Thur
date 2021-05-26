<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Polls;
use App\Entity\Questions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Plateforme Citoyenne');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Sondage','fas fa-list')->setSubItems([
           MenuItem::linkToCrud('polls','fas fa-list',Polls::class),
           MenuItem::linkToCrud('questions','fas fa-list',Questions::class),
           MenuItem::linkToCrud('Answers','fas fa-list',Answer::class),
        ]);
        yield MenuItem::linktoRoute('Notification', 'fas fa-list','notification_admin');
    }
}
