<?php

namespace Hetic\SiteBundle\Controller;

use Hetic\SiteBundle\Entity\Article;

use Hetic\SiteBundle\Entity\Category;
use Hetic\SiteBundle\Entity\Famille;
use Hetic\SiteBundle\Entity\ImageCategory;
use Hetic\SiteBundle\Form\ArticleType;
use Hetic\SiteBundle\Form\CategoryType;
use Hetic\SiteBundle\Form\FamilleType;
use Hetic\SiteBundle\Form\ImageCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;

class CategoryController extends Controller
{

    public function famillesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $familles = $em->getRepository('HeticSiteBundle:Famille')->findAll();

        return $this->render('HeticSiteBundle:Category:familles.html.twig', array('familles' => $familles));
    }


    public function categoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('HeticSiteBundle:Category')->findAll();

        return $this->render('HeticSiteBundle:Category:categories.html.twig', array('categories' => $categories));
    }


    public function removecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La catégory a bien été supprimée"
        );
        return $this->redirect($this->generateUrl('hetic_site_categories'));
    }


    public function removefamilleAction(Famille $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La famille a bien été supprimée"
        );
        return $this->redirect($this->generateUrl('hetic_site_familles'));
    }


    public function createcategoryAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $category = new Category();


        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La catégory a bien été ajoutée"
                );
                return $this->redirect($this->generateUrl('hetic_site_edit_image_category', array('id' => $category->getId())));
            }
        }
        return $this->render('HeticSiteBundle:Category:createcategory.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }


    public function editfamilleAction(Famille $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new FamilleType(), $id);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La catégory a bien été editée"
                );
                return $this->redirect($this->generateUrl('hetic_site_familles'));
            }
        }
        return $this->render('HeticSiteBundle:Category:editfamille.html.twig',
            array(
                'form' => $form->createView(),
                'famille' => $id,
            )
        );

    }

    public function createfamilleAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $category = new Famille();

        $form = $this->createForm(new FamilleType(), $category);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $em->persist($category);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La catégory a bien été ajoutée"
                );
                return $this->redirect($this->generateUrl('hetic_site_familles'));
            }
        }
        return $this->render('HeticSiteBundle:Category:createfamille.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    public function coverimagecategoryAction(ImageCategory $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $id->getCategory();
        $oldsimage = $category->getImages();
        if (!empty($oldsimage))
            foreach ($oldsimage as $img) {
                $img->setCover(false);
                $em->persist($img);
                $em->flush();
            }
        $id->setCover(true);
        $em->persist($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image de la catégorie a bien été mise en avant"
        );
        return $this->redirect($this->generateUrl('hetic_site_edit_image_category', array('id' => $id->getCategory()->getId())));
    }

    public function removeimagecategoryAction(ImageCategory $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image de la catégories a bien été activé"
        );
        return $this->redirect($this->generateUrl('hetic_site_edit_image_category', array('id' => $id->getCategory()->getId())));
    }


    public function desactivecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(false);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La catégory a bien été désactivé"
        );
        return $this->redirect($this->generateUrl('hetic_site_categories'));
    }

    public function activecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();

        $id->setVisible(true);
        $em->persist($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La category a bien été activée"
        );
        return $this->redirect($this->generateUrl('hetic_site_categories'));
    }

    public function categoryAction(Category $id)
    {

        return $this->render('HeticSiteBundle:Category:category.html.twig',
            array(
                'category' => $id,
            )
        );
    }


    public function familleAction(Famille $id)
    {

        return $this->render('HeticSiteBundle:Category:famille.html.twig',
            array(
                'category' => $id,
            )
        );
    }


    public function picturecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $image = new ImageCategory();
        $image->setCategory($id);
        $form = $this->createForm(new ImageCategoryType(), $image);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $image->upload($id->getId());
                $em->persist($image);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "L'image de la catégory a bien été ajouté"
                );
                return $this->redirect($this->generateUrl('hetic_site_categories'));
            }
        }
        return $this->render('HeticSiteBundle:Category:picturecategory.html.twig',
            array(
                'form' => $form->createView(),
                'category' => $id,
            )
        );
    }


    public function editcategoryAction(Category $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm(new CategoryType(), $id);
        $form->handleRequest($request);

        if ($request->getMethod() === "POST") {

            if ($form->isValid()) {
                $id->setDateUpdated(new \Datetime('now'));
                $em->persist($id);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    "La catégory a bien été editée"
                );
                return $this->redirect($this->generateUrl('hetic_site_categories'));
            }
        }
        return $this->render('HeticSiteBundle:Category:editcategory.html.twig',
            array(
                'form' => $form->createView(),
                'category' => $id,
            )
        );

    }


}
