<?php

namespace App\Controller;

use DateTime;
use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


    /**
     * @Route("/livre", name="livre_")
     */

class LivreController extends AbstractController
{
    /**
     * @Route("/", name="parution")
     */
    public function parution(LivreRepository $repo)
    {
        $livre=$repo->findAll();
        return $this->render('livre/parutions.html.twig', [
            'livre'=>$livre
        ]);
    }


   














}
