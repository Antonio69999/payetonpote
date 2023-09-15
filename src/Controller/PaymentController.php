<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Payment;
use App\Entity\PaymentRepository;
use App\Form\PaymentType;
use Symfony\Component\HttpFoundation\Request;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/campaign/{id}/payement', name: 'app_campaign_payement')]
    public function payment(Campaign $campaign): Response
    {
        return $this->render('campaign/payement.html.twig', [
            'campaign' => $campaign,
        ]);
    }

    public function payement(Request $request, EntityManagerInterface $entityManager): Response
    {
        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $payment->setCreatedAt(new DateTimeImmutable());
            $payment->setUpdatedAt(new DateTimeImmutable());
            $entityManager->persist($payment);
            $entityManager->flush();

            return $this->redirectToRoute('payment', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payment/payment.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
