<?php
//src/Controller/programController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actor;
use App\Repository\ActorRepository;

/**
 * @Route("/actor", name="actor_")
 */
class ActorController extends AbstractController
{
    /**
     * Show all rows from Actor's entity
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $actors = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findAll();

        return $this->render(
            'actor/index.html.twig',
            ['actors' => $actors]
        );
    }

    /**
     * Getting a actor by id
     *
     * @Route("/{id}", name="show")
     * @return Response
     */
    public function show(int $actor_id): Response
    {
        $actor = $this->getDoctrine()
            ->getRepository(Actor::class)
            ->findOneBy(['id' => $actor_id]);
        {
        return $this->render('actor/show.html.twig', [
            'actor' => $actor,
        ]);
        }
    }
}