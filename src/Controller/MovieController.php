<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Runtime\Runner\Symfony\Symfony;

class MovieController extends AbstractController
{
    #[Route('/movies', name: 'app_movie')]
    public function index(MovieRepository $movieRepository)
    {   
        $movies = $movieRepository->findAll();

        return $this->render('index.html.twig');
    }


    #[Route('/movie/{name}', name: 'movie', defaults:['name' => null], methods:['GET','HEAD'])]
    public function movie($name): JsonResponse
    {
        return $this->json([
            'message' => 'Movie Name: '.$name,
            'path' => 'src/Controller/MovieController.php',
        ]);
    }

}
