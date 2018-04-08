<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 17:12
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdministrationController
{
    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/admin/", name="administration")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function admin()
    {
        return new Response($this->twig->render('administration.html.twig'));
    }

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

}