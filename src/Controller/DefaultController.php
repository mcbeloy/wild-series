<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default/", name="default_index")
     */
    public function index(): Response
    {
        return new Response(
            '<!doctype html><html lang="en"><body>Wild Series Index</body><h1>Welcome</h1></html>'
        );
        return $this->render('path/default/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }
}
