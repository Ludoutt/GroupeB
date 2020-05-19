<?php

namespace App\Controller\Front;

use App\Repository\TaskRepository;
use App\Repository\UserStoriesRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SprintController extends AbstractController
{
    private $sprintTasks;
    private $userStories;
    private $users;

    /**
     * @param TaskRepository $taskRepository
     * @param UserStoriesRepository $userStoriesRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        TaskRepository $taskRepository,
        UserStoriesRepository $userStoriesRepository,
        UserRepository $userRepository
    )
    {
        $this->sprintTasks = $taskRepository;
        $this->userStories = $userStoriesRepository;
        $this->users = $userRepository;
    }

    /**
     * @Route("/sprint/backlog", name="sprint_backlog")
     */
    public function backlog()
    {
        return $this->render('front/sprint/backlog/index.html.twig', [
            'sprintTasks' => $this->sprintTasks->findAll(),
            'userStories' => $this->userStories->findAll(),
            'users' => $this->users->findAll(),
        ]);
    }

    /**
     * @Route("/sprint/kanban", name="sprint_kanban")
     */
    public function kanban()
    {
        return $this->render('front/sprint/kanban/index.html.twig', [
            'sprintTasks' => $this->sprintTasks->findAll(),
            'userStories' => $this->userStories->findAll(),
            'users' => $this->users->findAll(),
        ]);
    }
}
