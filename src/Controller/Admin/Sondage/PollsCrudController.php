<?php


namespace App\Controller\Admin\Sondage;


use App\Entity\Polls;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PollsCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Polls::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return
        [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('title'),
            DateTimeField::new('createdDate'),
            DateTimeField::new('publishedDate'),
            DateTimeField::new('finishedDate'),
            DateTimeField::new('answerPublishedDate'),
            CollectionField::new('questions')

        ];
    }
}