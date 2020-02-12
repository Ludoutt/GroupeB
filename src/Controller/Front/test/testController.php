<?php

namespace App\Controller\Front\test;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController
{
    /**
     * @Route("front/test/test/", name="front_test_test")
     */
    public function index()
    {
        return $this->render('front/test/test/index.html.twig', [
            'controller_name' => 'testController',
        ]);
    }
}
