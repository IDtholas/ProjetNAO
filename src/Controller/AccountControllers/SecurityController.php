<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 20/03/2018
 * Time: 11:01
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\SecurityControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class SecurityController implements SecurityControllerInterface
{
    private $twig;
    private $authenticationUtils;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/login/", name="login")
     */
    public function login()
    {
        $error= $this->authenticationUtils->getLastAuthenticationError();

        $lastUsername = $this->authenticationUtils->getLastUsername();

        return new Response($this->twig->render('account/security.html.twig', array(
            'last_username'=> $lastUsername,
            'error' => $error,)));

    }

    public function __construct(Environment $twig, AuthenticationUtils $authenticationUtils)
    {
        $this->twig = $twig;
        $this->authenticationUtils = $authenticationUtils;
    }

}