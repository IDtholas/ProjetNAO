<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 13:36
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\SignUpControllerInterface;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Twig\Environment;

class SignUpController implements SignUpControllerInterface
{
    private $twig;
    private $userPasswordEncoder;
    private $formFactory;
    private $entityManager;
    private $containerInterface;
    private $urlGenerator;

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/sign-up/", name="sign-up")
     */
    public function signUp(Request $request)
    {
        $user = new User();
        $form=$this->formFactory->create(UserType::class,$user);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid())
        {
            $proof = $user->getProof();
            $proofName = $this->generateUniqueFileName().'.'.$proof->guessExtension();
            $proof->move(
                $this->containerInterface->getParameter('proof_directory'),
                $proofName
            );

            $user->setProof($proofName);

            $password = $this->userPasswordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->urlGenerator->generate('index'));
        }

        return new Response($this->twig->render('account/signup.html.twig',array('form' => $form->createView(),'user' => $user)));
    }


    /**
     * SignUpController constructor.
     * @param Environment $environment
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param FormFactoryInterface $formBuilder
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $containerAware
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(Environment $environment, UserPasswordEncoderInterface $passwordEncoder, FormFactoryInterface $formBuilder, EntityManagerInterface $entityManager, ContainerInterface $containerAware, UrlGeneratorInterface $urlGenerator)
    {
        $this->twig = $environment;
        $this->userPasswordEncoder = $passwordEncoder;
        $this->formFactory = $formBuilder;
        $this->entityManager = $entityManager;
        $this->containerInterface = $containerAware;
        $this->urlGenerator = $urlGenerator;

    }

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

}