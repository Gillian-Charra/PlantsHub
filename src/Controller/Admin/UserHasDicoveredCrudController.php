<?php

namespace App\Controller\Admin;

use App\Entity\UserHasDicovered;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserHasDicoveredCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserHasDicovered::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
