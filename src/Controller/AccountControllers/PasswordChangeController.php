<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 17:02
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\PasswordChangeControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PasswordChangeController implements PasswordChangeControllerInterface
{
    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/account/password_change/", name="password_change")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function passwordChange()
    {
        return new Response($this->twig->render('account/passwordChange.html.twig'));
    }

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;

    }
}