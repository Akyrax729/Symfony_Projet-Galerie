<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ContactController extends AbstractController{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from('coucou@test.com')
                ->to('reçoie@coucou.con')
                ->subject('Nouveau message de contact')
                ->text(
                    "Nom: {$data['Nom']}\n".
                    "Email: {$data['Email']}\n\n".
                    "Message:\n{$data['Message']}"
                );
                $mailer->send($email);
        }

        return $this->render('contact/contact.html.twig', [
            'contactform'=>$form->createView(),
        ]);
    }
}
