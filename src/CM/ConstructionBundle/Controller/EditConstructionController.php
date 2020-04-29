<?php 

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Form\ConstructionForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditConstructionController extends Controller
{
    public function EditConstructionAction(Request $request, Construction $construction)
    {
        $form = $this->createForm(ConstructionForm::class, $construction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($construction->getNote())
            {
                $construction->setNoteVisibility($request->request->get('construction_form')['noteVisibility']);
            }
            else
            {
                $construction->setNoteVisibility(null);
            }
            
            date_default_timezone_set("Europe/Warsaw");
            $construction->setModifiedAt(new \DateTime(date("Y-m-d H:i:s")));

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Objekt został zaktualizowany!');

            return $this->redirectToRoute('construction_homepage');
        }

        return $this->render(
            '@Construction/EditConstruction.html.twig', 
            [
            'construction' => $construction,
            'form' => $form->createView(),
            ]
        );
    }
}