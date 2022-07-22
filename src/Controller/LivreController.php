<?php

namespace App\Controller;

use DateTime;
use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use App\Repository\CategorieRepository;
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
    public function parution(LivreRepository $repo, CategorieRepository $repoCat)
    {
        $livre=$repo->findAll();
        $categories =$repoCat->findAll();
        return $this->render('livre/parutions.html.twig', [
            'livre'=>$livre,
            'categories'=>$categories
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="show")
     */
    public function show($id, LivreRepository $repo)
    {
        $livre=$repo->find($id);
        return $this->render('livre/showOne.html.twig', [
            'livre'=>$livre
        ]);
    }

    /**
     * @Route("/categorie_{id<\d+>}", name="categorie")
     */
    public function categorieLivres($id, CategorieRepository $repo)
    {
        $categorie=$repo->find($id);
        $livres = $categorie->getLivres();
        $categories= $repo->findAll();

        return $this->render('livre/parutions.html.twig', [
            'livres'=>$livres,
            'categories'=>$categories
        ]);
    }


   


}
