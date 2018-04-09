<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 05/04/2018
 * Time: 14:02
 */

namespace App\Controller\AdminControllers;


use App\Controller\AdminControllers\Interfaces\CommentsManagementControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class CommentsManagementController implements CommentsManagementControllerInterface
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
     * @Route("/administration/comments_management/", name="comments_management")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function commentsManagement()
    {
        return new Response($this->twig->render('admin/comments_management.html.twig'));
    }
}