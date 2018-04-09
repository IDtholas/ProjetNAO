<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/04/2018
 * Time: 17:15
 */

namespace App\Controller\VerifObservationsControllers\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface VerifEditedControllerInterface
{
    public function verifEdited($id, Request $request);

}