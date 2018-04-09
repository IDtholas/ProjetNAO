<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 18:57
 */

namespace App\Controller\ObservationsControllers;


use App\Controller\ObservationsControllers\Interfaces\ObservationPageControllerInterface;
use App\Entity\Comment;
use App\Entity\Observation;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Twig\Environment;

class ObservationPageController implements ObservationPageControllerInterface
{
    private $twig;
    private $entityManager;
    private $formFactory;
    private $token;
    private $urlGenerator;

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/observation/{id}", name="observationPage")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function specificObservation($id,Request $request)
{
    $repoObs = $this->entityManager->getRepository(Observation::class);
        $observation = $repoObs->find($id);
        $comments = $observation->getComments();

        $user = $this->token->getToken()->getUser();

        $comment = new Comment();

        $form = $this->formFactory->create( CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $comment->setUser($user);
            $comment->setObservation($observation);
            $comment->setModerate(1);
            $this->entityManager->persist($comment);
            $this->entityManager->flush();

            return new RedirectResponse($this->urlGenerator->generate('observationPage', ['id' => $observation->getID()]));
        }


 return new Response( $this->twig->render ('observations/specificObservation.html.twig', ['observation'=> $observation, 'comments' => $comments, 'form' =>  $form->createView()]));
}

    /**
     * ObservationPageController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     * @param FormFactoryInterface $formFactory
     * @param TokenStorageInterface $token
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory, TokenStorageInterface $token, UrlGeneratorInterface $urlGenerator)
{
    $this->twig = $twig;
    $this->entityManager = $entityManager;
    $this->formFactory = $formFactory;
    $this->token = $token;
    $this->urlGenerator = $urlGenerator;

}

}