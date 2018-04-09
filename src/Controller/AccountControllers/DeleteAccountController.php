<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 17:05
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\DeleteAccountControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DeleteAccountController implements DeleteAccountControllerInterface
{
    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/account/delete_account/", name="delete_account")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function deleteAccount()
    {
        return new Response($this->twig->render('account/delete_account.html.twig'));
    }

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

}