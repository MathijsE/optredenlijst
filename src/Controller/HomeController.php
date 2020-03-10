<?php

namespace App\Controller;

use App\Repository\OptredenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(OptredenRepository $optredenRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'optredens' => $optredenRepository->findAll(),
            'datum' => $optredenRepository->findAll()
        ]);
    }
}
