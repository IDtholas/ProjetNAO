<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 18:52
 */

namespace App\Controller\ObservationsControllers;


use App\Controller\ObservationsControllers\Interfaces\ObservationControllerInterface;
use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ObservationController implements ObservationControllerInterface
{
    private $twig;
    private $entityManager;
    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/observation/", name="observation")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function observation()
    {
        $repo=$this->entityManager->getRepository(Observation::class);
        $listobs= $repo->findAll();
        return new Response($this->twig->render('observations/observations.html.twig',array ('listobs' =>$listobs)));
    }

    /**
     * ObservationController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct( Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

}