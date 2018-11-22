<?php

namespace AppBundle\Controller;

use Core2Bundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//envoyer tableau JSON 
use Symfony\Component\HttpFoundation\JsonResponse;
use Core2Bundle\Entity\Category;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
/**
 * Product controller.
 *
 */
class ProductController extends Controller {

    /**
     * Lists all product entities.
     *
     */
    public function indexAction($category) {
        
        $em = $this->getDoctrine()->getManager();
        
        $ServiceCategory = $this->get('app.categorie');
//        appel service get
        $countCategory = $ServiceCategory->count();
        
//        dump($countCategory);
//        exit();
        
        $categorys = $em->getRepository('Core2Bundle:Category')->findAll();
//        recuperation BD et affichage : $em : entite manager
        if($category == 'tous') {
            $products = $em->getRepository('Core2Bundle:Product')->findAll();
        } else {
            $products = $em->getRepository('Core2Bundle:Product')->retourListProduit($category);
        }

        $encoders = array(new XmlEncoder(), new JsonEncoder());

        $normalizers = array(new ObjectNormalizer());


        $serializer = new Serializer($normalizers, $encoders);


        //$jsonContent1 = $serializer->serialize( $products[0], 'json');
        //$prod1=$products[0];
        $p=new Product();
        $p->setName('foo');
        $p->setPrice(99);
        $p->setQte(20);

        //$jsonContent = $serializer->serialize($prod1, 'json');
       // dump($p);
        //dump($jsonContent);

        // dump($p);
       // dump($jsonContent1);
        //exit();
//        //
//        //
//        recup. les entites BD
//        kol fonc. doit etre declarer dans repository 
//        fonc. par defaut:
//        findall()
//        findby([name=>'pr']);
//        find(id)
//        dump($products);
        

        return $this->render('AppBundle:product:index.html.twig', array(
                    'products' => $products,
                    'categorys' => $categorys,
                    'categ' => $category
        ));
    }

    /**
     * Creates a new product entity.
     *
     */
    public function newAction(Request $request) {
        $product = new Product();
      //  dump($product);
        $form = $this->createForm('Core2Bundle\Form\ProductType', $product);
        $form->handleRequest($request);
//        handleRequest: erreur dans formulaire garde les anciens valeurs

        if ($form->isSubmitted() && $form->isValid()) {
           // dump($product);exit();
            $em = $this->getDoctrine()->getManager();
            $file = $product->getFile();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
           //files_directory from parametre.yml
            //move fonction prédéfini dans php prend deux parametre (emplacement et nom de fichier)
            //sauvgarder dans le dossier
            $file->move(
                $this->getParameter('files_directory'),
                $fileName);
            //mettre dans la base
            $product->setFile($fileName);
            $em->persist($product);
//            preparer l'objet en memoire
            $em->flush();
//            commit : oracle

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }
//      render : afficher twig dans la meme route affciher twig
        return $this->render('AppBundle:product:new.html.twig', array(
                    'product' => $product,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     */
    public function showAction(Product $product) {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('AppBundle:product:show.html.twig', array(
                    'product' => $product,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     */
    public function editAction(Request $request, Product $product) {
        $p = $product->getPrice();
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('Core2Bundle\Form\ProductType', $product);
        $editForm->handleRequest($request);


//        dump($p);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

//            dump($product->getPrice());
//            dump($p);

            if ($p < $product->getPrice()) {
//                echo "aaa";
//                exit();
                return $this->redirectToRoute('product_show', array('id' => $product->getId()));
            } else {
//                echo "bbb";
//                exit();
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
            }
        }

        return $this->render('AppBundle:product:edit.html.twig', array(
                    'product' => $product,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     */
    public function deleteAction(Request $request, Product $product) {
        $form = $this->createDeleteForm($product);
//        createDeleteForm : fonction
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

//delete ajax
    public function removeAction(Product $product) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($product);
//        $em->flush();

        return new JsonResponse("le produit " . $product->getName() . " a été supprimer");
    }

}
