<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 03/04/2018
 * Time: 12:18
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class TestController
{

    public function test(UrlGeneratorInterface $urlGenerator)
    {
        return new RedirectResponse(
            $urlGenerator->generate('index'));
    }
}