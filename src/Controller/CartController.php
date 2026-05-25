<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CartItem;
use App\Repository\ProductRepository;
use App\Repository\CartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartRepository $cartRepository): Response
    {
        $cart = $cartRepository->find(1);

        return $this->render('shop/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(int $id, ProductRepository $productRepository, CartRepository $cartRepository, EntityManagerInterface $em): Response
    {
        $product = $productRepository->find($id);

        if (!$product) {
            return $this->redirectToRoute('app_home');
        }

        // Chercher ou créer un panier
        $cart = $cartRepository->find(1);
        if (!$cart) {
            $cart = new Cart();
            $em->persist($cart);
            $em->flush();
        }

        // Ajouter le produit au panier
        $item = new CartItem();
        $item->setQuantity(1);
        $item->setProduct($product);
        $item->setCart($cart);
        $em->persist($item);
        $em->flush();

        return $this->redirectToRoute('app_cart');
    }
}
