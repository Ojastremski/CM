<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoadCategoryController extends Controller
{
    public function loadAction()
    {   
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        return $this->render(
            '@Construction/CategoryList.html.twig', 
            [
                'categories'  => $categories,
            ]
        );
    }
}
