<?php

namespace Horus\SiteBundle\Controller;

use Horus\SiteBundle\Entity\Category;
use Horus\SiteBundle\Entity\Famille;
use Horus\SiteBundle\Entity\ImageCategory;
use Horus\SiteBundle\Form\CategoryType;
use Horus\SiteBundle\Form\FamilleType;
use Horus\SiteBundle\Form\ImageCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategoryController extends Controller
{

    /**
     * All Familles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function famillesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $familles = $em->getRepository('HorusSiteBundle:Famille')->findAll();

        return $this->render('HorusSiteBundle:Category:familles.html.twig', array('familles' => $familles));
    }

    /**
     * All Categories
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoriesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('HorusSiteBundle:Category')->findAll();

        return $this->render('HorusSiteBundle:Category:categories.html.twig', array('categories' => $categories));
    }


    /**
     * Remove a category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La catégory a bien été supprimée"
        );

        return $this->redirect($this->generateUrl('horus_site_categories'));
    }


    /**
     * Remove a family
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removefamilleAction(Famille $id)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "La famille a bien été supprimée"
        );

        return $this->redirect($this->generateUrl('horus_site_familles'));
    }


    /**
     * Create a category
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createcategoryAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La catégory a bien été ajoutée"
            );
            return $this->redirect($this->generateUrl('horus_site_edit_image_category', array('id' => $category->getId())));
        }

        return $this->render('HorusSiteBundle:Category:createcategory.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }


    /**
     * Edit a famille
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editfamilleAction(Famille $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new FamilleType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La catégory a bien été editée"
            );
            return $this->redirect($this->generateUrl('horus_site_familles'));
        }

        return $this->render('HorusSiteBundle:Category:editfamille.html.twig',
            array(
                'form' => $form->createView(),
                'famille' => $id,
            )
        );
    }

    /**
     * Create a famille
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createfamilleAction()
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $category = new Famille();

        $form = $this->createForm(new FamilleType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La catégory a bien été ajoutée"
            );

            return $this->redirect($this->generateUrl('horus_site_familles'));
        }

        return $this->render('HorusSiteBundle:Category:createfamille.html.twig',
            array(
                'form' => $form->createView(),
            )
        );

    }

    /**
     * Cover a image of category
     * @param ImageCategory $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function coverimagecategoryAction(ImageCategory $id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $id->getCategory();

        /**
         * HAndle old images
         */
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

        return $this->redirect($this->generateUrl('horus_site_edit_image_category', array('id' => $id->getCategory()->getId())));
    }

    /**
     * Remove a image of category
     * @param ImageCategory $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeimagecategoryAction(ImageCategory $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            "L'image de la catégories a bien été activé"
        );

        return $this->redirect($this->generateUrl('horus_site_edit_image_category', array('id' => $id->getCategory()->getId())));
    }

    /**
     * Desactive a category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
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

        return $this->redirect($this->generateUrl('horus_site_categories'));
    }

    /**
     * Active a Category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
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

        return $this->redirect($this->generateUrl('horus_site_categories'));
    }

    /**
     * Get a Category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(Category $id)
    {
        return $this->render('HorusSiteBundle:Category:category.html.twig',
            array(
                'category' => $id,
            )
        );
    }


    /**
     * Get a famille
     * @param Famille $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function familleAction(Famille $id)
    {
        return $this->render('HorusSiteBundle:Category:famille.html.twig',
            array(
                'category' => $id,
            )
        );
    }

    /**
     * Get a picture of category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function picturecategoryAction(Category $id)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();

        $image = new ImageCategory();
        $image->setCategory($id);
        $form = $this->createForm(new ImageCategoryType(), $image);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $image->upload($id->getId());
            $em->persist($image);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "L'image de la catégory a bien été ajouté"
            );
            return new JsonResponse(true);
        }

        return $this->render('HorusSiteBundle:Category:picturecategory.html.twig',
            array(
                'form' => $form->createView(),
                'category' => $id,
            )
        );
    }


    /**
     * Edit a category
     * @param Category $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editcategoryAction(Category $id)
    {
        $request = $this->getRequest();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new CategoryType(), $id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $id->setDateUpdated(new \Datetime('now'));
            $em->persist($id);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                "La catégory a bien été editée"
            );
            return $this->redirect($this->generateUrl('horus_site_categories'));
        }

        return $this->render('HorusSiteBundle:Category:editcategory.html.twig',
            array(
                'form' => $form->createView(),
                'category' => $id,
            )
        );

    }


}
