<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 14:02
 */

namespace App\Controller\AdminControllers;


use App\Controller\AdminControllers\Interfaces\UsersManagementControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class UsersManagementController implements UsersManagementControllerInterface
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/administration/users_management/", name="users_management")
     */
    public function usersManagement()
    {
        return new Response($this->twig->render('admin/users_management.html.twig'));
    }

}