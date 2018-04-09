<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/04/2018
 * Time: 16:41
 */

namespace App\Controller\AccountControllers\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface SignUpControllerInterface
{
    public function signUp(Request $request);

}