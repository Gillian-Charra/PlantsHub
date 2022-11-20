<?php

namespace App\Controller\Admin;

use App\Entity\UserHasDiscovered;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserHasDiscoveredCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserHasDiscovered::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('user'),
            AssociationField::new('plant'),
            TextField::new('longitude'),
            TextField::new('latitude'),
            DateField::new('date'),
            ImageField::new('photo')
                ->setUploadDir('public/images/photo')
                ->setBasePath('images/photo'),
        ];
    }
}
