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
    public function payement(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {
        $payment = new Payment();
        $formPayment = $this->createForm(PaymentType::class, $payment);

        $formPayment->handleRequest($request);

        if ($formPayment->isSubmitted() && $formPayment->isValid()) {


            $payment->setCreatedAt(new DateTimeImmutable());
            $payment->setUpdatedAt(new DateTimeImmutable());

            $payment->getParticipantId()->setCampaignId($campaign);
            $payment->getParticipantId()->getCampaignId()->setUpdatedAt(new DateTimeImmutable());

            $entityManager->persist($payment);
            $entityManager->flush();


            return $this->redirectToRoute('app_campaign_show', ['id'=>$campaign->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campaign/payement.html.twig', [
            'formPayment' => $formPayment,
            'campaign' => $campaign,
        ]);
    }
}
