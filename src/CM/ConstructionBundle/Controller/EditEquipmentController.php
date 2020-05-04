<?php 

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Equipment;
use CM\ConstructionBundle\Form\EquipmentForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditEquipmentController extends Controller
{
    public function EditEquipmentAction(Request $request, Equipment $equipment)
    {
        $oldVar = $equipment->getTarget()->getId();
        $form = $this->createForm(EquipmentForm::class, $equipment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($equipment->getNote())
            {
                $equipment->setNoteVisibility($request->request->get('equipment_form')['noteVisibility']);
            }
            else
            {
                $equipment->setNoteVisibility(null);
            }

            date_default_timezone_set("Europe/Warsaw");
            $newVar = $equipment->getTarget()->getId();

            if ($newVar != $oldVar)
            {
                $equipment->setAssignmentDate(new \DateTime(date("Y-m-d H:i:s")));
            }

            $equipment->setModifiedAt(new \DateTime(date("Y-m-d H:i:s")));

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Sprzęt został zaktualizowany!');

            return $this->redirectToRoute('equipment_list');
        }

        return $this->render(
            '@Construction/EditEquipment.html.twig', 
            [
            'equipment' => $equipment,
            'form' => $form->createView(),
            ]
        );
    }
}