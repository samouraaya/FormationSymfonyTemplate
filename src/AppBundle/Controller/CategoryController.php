<?php

namespace AppBundle\Controller;

use Core2Bundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Category controller.
 *
 */
class CategoryController extends Controller {

    /**
     * Lists all category entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
//        recuperation BD et affichage : $em : entite manager
//        $categorys = $em->getRepository('Core2Bundle:Category')->ListeProduitParCatgorie();
//        dump($categorys);
//        exit();

        $categorys = $em->getRepository('Core2Bundle:Category')->findAll();

        $data = [];

        foreach ($categorys as $cat) {
            $p = [];
            foreach ($cat->getProduit() as $prod) {
                array_push($p, ['name' => $prod->getName(),
                    'id' => $prod->getId(),]);
            }

            $d = [
                'categorie' => $cat->getName(),
                'produits' => $p,
            ];

            array_push($data, $d);
        }

        dump($data);

//        recup. les entites BD
//        kol fonc. doit etre declarer dans repository 
//        fonc. par defaut:
//        findall()
//        findby([name=>'pr']);
//        find(id)
//        dump($categorys);

        return $this->render('AppBundle:category:index.html.twig', array(
                    'categorys' => $categorys,
                    'TabData' => $data
        ));
    }

    /**
     * Creates a new category entity.
     *
     */
    public function newAction(Request $request) {
        $category = new Category();
        dump($category);
        $form = $this->createForm('Core2Bundle\Form\CategoryType', $category);
        $form->handleRequest($request);
//        handleRequest: erreur dans formulaire garde les anciens valeurs

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
//            preparer l'objet en memoire
            $em->flush();
//            commit : oracle

            return $this->redirectToRoute('category_show', array('id' => $category->getId()));
        }
//      render : afficher twig dans la meme route affciher twig
        return $this->render('AppBundle:category:new.html.twig', array(
                    'category' => $category,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a category entity.
     *
     */
    public function showAction(Category $category) {
        $deleteForm = $this->createDeleteForm($category);

        return $this->render('AppBundle:category:show.html.twig', array(
                    'category' => $category,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing category entity.
     *
     */
    public function editAction(Request $request, Category $category) {
        $deleteForm = $this->createDeleteForm($category);
        $editForm = $this->createForm('Core2Bundle\Form\CategoryType', $category);
        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('category_edit', array('id' => $category->getId()));
        }

        return $this->render('AppBundle:category:edit.html.twig', array(
                    'category' => $category,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a category entity.
     *
     */
    public function deleteAction(Request $request, Category $category) {
        $form = $this->createDeleteForm($category);
//        createDeleteForm : fonction
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($category);
            $em->flush();
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a category entity.
     *
     * @param Category $category The category entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Category $category) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('category_delete', array('id' => $category->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    //delete ajax
    public function removeAction(Category $category) {
        $em = $this->getDoctrine()->getManager();

        $em->remove($category);
//        $em->flush();

        return new JsonResponse("la catégorie " . $category->getName() . " a été supprimer");
    }

}
