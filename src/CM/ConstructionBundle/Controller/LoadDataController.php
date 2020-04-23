<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoadDataController extends Controller
{
    public function loadAction()
    {
        $repository = $this->getDoctrine()->getRepository(Construction::class);
        $constructions = $repository->findAll();

        return $this->render(
            '@Construction/homepage.html.twig', 
            [
                'constructions'  => $constructions
            ]
        );
    }
}
