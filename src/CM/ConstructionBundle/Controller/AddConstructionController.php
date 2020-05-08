<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Entity\History;
use CM\ConstructionBundle\Form\ConstructionForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddConstructionController extends Controller 
{
    public function AddConstructionAction(Request $request)
    {
        $construction = new Construction();
        $construction->setAuthor($this->getUser());

        $form = $this->createForm(ConstructionForm::class, $construction)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            if ($construction->getNote()) {
                $construction->setNoteVisibility(
                    $request->request->get('construction_form')['noteVisibility']
                );
            }
            
            $em->persist($construction);
            $em->flush();

            $this->addFlash('success', 'Objekt został dodany!');

            return $form->get('saveAndCreateNew')->isClicked()  
                ? $this->redirectToRoute('construction_add')
                : $this->redirectToRoute('construction_homepage');
        }

        return $this->render(
            '@Construction/AddConstruction.html.twig', 
            [
                'construction' => $construction,
                'form' => $form->createView()
            ]
        );
    }

    public function DeleteConstructionAction(Request $request)
    {
        date_default_timezone_set("Europe/Warsaw");

        $em = $this->getDoctrine()->getManager();
        
        $construction = $em->getRepository(Construction::class)
            ->find($request->request->get('element_id'));

        $allocatedEquipments = $this->getDoctrine()->getRepository(Equipment::class)->findBy(
                ['target' => $request->request->get('element_id')]
        );

        foreach ($allocatedEquipments as $key => $value){
            $history = new History();
            $history->setMessage("Sprzęt został przeniesiony do magazynu");
            $history->setDate(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            
            $value->setAssignmentDate(new \DateTime());
            $value->setTarget(null);
            $value->setRecipient(null);
            $value->setOwner(null);
            $value->addHistory($history);

            $this->getDoctrine()->getManager()->flush();
        }
        
        $em->remove($construction);
        $em->flush();

        $this->addFlash('success', 'Objekt został usunięty!');

        return $this->redirectToRoute('construction_homepage');
    }
}