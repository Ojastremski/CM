<?php

namespace CM\AccessBundle\Controller;

use CM\AccessBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AccessController extends Controller
{
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class, [
            '_username'=> $lastUsername
        ]);

        return $this->render(
            '@Access/login/login.html.twig', 
            [
                'form' => $form->createView(),
                'error'         => $error,
            ]
        );
    }

    public function logoutAction() {
        throw new \Exception('this should not be reached!');
    }
}
