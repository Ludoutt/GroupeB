<?php

namespace App\Controller;

use App\Entity\BacklogProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BacklogController extends AbstractController
{
    /**
     * @Route("/backlog", name="backlog")
     */
    public function index()
    {

        return $this->render('backlog/index.html.twig');
    }

    /**
     * @Route("/new_backlog", name="new_backlog")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newBacklog(Request $request, EntityManagerInterface $manager){
        $backlog = new BacklogProduct();
        $form = $this->createForm(ProjectType::class, $backlog);

        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($backlog);
            $manager->flush();

            $this->addFlash('success', 'Votre backlog a bien été créé');
            return $this->render('backlog/index.html.twig');
        }

        return $this->render('backlog/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
