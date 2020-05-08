<?php

namespace CM\AccessBundle\Controller;

use CM\AccessBundle\Form\RegistrationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registrationAction(Request $request)
    {
        $form = $this->createForm(RegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();

            $user->setRoles('ROLE_USER');
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Witamy w systemie UWEM !');

            return $this->redirectToRoute('login');
        }

        return $this->render('@Access/registration/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}