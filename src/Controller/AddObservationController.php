<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 10:40
 */

namespace App\Controller;


use App\Entity\Observation;
use App\Form\ObservationType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class AddObservationController
{

    private $twig;
    private $tokenStorage;
    private $entityManager;
    private $container;
    private $formFactory;
    private $urlGenerator;

    /**
     * @param Request $request
     * @return string|RedirectResponse
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/observation/add/", name="addObservation")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function addObservation(Request $request)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $observation = new Observation();
        $form=$this->formFactory->create(ObservationType::class, $observation);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid())
        {
            $picture = $observation->getPicture();
            $pictureName = $this->generateUniqueFileName().'.'.$picture->guessExtension();
            $picture->move(
                $this->container->getParameter('pictures_directory'),
                $pictureName
            );

            $observation->setPicture($pictureName);


            $observation->setVerified(0);
            $observation->setUser($user);
            $this->entityManager->persist($observation);
            $this->entityManager->flush();

            return new RedirectResponse($this->urlGenerator->generate('index'));
        }
        return new Response($this->twig->render('addObservation.html.twig',array('form' => $form->createView(),'observation' => $observation)));

    }

    public function __construct(Environment $twig, TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager, ContainerInterface $container, FormFactoryInterface $formFactory, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $twig;
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->formFactory = $formFactory;
        $this->urlGenerator = $urlGenerator;

    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}