<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("/product", name="product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("s", name=":index")
     */
    public function index(ProductRepository $productRepository)
    {
        if(!$this->getUser())
        {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }

    /**
     * @Route("", name=":create")
     */
    public function create(Request $request)
    {
        $product = new Product;

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() ) 
        {
            $file = $request->files->get('product')['illustration'];

            $uploads_directory = $this->getParameter('uploads_directory');
            
            $filename = md5(uniqid()) . '.' . $file->guessExtension();

            $file->move(
                $uploads_directory,
                $filename
            );
            
            // mettre le nom de l'image dans la colonne illustration
            $product->setIllustration($filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            
            return $this->redirectToRoute("product:index");
        }

        $form = $form->createView();

        return $this->render('product/create.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}", name=":read")
     */
    public function read(Product $product)
    {
        return $this->render('product/read.html.twig', [
            'id' => $product->getId(),
            'product' => $product,
            'page_number' => $product->getPageNumber(),
            'release_in' => $product->getReleaseIn(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name=":update")
     */
    public function update(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            // on prend le nom du l'image de url dans la bdd type string
            $file = $product->getIllustration();
            // on met l'image
            // $uploads_directory = $this->getParameter('uploads_directory');
            // on change le nom
            $filename = md5(uniqid());
            
            // $file->move( //on ne peut pas faire un move sur un string
            //     // $uploads_directory,
            //     $filename
            // );

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $product->setIllustration($filename);

            return $this->redirectToRoute("product:read", [
                'id' => $product->getId(),
                'product' => $product
            ]);
        }

        $form = $form->createView();

        return $this->render('product/update.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}/delete", name=":delete")
     */
    public function delete(Product $product): RedirectResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute("product:index");
    }
}
