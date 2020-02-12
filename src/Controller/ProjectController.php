<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Form\ProjectType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project", name="project")
     */
    public function index()
    {

        return $this->render('project/index.html.twig');
    }

    /**
     * @Route("/new_project", name="new_project")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newProject(Request $request, EntityManagerInterface $manager){
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);

        if($form->isSubmitted() && $form->isValid()){
            $project->getName();
            $project->getDescription();
            $project->getUser();
            $manager->persist($project);
            $manager->flush();

            $this->addFlash('success', 'Votre projet a bien été créé');
            return $this->render('project/index.html.twig');
        }

        return $this->render('project/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
