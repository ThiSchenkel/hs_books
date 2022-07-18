<?php

namespace App\Controller;

use DateTime;
use App\Entity\Livre;
use App\Form\LivreType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

    /**
     * @Route("/admin", name="admin_")
     */

class AdminController extends AbstractController
{
     /**
     * @Route("/add", name="ajout_livre")
     */
        public function ajout(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid()){
            $livre->setdateDeCreation ( new DateTime("now"));

            $file = $form->get('photoCouv')->getData();
            $fileName = $slugger->slug($livre->getTitre()) . uniqid() . '.' . $file->guessExtension();

            try{
                $file->move($this->getParameter('photo_livre'), $fileName);
            }catch(FileException $e){
            }
            $livre->setPhotoCouv($fileName);

            $manager=$doctrine->getManager();
            $manager->persist($livre);
            $manager->flush();

             $this->addFlash('success', "La fiche du livre a bien été ajoutée");

            return $this->redirectToRoute('livre_ajout');
        }
        return $this->render('admin/formLivre.html.twig', [
            'formLivre'=>$form->createView()
        ]);
    }
}
