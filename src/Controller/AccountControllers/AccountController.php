<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 18:44
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\AccountControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class AccountController implements AccountControllerInterface
{
    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/account/", name ="account")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function account()
    {
        return new Response($this->twig->render('account/account.html.twig'));
    }


    /**
     * AccountController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}