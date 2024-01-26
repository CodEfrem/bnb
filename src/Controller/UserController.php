<?php

namespace App\Controller;

use App\Form\ProfileType;
use App\Service\ProfileService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/complete-profile', name: 'complete_profile')]
    public function index(
        Request $request,
        ProfileService $profileService,
        EntityManagerInterface $em
    ): Response
    {
        $form = $this->createForm(ProfileType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $profileService->updateProfile($form, $this->getUser(), $em);
            
            $this->addFlash('success', 'Your profile has been updated');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

 //Method that configures the fields displayde on the CRUD page and the index page
 public function configureFields(string $pageName): iterable
 {
     return [
         ImageField::new('image','Profile picture')
         ->setBasePath('uploads/users/')
         ->setUploadDir('public/uploads/users/'),
         TextField::new('email','Email address'),
         TextField::new('firstname','FirstName'),
         TextField::new('lastname','LastName'),
         IntegerField::new('birthyear','Birth year'),
     ];
 }

     

    //Method that configures the actions available for this entity (Show, Edit, Delete)
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN')
            ;
    }

    /**
     * User account route for displaying it's own data on the app
     */
    #[Route('/account', name: 'account', methods: ['GET', 'POST'])]
    public function account(
        Request $request,
        EntityManagerInterface $em,
        ProfileService $profileService
    ): Response
    {
        if(!$this->getUser()->getFirstname()) {
            return $this->redirectToRoute('complete_profile');
        }

        $form = $this->createForm(ProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $profileService->updateProfile($form, $this->getUser(), $em);
            $this->addFlash('success', 'Your profile has been updated');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/account.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}