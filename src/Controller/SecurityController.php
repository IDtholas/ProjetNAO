<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 20/03/2018
 * Time: 11:01
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class SecurityController
{
    private $twig;
    private $authenticationUtils;

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/login/", name="login")
     */
    public function login(Request $request)
    {
        $error= $this->authenticationUtils->getLastAuthenticationError();

        $lastUsername = $this->authenticationUtils->getLastUsername();

        return new Response($this->twig->render('security.html.twig', array(
            'last_username'=> $lastUsername,
            'error' => $error,)));

    }

    public function __construct(Environment $twig, AuthenticationUtils $authenticationUtils)
    {
        $this->twig = $twig;
        $this->authenticationUtils = $authenticationUtils;
    }

}