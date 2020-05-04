<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Equipment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowDetailsController extends Controller
{
    public function ShowDetailsAction(Construction $construction)
    {
        $allocated_equipments = $this->getDoctrine()->getRepository(Equipment::class)->findBy(
            ['target' => $construction->getId()]
        );

        return $this->render(
            '@Construction/ShowDetails.html.twig', 
            [
                'construction'          => $construction,
                'allocated_equipments'   => $allocated_equipments
            ]
        );
    }
}
