<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Catégories
        $electronics = new Category();
        $electronics->setName('Electronics');
        $manager->persist($electronics);

        $sports = new Category();
        $sports->setName('Sports');
        $manager->persist($sports);

        // Produits
        $p1 = new Product();
        $p1->setName('Smart Watch');
        $p1->setPrice(99.99);
        $p1->setDescription('Une montre connectée moderne');
        $p1->setCategory($electronics);
        $manager->persist($p1);

        $p2 = new Product();
        $p2->setName('Bluetooth Speaker');
        $p2->setPrice(59.99);
        $p2->setDescription('Enceinte bluetooth portable');
        $p2->setCategory($electronics);
        $manager->persist($p2);

        $p3 = new Product();
        $p3->setName('Yoga Mat');
        $p3->setPrice(29.99);
        $p3->setDescription('Tapis de yoga premium');
        $p3->setCategory($sports);
        $manager->persist($p3);

        $manager->flush();
    }
}
