<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\Contrat;
use App\Entity\TypeContrat;
use App\Repository\OffreRepository;
use DateTimeInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndeedController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function index(OffreRepository $ripo): Response
    {
        $offres = $ripo->findAll();
        return $this->render('indeed/index.html.twig', [
            'offres' => $offres,
        ]);
    }

    /**
     * @Route("/offres/{id}",name="offres.show")
     */
    public function show(Offre $offre, Request $request)
    {
        return $this->render('indeed/show.html.twig', [
            'offre' => $offre
        ]);
    }

    /**
     * @Route("/add",name="offres.add")
     */
    public function add(EntityManagerInterface $manager, Request $request) : Response
    {
        $offre = new Offre();

        $form = $this->createFormBuilder($offre)
            ->add('Title')
            ->add('Description')
            ->add('Adresse')
            ->add('Code_postal')
            ->add('Ville')
            ->add('Date_fin', DateTimeType::class)
            ->add('Contrat', EntityType::class, [
                'class' => Contrat::class
            ])
            ->add('TypeContrat', EntityType::class, [
                'class' => TypeContrat::class
            ])
            ->add('Submit', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $date = new \DateTime();
            $offre->setDateCreation($date);
            $manager->persist($offre);
            $manager->flush();
        }

        return $this->render('indeed/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // detecter la soumission du formulaire
    // faire appel au manager 
    // persister le s données
    // flush

    // handle request
}
