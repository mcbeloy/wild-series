<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
* @Route("/program", name="program_")
*/

class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

      /**
      * @Route("/{id}", requirements={"id"="\d+"}, name="program_show", methods={"GET"})
      */

    public function show(int $id): Response
{
    return $this->render('program/show.html.twig', ['program_id' => $id]);
}
}
