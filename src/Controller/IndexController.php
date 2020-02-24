<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(\Swift_Mailer $mailer, Request $request): Response
    {
        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('dev@lemon-project.com')
                ->setTo('dev@lemon-project.com')
                ->setBody(
                    $this->renderView(
                        'email/registration.html.twig',
                        ['account' => $account]
                    ),
                    'text/html'
                )
            ;

            $mailer->send($message);

            return $this->redirectToRoute('success', [
                'account' => $account,
            ]);
        }

        return $this->render('index/index.html.twig', [
            'account' => $account,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/success", name="success")
     */
    public function success(Request $request): Response
    {
        return $this->render('index/success.html.twig');
    }

}
