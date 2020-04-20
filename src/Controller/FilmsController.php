<?php


namespace App\Controller;

use App\Entity\Film;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmsController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function home () {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/films", methods={"GET"})
     */
    public function index ()
    {
        $films = $this->getDoctrine()
            ->getRepository(Film::class)
            ->findAll();

        return $this->render('films/index.html.twig',
            [
                'films' => $films
            ]);
    }

    /**
     * @Route ("/films/{id}", methods={"GET"})
     */
    public function find (int $id)
    {
        $film = $this->getDoctrine()
            ->getRepository(Film::class)
            ->find($id);

        $sessions = $film->getSessions();


        return $this->render('films/find.html.twig',
            [
                'film' => $film,
                'sessions' => $sessions
            ]);
    }

}