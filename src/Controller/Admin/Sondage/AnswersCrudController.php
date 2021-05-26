<?php


namespace App\Controller\Admin\Sondage;


use App\Entity\Answer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnswersCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Answer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return
        [
            IdField::new('id', 'ID')->onlyOnIndex(),
            TextField::new('wording'),
            AssociationField::new('questions'),

        ];
    }
}