<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 13:46
 */

namespace App\Controller\VerifObservationsControllers;


use App\Controller\VerifObservationsControllers\Interfaces\VerifDeletedControllerInterface;
use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class VerifDeletedController implements VerifDeletedControllerInterface
{
    private $entityManager;
    private $urlGenerator;

    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;

    }

    /**
     * @param $id
     * @return RedirectResponse
     * @Route("/verification/deleted/{id}/", name="verifDeleted")
     * @Security("has_role('ROLE_USER_ADVANCED')")
     */
    public function verifDeleted($id)
    {
        $repoObs = $this->entityManager->getRepository(Observation::class);
        $observation = $repoObs->find($id);

        $this->entityManager->remove($observation);
        $this->entityManager->flush();

        return new RedirectResponse($this->urlGenerator->generate('verif'));

    }

}