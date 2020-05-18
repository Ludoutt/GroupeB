<?php

namespace App\Controller;

use App\Entity\BacklogProduct;
use App\Form\BacklogType;
use App\Repository\BacklogProductRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class BacklogController extends AbstractController
{


    private $repoBacklog;

    /**
     * ProjectController constructor.
     * @param BacklogProductRepository $backlogProductRepository
     */
    public function __construct(BacklogProductRepository $backlogProductRepository)
    {
        $this->repoBacklog = $backlogProductRepository;
    }

    /**
     * @Route("/backlog", name="backlog")
     */
    public function index()
    {

        return $this->render('backlog/index.html.twig',[
            'projects' => $this->repoBacklog->findAll()
        ]);
    }

    /**
     * @Route("/new_backlog", name="new_backlog")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param ProjectRepository $projectRepository
     * @return Response
     * @throws \Exception
     */
    public function newBacklog(Request $request, EntityManagerInterface $manager, ProjectRepository $projectRepository){
        $projectId = $request->query->get('id');
        $project = $projectRepository->find($projectId);
        $backlog = new BacklogProduct();
        $form = $this->createForm(BacklogType::class, $backlog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $backlog->setProject($project);
            $backlog->setCreatedAt(new \DateTime());
            $manager->persist($backlog);
            $manager->flush();
        }

        return $this->render('backlog/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
