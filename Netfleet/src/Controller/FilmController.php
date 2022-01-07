<?php

namespace App\Controller;

use App\Entity\Netfleet;
use App\Repository\NetfleetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Validator\Constraints\Date;

class FilmController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }

    /**
     * @Route("/film", name="film")
     */
    public function film(): Response
    {
        return $this->render('film/index.html.twig', [
            'controller_name' => 'FilmController',
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function netfleet(Request $request): JsonResponse
    {

        $data = $request->getContent();

        $entityManager = $this->getDoctrine()->getManager();

        $data= json_decode($data, true);
        var_dump($data);
        $nom = $data['nom'];
        $syn = $data['synopsis'];
        $type = $data['type'];
        $date = new \DateTimeImmutable();

          $film = new Netfleet();
          $film->setNom($nom);
          $film->setSynopsis($syn);
          $film->setType($type);
          $film->setDate($date);



        $entityManager->persist($film);
        $entityManager->flush();

        return new JsonResponse(Response::HTTP_OK);
    }

}
