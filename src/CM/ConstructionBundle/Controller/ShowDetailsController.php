<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Entity\History;
use CM\ConstructionBundle\Form\EditAssignedEquipmentForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowDetailsController extends Controller
{
    public function ShowDetailsAction(Construction $construction)
    {
        $allocatedEquipments = $this->getDoctrine()->getRepository(Equipment::class)->findBy(
            ['target' => $construction->getId()]
        );

        $forms = [];
        foreach($allocatedEquipments as $eq) {
            $forms[] = $this->createForm(EditAssignedEquipmentForm::class, $eq)->createView();
        }

        return $this->render(
            '@Construction/ShowDetails.html.twig', 
            [
                'forms' => $forms,
                'construction'           => $construction,
                'allocated_equipments'   => $allocatedEquipments
            ]
        );
    }

    public function UpdateAssignedEquipmentAction(Request $request, Equipment $equipment)
    {
        date_default_timezone_set("Europe/Warsaw");
        $oldTarget = $equipment->getTarget();

        $form = $this->createForm(EditAssignedEquipmentForm::class, $equipment);
        $form->handleRequest($request);
    
        $history = new History();
        $history->setMessage("sprzęt został przeniesiony z ".$oldTarget->getConstructionName()
                            ." do ".$equipment->getTarget()->getConstructionName());
        $history->setRecipient($equipment->getRecipient());
        $history->setOwner($equipment->getOwner());
        $history->setDate(new \DateTime());
        $this->getDoctrine()->getManager()->flush();

        $equipment->setAssignmentDate(new \DateTime());
        $equipment->addHistory($history);

        $this->getDoctrine()->getManager()->flush($equipment);

        return $this->redirectToRoute('construction_details', ['id' => $oldTarget->getId()]);
    }
}
