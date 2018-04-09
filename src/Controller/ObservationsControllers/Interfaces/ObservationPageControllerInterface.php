<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/04/2018
 * Time: 16:56
 */

namespace App\Controller\ObservationsControllers\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface ObservationPageControllerInterface
{
    public function specificObservation($id, Request $request);

}