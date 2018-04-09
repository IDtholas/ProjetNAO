<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 13:43
 */

namespace App\Controller\VerifObservationsControllers;


use App\Controller\VerifObservationsControllers\Interfaces\VerifEditedControllerInterface;
use App\Entity\Observation;
use App\Form\VerifEditedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

class VerifEditedController implements VerifEditedControllerInterface
{
    private $twig;
    private $entityManager;
    private $formFactory;
    private $urlGenerator;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;

    }

    /**
     * @param $id
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/verification/edited/{id}/", name="verifEdited")
     */
    public function verifEdited($id, Request $request)
    {
        $repo = $this->entityManager->getRepository(Observation::class);
        $observation = $repo->find($id);

        $form = $this->formFactory->create(VerifEditedType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $observation->setProComment($data['proComment']);
            $observation->setVerified(1);
            $observation->setObservationDescription($data['observationDescription']);
            $observation->setSpecies($data['species']);
            $this->entityManager->flush();

            return new RedirectResponse($this->urlGenerator->generate('index'));



        }
        return new Response($this->twig->render('verifObservations/verifEdited.html.twig', ['observation' => $observation, 'form' =>$form->createView()]));
    }
}