<?php

namespace CM\ConstructionBundle\Controller;

use CM\AccessBundle\Entity\User;
use CM\ConstructionBundle\Entity\Construction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowDetailsController extends Controller
{
    public function ShowDetailsAction(Construction $construction)
    {
        $author = $this->getDoctrine()->getRepository(User::class)->find($construction->getAuthor());
        return $this->render(
            '@Construction/ShowDetails.html.twig', 
            [
                'construction'  => $construction,
                'authorName'    => $author->getUsername()
            ]
        );
    }
}
