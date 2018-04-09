<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 12:30
 */

namespace App\Controller\VerifObservationsControllers;


use App\Controller\VerifObservationsControllers\Interfaces\VerifValidatedControllerInterface;
use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class VerifValidatedController implements VerifValidatedControllerInterface
{
    private $twig;
    private $entityManager;
    private $urlGenerator;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param $id
     * @return RedirectResponse
     * @Route("/verification/validated/{id}", name="verifValidated")
     * @Security("has_role('ROLE_USER_ADVANCED')")
     */
    public function verifValidated($id)
    {
        $repoObs = $this->entityManager->getRepository(Observation::class);
        $verifiedObs = $repoObs->find($id);


        $verifiedObs->setVerified(1);
        $this->entityManager->flush();

        return new RedirectResponse($this->urlGenerator->generate('verif'));
    }
}