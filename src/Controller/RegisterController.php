<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{
    private $entityManager;
    private $hash;
    public function __construct(EntityManagerInterface $entityManager,UserPasswordHasherInterface $hash)
    {
       $this->entityManager=$entityManager;
       $this->hash=$hash;
    }
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request): Response
    {
        $user=new User();
        $form=$this->createForm(RegisterType::class,$user);

        $form=$form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $user=$form->getData();
            $user->setPassword($this->hash->hashPassword($user, $user->getPassword()));
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
        return $this->render('register/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
