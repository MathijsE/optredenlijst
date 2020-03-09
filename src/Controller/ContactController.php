<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('Contactmail'))
                ->setFrom($contactFormData['email'])
                ->setTo('1011847@mborijnland.nl')
                ->setBody(
                    $contactFormData['bericht'],
                    'text/plain'
                )
            ;

            $mailer->send($message);
            $this->addFlash('success', 'Bedankt. Uw mail is verzonden');
            return $this->redirectToRoute('contact');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}