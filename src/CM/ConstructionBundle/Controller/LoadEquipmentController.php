<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Form\ParamToEquipmentForm;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

            foreach ($data['checkbox'] as $key => $obj)
            {
                if(isset($data['allCategory']))
                {
                    $message = "kat";
                    $obj->setEquipmentCategory($data['allCategory']);
                }
                if(isset($data['allConstruction']))
                {
                    $message = "con";
                    $obj->setTarget($data['allConstruction']);
                    $obj->setRecipient($data['recipient']);
                    $obj->setAssignmentDate(new \DateTime(date("Y-m-d H:i:s")));
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
            elseif ($message == "kat" && $message == "con")
            {
                $text = "Wybrany sprzęt został przypisany do kategorii "
                        .$data['allCategory']->getCategoryName().
                        "oraz przydzielony do budowy ".$data['allConstruction']->getConstructionName();
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
        return $notes;
    }
}
