<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('password')
                ->setFormType(PasswordType::class),
            BooleanField::new('is_admin'),
            ImageField::new('profile_picture')
                ->setUploadDir('public/images/avatar')
                ->setUploadedFileNamePattern('[year]-[month]-[day]_[slug]_[randomhash].[extension]')
                ->setBasePath('images/avatar')
                ->setRequired(false)
                ->setEmptyData(null)
        ];
    }
}
