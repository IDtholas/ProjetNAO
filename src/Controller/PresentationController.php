<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 11:06
 */

namespace App\Controller;


use App\Controller\Interfaces\PresentationControllerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PresentationController implements PresentationControllerInterface
{

    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/presentation/", name="presentation")
     */
    public function presentation()
    {
        return new Response($this->twig->render('presentation.html.twig'));

    }

    /**
     * PresentationController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
}