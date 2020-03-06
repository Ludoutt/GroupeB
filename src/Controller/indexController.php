<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class indexController extends AbstractController
{
    /**
     * @Route("/", name="home_page")
     */
    public function indexAction()
    {
        return $this->render("index/home.html.twig");
    }
}
