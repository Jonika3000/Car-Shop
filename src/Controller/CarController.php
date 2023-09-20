<?php

namespace App\Controller;

use App\Entity\Car;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CarController extends AbstractController
{
    #[Route('/show', name: 'app_car')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $cars = $entityManager->getRepository(Car::class)->findAll();
        return new Response($cars);
    }
    #[Route('/create', name: 'app_car')]
    public function createCar(EntityManagerInterface $entityManager): Response
    {
        $car = new Car();
        $car->setColor("black");
        $car->setDescription("sdaasdad");
        $car->setName("Tesla X");
        $car->setImage("image.png");
        $entityManager->persist($car);

        $entityManager->flush();

        return new Response('Saved new product with id '.$car->getId());
    }
}
