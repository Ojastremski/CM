<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Entity\History;
use CM\ConstructionBundle\Form\ParamToEquipmentForm;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Twig\Node\Expression\Binary\EqualBinary;

class LoadEquipmentController extends Controller
{
    public function loadAction(Request $request)
    {   
        $repository = $this->getDoctrine()->getRepository(Equipment::class);
        $equipments = $repository->findAll();

        $form = $this->createForm(ParamToEquipmentForm::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid())
        {
            date_default_timezone_set("Europe/Warsaw");
            $message = "";
            $data = $form->getData();
            
            foreach ($data['checkbox'] as $key => $obj) {
                if (isset($data['allCategory'])) {
                    $message = "kat";
                    $obj->setEquipmentCategory($data['allCategory']);
                    $history_note = "Zmiana kategorii na ".$data['allCategory']->getCategoryName();
                }
                if(isset($data['allConstruction']))
                {
                    $message = "con";
                    $obj->setRecipient($data['recipient']);
                    $obj->setOwner($data['owner']);
                    $obj->setAssignmentDate(new \DateTime());
                    if ($obj->getTarget()) {
                        $history_note = "Sprzęt został przeniesiony z "
                            .$obj->getTarget()->getConstructionName()
                            ." do ".$data['allConstruction']->getConstructionName();
                    } else {
                        $history_note = "Sprzęt został przydzielony do "
                            .$data['allConstruction']->getConstructionName();
                    }

                    $obj->setTarget($data['allConstruction']);

                    $history = new History();
                    $history->setMessage($history_note);
                    $history->setRecipient($data['recipient']);
                    $history->setOwner($data['owner']);
                    $history->setDate(new \DateTime());
                    $this->getDoctrine()->getManager()->flush();
                    
                    $obj->addHistory($history);
                }
                if(!$data['allCategory'] && !$data['allConstruction']){
                    $obj->setTarget(null);
                    $obj->setOwner($obj->getRecipient());
                    $obj->setRecipient(null);
                    $obj->setAssignmentDate(new \DateTime());

                    $history = new History();
                    $text = "Sprzęt został przeniesiony do magazynu";
                    $history->setMessage($text);
                    $history->setOwner($obj->getOwner());
                    $history->setDate(new \DateTime());
                    $this->getDoctrine()->getManager()->flush();
                    
                    $obj->addHistory($history);
                } 
                $this->getDoctrine()->getManager()->flush();
            }
            if ($message == "kat")
            {
                $text = "Wybrany sprzęt został przypisany do kategorii "
                        .$data['allCategory']->getCategoryName();
            }
            elseif ($message == "con")
            {
                $text = "Wybrany sprzęt został przydzielony do budowy "
                        .$data['allConstruction']->getConstructionName();
            }
            else
            {
                $text = "Sprzęt został przeniesiony do magazynu";
            }

            $this->addFlash('success', $text);

            return $this->redirectToRoute('equipment_list');
        }

        return $this->render(
            '@Construction/EquipmentList.html.twig', 
            [
                'form'        => $form->createView(),
                'equipments'  => $equipments,
                'notes'       => $this->prepareNotesAction($equipments)
            ]
        );
    }

    public function prepareNotesAction($equipments)
    {
        $notes = array();
        foreach ($equipments as $key => $equipment) 
        {
            if ($equipment->getNoteVisibility() == "main")
            {
                $notes[$key]['subject'] = $equipment->getEquipmentName();
                $notes[$key]['text'] = $equipment->getNote();
            }
        }
        return array_slice($notes, 0, 3);
    }

    public function equipmentDetailsAction(Equipment $equipment)
    {
        return $this->render(
            '@Construction/EquipmentDetails.html.twig', 
            [
                'equipment' => $equipment
            ]
        ); 
    }
}
