<?php

namespace App\Controller\Front;

use App\Entity\Project;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index()
    {

        return $this->render('project/new.html.twig');
    }

    /**
     * @Route("/new_project", name="new_project")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newProject(Request $request, EntityManagerInterface $manager){
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $project->setUser($this->getUser());
            $manager->persist($project);
            $manager->flush();

            $this->addFlash('success', 'Votre projet a bien été créé');
            return $this->render('project/new.html.twig');
        }

        return $this->render('project/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
