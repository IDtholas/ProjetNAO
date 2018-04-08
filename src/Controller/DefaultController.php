<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Observation;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\ObservationType;
use App\Form\UserType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{

    public function verifEdited($id)
    {
        return $this->render('verifEdited.html.twig');
    }

    public function verifDeleted($id)
    {
        return new Response('A supprimer');
    }


}
