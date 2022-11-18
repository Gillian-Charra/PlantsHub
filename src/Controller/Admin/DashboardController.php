<?php

namespace App\Controller\Admin;

use App\Entity\Element;
use App\Entity\Plant;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\UserHasDicovered;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url= $this->adminUrlGenerator
            ->setController(PlantCrudController::class)
            ->generateUrl();
        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cherche Et Trouve');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Plantes');
        yield MenuItem::subMenu('Plantes','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Afficher Plantes','fas fa-eye',Plant::class),
            MenuItem::linkToCrud('Ajouter Plantes','fas fa-plus',Plant::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::section('Description');
        yield MenuItem::subMenu('Elements','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Afficher les elements','fas fa-eye',Element::class),
            MenuItem::linkToCrud('Ajouter element','fas fa-plus',Element::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Types','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Afficher les types','fas fa-eye',Type::class),
            MenuItem::linkToCrud('Ajouter un type','fas fa-plus',Type::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::subMenu('Utilisateurs','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Afficher les utilisateurs','fas fa-eye',User::class),
            MenuItem::linkToCrud('Ajouter un utilisateurs','fas fa-plus',User::class)->setAction(Crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Découvertes des utilisateurs','fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Afficher les photos','fas fa-eye',UserHasDicovered::class),
        ]);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}