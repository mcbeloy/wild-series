<?php
//src/Controller/programController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    /**
     * The controller for the program add form
     *
     * Display the form or deal with it
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Program Object
            $entityManager->persist($program);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('program_index');
        }
        // Render the form
        return $this->render('program/new.html.twig', ["form" => $form->createView()]);
    }

    /**
     * Getting a program by id
     *
     * @Route("/{program_id}", name="show")
     * @return Response
     */
    public function show(int $program_id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $program_id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program_id . ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    /**
     * @Route("/{program_id}/seasons/{season_id}", name= "season_show")
     */
    public function showSeason(int $program_id, int $season_id, ProgramRepository $programRepository, SeasonRepository $seasonRepository)
    {
        $program = $programRepository->find($program_id);
        $season = $seasonRepository->find($season_id);
        if ($program === null || $season === null) {
            throw $this->createNotFoundException(
                'This program does not exist'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'season' => $season,
            'program' => $program,
        ]);
    }
}
