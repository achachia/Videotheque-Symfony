<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends Controller
{
    /**
     * @Route("/video", name="video")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig');
    }
}
