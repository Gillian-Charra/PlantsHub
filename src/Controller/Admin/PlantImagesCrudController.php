<?php

namespace App\Controller\Admin;

use App\Entity\PlantImages;
use App\Repository\PlantImagesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlantImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PlantImages::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('plant'),
            ImageField::new('image')
                ->setUploadDir('public/images/plant_images')
                ->setUploadedFileNamePattern('[slug]_[randomhash].[extension]')
                ->setBasePath('images/plant_images'),
        ];
    }
}
