<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
     * @Route("/account", name="account_")
     */

class AccountController extends AbstractController
{
    /**
     * @Route("/", name="perso")
     */
    public function index(): Response
    {
        return $this->render('account/account.html.twig');
    }

}
