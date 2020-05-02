<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Form\EquipmentForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddEquipmentController extends Controller 
{
    public function AddEquipmentAction(Request $request)
    {
        $equipment = new Equipment();
        $equipment->setAuthor($this->getUser());

        $form = $this->createForm(EquipmentForm::class, $equipment)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            if ($equipment->getNote())
            {
                $equipment->setNoteVisibility($request->request->get('equipment_form')['noteVisibility']);
            }

            $em->persist($equipment);
            $em->flush();

            $this->addFlash('success', 'Sprzęt został dodany!');

            if ($form->get('saveAndCreateNew')->isClicked()) 
            {
                return $this->redirectToRoute('equipment_add');
            }

            return $this->redirectToRoute('equipment_list');
        }

        return $this->render(
            '@Construction/AddEquipment.html.twig', 
            [
                'equipment' => $equipment,
                'form' => $form->createView(),
                 
            ]
        );
    }

    public function DeleteEquipmentAction(Request $request)
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('equipment_list');
        }

        $em = $this->getDoctrine()->getManager();
        $equipment = $em->getRepository(Equipment::class)
            ->find($request->request->get('element_id'));
        
        $em->remove($equipment);
        $em->flush();

        $this->addFlash('success', 'Sprzęt został usunięty!');

        return $this->redirectToRoute('equipment_list');
    }
}