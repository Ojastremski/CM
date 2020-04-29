<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use CM\ConstructionBundle\Form\ConstructionForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddConstructionController extends Controller 
{
    public function AddConstructionAction(Request $request)
    {
        $construction = new Construction();
        $construction->setAuthor($this->getUser()->getId());

        $form = $this->createForm(ConstructionForm::class, $construction)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            if ($construction->getNote())
            {
                $construction->setNoteVisibility($request->request->get('add_construction_form')['noteVisibility']);
            }

            $em->persist($construction);
            $em->flush();

            $this->addFlash('success', 'Objekt został dodany!');

            if ($form->get('saveAndCreateNew')->isClicked()) 
            {
                return $this->redirectToRoute('construction_add');
            }

            return $this->redirectToRoute('construction_homepage');
        }

        return $this->render(
            '@Construction/AddConstruction.html.twig', 
            [
                'construction' => $construction,
                'form' => $form->createView()
            ]
        );
    }
}