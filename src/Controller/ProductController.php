<?php

namespace App\Controller;

use App\classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $entityManager;
   
    public function __construct(EntityManagerInterface $entityManager)
    {
       $this->entityManager=$entityManager;
       
    }
    /**
     * @Route("/nos-products", name="products")
     */
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        
        $search= new Search();
        $form=$this->createForm(SearchType::class,$search);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $products=$productRepository->findWithSearch($search);
        }else{
            $products=$productRepository->findAll();
        }
        
        
        return $this->render('product/index.html.twig',[
            'products' => $products,
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/product/{slug}", name="product")
     */
    public function show($slug,ProductRepository $productRepository): Response
    {
        $product=$productRepository->findOneBy(['slug'=>$slug]);
        if (!$product) {
           return $this->redirectToRoute('products');
        }
        return $this->render('product/show.html.twig',[
            'product' => $product
        ]);
    }

   
}
