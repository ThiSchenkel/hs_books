<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/account/changer-password", name="account_password")
     */
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user= $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();
            // dd($old_pwd);
            if ($userPasswordHasher->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new-password')->getData();
                // dd($new_pwd);
                $password = $userPasswordHasher->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                $entityManager->flush();

                $this->addFlash('success', "Votre mot de passe a bien été mis à jour!");
                return $this->redirectToRoute('account_perso');
            }else{
                $this->addFlash('error', "Ce n'est pas le bon mot de passe actuel!");
            }
         }
        return $this->render('account/password.html.twig', [
            'formChangePwd' => $form->createView()
        ]);
    }





}
