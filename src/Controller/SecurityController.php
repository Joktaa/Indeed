<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name=".register")
     */
    public function register(EntityManagerInterface $manager, Request $request): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('email')
            ->add('password')
            ->add('Username')
            ->add('firstName')
            ->add('lastName')
            ->add('Submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user->setRoles(["ROLE_USER"]);
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('indeed/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name=".login")
     */
    public function login(): Response
    {
        return $this->render('indeed/login.html.twig');
    }
    
    /**
     * @Route("/annonces", name=".annonces")
     */
    public function annonces(): Response
    {
        return $this->render('indeed/annonces.html.twig');
    }
}