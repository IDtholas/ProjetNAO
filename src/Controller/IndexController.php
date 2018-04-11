<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 10:47
 */

namespace App\Controller;


use App\Controller\Interfaces\IndexControllerInterface;
use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class IndexController implements IndexControllerInterface
{
    private $twig;
    private $entityManager;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/", name="index")
     */
    public function index()
    {
        $repo = $this->entityManager->getRepository(Observation::class);
        $observations = $repo->findAll();
        return new Response(
       $this->twig->render('index.html.twig',['observations' => $observations])
        );
    }

    /**
     * IndexController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;

    }


}