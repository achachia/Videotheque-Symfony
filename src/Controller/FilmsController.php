<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film;
use App\Form\FilmType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FilmsController extends Controller
{
    /**
     * @Route("/films", name="films")
     */
    public function index()
    {

        

       $films = $this->getDoctrine()->getRepository(Film::class)->findAll();

       if ($this->getUser()) {
       

              var_dump(($this->getUser()->getUsername()));

              var_dump(($this->getUser()->getUsername()));
       }

        return $this->render('films/index.html.twig', [
            'controller_name' => 'FilmsController',
            'user' => $this->getUser(),
            'films' => $films,
        ]);
    }

    public function show($id)
    {

        $film = $this->getDoctrine()->getRepository(Film::class)->find($id);

        return $this->render('films/show_movie.html.twig', [
            'controller_name' => 'ShowFilmController',
            'film' => $film,
        ]);
    	
    }

    public function delete($id)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $film = $this->getDoctrine()->getRepository(Film::class)->find($id);

        $entityManager->remove($film);

        $entityManager->flush();

        return $this->redirectToRoute('listing_films');  // redirection vers la route listing_films
    	
    }

    public function add(Request $request)
    {

        $film = new Film();

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);

       if( $form->isSubmitted() && $form->isValid() ){

        $film->setTitle($film->getTitle());

        $film->setResume($film->getResume());

        $em = $this->getDoctrine()->getManager();

        $em->persist($film);

        $em->flush();

        // var_dump($form->get('title')->getData().$form->get('resume')->getData()) ;

        // var_dump($film->getTitle().$film->getResume()) ;      

       return $this->redirectToRoute('listing_films');

        

       }

        return $this->render('films/add_movie.html.twig', [
            'form' => $form->createView()          
        ]);
    	
    }

    public function edit($id, Request $request)
    {

        $film = $this->getDoctrine()->getRepository(Film::class)->find($id);

        $form = $this->createForm(FilmType::class, $film);

        $form->handleRequest($request);


       if( $form->isSubmitted() && $form->isValid() ){

        $film->setTitle($film->getTitle());

        $film->setResume($film->getResume());

        $em = $this->getDoctrine()->getManager();

        $em->persist($film);

        $em->flush();

        return $this->redirectToRoute('listing_films');

       }

        return $this->render('films/edit_movie.html.twig', [
            'film' => $film,
            'form' => $form->createView()          
        ]);
    	
    }


}
