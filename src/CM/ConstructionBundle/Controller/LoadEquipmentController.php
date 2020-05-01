<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Equipment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoadEquipmentController extends Controller
{
    public function loadAction()
    {   
        $repository = $this->getDoctrine()->getRepository(Equipment::class);
        $equipments = $repository->findAll();

        return $this->render(
            '@Construction/EquipmentList.html.twig', 
            [
                'equipments'  => $equipments,
                'notes'       => $this->prepareNotes($equipments)
            ]
        );
    }

    public function prepareNotes($equipments)
    {
        $notes = array();
        foreach ($equipments as $equipment) 
        {
            if ($equipment->getNoteVisibility() == "main")
            {
                array_push($notes,$equipment->getNote());
            }
        }
        return $notes;
    }
}
