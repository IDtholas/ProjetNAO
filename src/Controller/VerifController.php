<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 11:39
 */

namespace App\Controller;


use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class VerifController
{
    private $twig;
    private $entityManager;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/verification/", name="verif")
     * @Security("has_role('ROLE_USER_ADVANCED')")
     */
    public function verif()
    {
        $repoObs = $this->entityManager->getRepository(Observation::class);
        $unverifiedObs = $repoObs->loadUnverifiedObs();
        return new Response($this->twig->render('checking.html.twig',['unverifiedObs' => $unverifiedObs]));

    }

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;

    }

}