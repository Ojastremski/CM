<?php

namespace CM\ConstructionBundle\Controller;

use CM\ConstructionBundle\Entity\Construction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowDetailsController extends Controller
{
    public function ShowDetailsAction(Construction $construction)
    {
        return $this->render(
            '@Construction/ShowDetails.html.twig', 
            [
                'construction'  => $construction
            ]
        );
    }
}
