<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 12:11
 */

namespace App\Controller\VerifObservationsControllers;


use App\Controller\VerifObservationsControllers\Interfaces\VerifPageControllerInterface;
use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class VerifPageController implements VerifPageControllerInterface
{
    private $twig;
    private $entityManager;

    /**
     * VerifPageController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @param $id
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/verification/{id}/", name="verifPage")
     * @Security("has_role('ROLE_USER_ADVANCED')")
     */
    public function verifPage($id)
    {
        $repoObs = $this->entityManager->getRepository(Observation::class);
        $observation = $repoObs->find($id);

        return  new Response($this->twig->render('verifObservations/verifPage.html.twig',['observation' => $observation]));

    }

}