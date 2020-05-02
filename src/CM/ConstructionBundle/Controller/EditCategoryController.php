<?php 

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Category;
use CM\ConstructionBundle\Form\CategoryForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EditCategoryController extends Controller
{
    public function EditCategoryAction(Request $request, Category $category)
    {
        $form = $this->createForm(CategoryForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Kategoria została zaktualizowana!');

            return $this->redirectToRoute('category_list');
        }

        return $this->render(
            '@Construction/EditCategory.html.twig', 
            [
            'category' => $category,
            'form' => $form->createView(),
            ]
        );
    }
}