<?php

namespace App\Controller\Front;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SprintController extends AbstractController
{
    private $sprintTasks;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->sprintTasks = $taskRepository;
    }

    /**
     * @Route("/sprint/backlog", name="sprint_backlog")
     */
    public function backlog()
    {
        return $this->render('front/sprint/backlog/index.html.twig', [
            'sprintTasks' => $this->sprintTasks->findAll(),
        ]);
    }

    /**
     * @Route("/sprint/kanban", name="sprint_kanban")
     */
    public function kanban()
    {
        return $this->render('front/sprint/kanban/index.html.twig', [
            'sprintTasks' => $this->sprintTasks->findAll(),
        ]);
    }
}
