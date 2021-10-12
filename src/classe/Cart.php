<?php
namespace App\classe;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    private $entityManager;
    private $session;
   
    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
    {
       $this->entityManager=$entityManager;
       $this->session=$session;
       
    }
    public function add($id)
    {
        $cart=$this->session->get('cart', []);
        if (!empty( $cart[$id])) {
            $cart[$id]++;
        }else{
            $cart[$id]=1;
        }
        $this->session->set('cart',$cart);

    }
    public function get()
    {
        return $this->session->get('cart');
    }
    public function remove()
    {
        return $this->session->remove('cart');
    }


}