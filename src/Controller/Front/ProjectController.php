<?php

namespace App\Controller\Front;

use App\Entity\Project;
use App\Entity\User;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    private $repoProjects;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $projectRepository
     */
    public function __construct(ProjectRepository $projectRepository)
    {
        $this->repoProjects = $projectRepository;
    }

    /**
     * @Route("/project", name="project")
     */
    public function index()
    {

        return $this->render('project/index.html.twig', [
            'projects' => $this->repoProjects->findBy([
                'createdBy' => $this->getUser()
            ])
        ]);
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
            return $this->redirectToRoute('project');
        }

        return $this->render('project/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/edit_project/{id}", name="edit_project")
     * @param Project $project
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function editProject(Project $project,Request $request, EntityManagerInterface $manager){

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($project);
            $manager->flush();

            $this->addFlash('success', 'Votre projet a bien été modifié');
            return $this->redirectToRoute('project');
        }

        return $this->render('project/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
