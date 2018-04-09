<?php
/**
 * Created by PhpStorm.
 * User: alexa
 * Date: 08/04/2018
 * Time: 16:54
 */

namespace App\Controller\ObservationsControllers\Interfaces;


use Symfony\Component\HttpFoundation\Request;

interface AddObservationControllerInterface
{
    public function addObservation(Request $request);

}