<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Category;
use CM\ConstructionBundle\Form\CategoryForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddCategoryController extends Controller 
{
    public function AddCategoryAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(CategoryForm::class, $category)
            ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            $this->addFlash('success', 'Kategoria została dodana!');

            if ($form->get('saveAndCreateNew')->isClicked()) 
            {
                return $this->redirectToRoute('category_add');
            }

            return $this->redirectToRoute('category_list');
        }

        return $this->render(
            '@Construction/AddCategory.html.twig', 
            [
                'category' => $category,
                'form' => $form->createView(),
                 
            ]
        );
    }
    public function DeleteCategoryAction(Request $request)
    {
        if (!$this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            return $this->redirectToRoute('category_list');
        }

        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)
            ->find($request->request->get('element_id'));
        
        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'Kategoria została usunięta!');

        return $this->redirectToRoute('category_list');
    }
}