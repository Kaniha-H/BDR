<?php

namespace App\Controller;

use App\Entity\Invoice;
use App\Form\InvoiceType;
use App\Repository\InvoiceRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/invoice", name="invoice:")
 */
class InvoiceController extends AbstractController
{
    /**
     * @Route("s", name="index", methods={"HEAD","GET"})
     */
    public function index(InvoiceRepository $invoiceRepository, UserRepository $userRepository)
    {
        $invoices = $invoiceRepository->findAll();
        // $users = $userRepository->findAll();
        // $ids = $invoiceRepository->getUser();

        return $this->render('invoice/index.html.twig', [
            'invoices' => $invoices,
            // 'users' => $users,
            // 'id' => $ids
        ]);
    }

    /**
     * @Route("", name="create", methods={"HEAD","GET","POST"})
     */
    public function create(Request $request)
    {
        // $errors = [];
        $invoice = new Invoice;

        $form = $this->createForm(InvoiceType::class, $invoice);
        $form->handleRequest($request);

        if ( $form->isSubmitted() )
        {
            // $invoice->setNumber( uniqid() );

            $em = $this->getDoctrine()->getManager();
            $em->persist( $invoice );
            $em->flush();

            return $this->redirectToRoute('invoice:read', [
                'id' => $invoice->getId()
            ]);
        }

        $form = $form->createView();

        return $this->render('invoice/create.html.twig', [
            'form' => $form,
            
            // 'errors' => $errors,
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"HEAD","GET"})
     */
    public function read(Invoice $invoice)
    {
        return $this->render('invoice/read.html.twig', [
            'invoice' => $invoice
        ]);
    }

    /**
     * @Route("/{id}/edit", name="update", methods={"HEAD","GET","POST"})
     */
    public function update(Invoice $invoice, Request $request)
    {
        $form = $this-> createForm(InvoiceType::class, $invoice);

        $form->handleRequest ($request);

        if ($form->isSubmitted())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice); 
            $em->flush();

            return $this->redirectToRoute("invoice:read", [
                'id' => $invoice->getId()
            ]);
        }
        $form = $form->createView();
        
        return $this->render('invoice/update.html.twig', [
            'form'=> $form,
            'invoice'=> $invoice
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete", methods={"HEAD","GET","DELETE"})
     */
    public function delete(Invoice $invoice, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($invoice);
        $em->flush();

        return $this->redirectToRoute("invoice:index");
    }
}