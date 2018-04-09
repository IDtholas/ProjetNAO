<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 04/04/2018
 * Time: 16:59
 */

namespace App\Controller\AccountControllers;


use App\Controller\AccountControllers\Interfaces\PersonnalDataControllerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PersonnalDataController implements PersonnalDataControllerInterface
{
    private $twig;

    /**
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @Route("/account/personnal_data", name="personal_data")
     * @Security("has_role('ROLE_USER_BASIC')")
     */
    public function personnalData()
    {
        return new Response($this->twig->render('account/personnal_data.html.twig'));

    }

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;

    }
}