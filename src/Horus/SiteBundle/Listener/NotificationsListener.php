<?php

namespace Horus\SiteBundle\Listener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use Horus\SiteBundle\Document\Notifications;
use Horus\SiteBundle\Entity\Produit;
use Horus\SiteBundle\Entity\Category;
use Horus\SiteBundle\Entity\Famille;
use Horus\SiteBundle\Entity\Page;
use Horus\SiteBundle\Entity\Article;
use Horus\SiteBundle\Entity\Commandes;
use Horus\SiteBundle\Entity\Commentaire;
use Horus\SiteBundle\Entity\Commercial;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ProductsListener
 * @package Horus\SiteBundle\Listener
 */
class NotificationsListener
{

    /**
     * @var object
     */
    protected $dm;

    /**
     * @var $container
     */
    protected $container;

    /**
     * @param SecurityContext $context
     * @param Doctrine $doctrine
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container, DocumentManager $dm)
    {
        $this->container = $container;
        $this->dm = $dm;
    }


    /**
     * After each update
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->notify($args);
    }

    /**
     * After each persist
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->notify($args);
    }

    /**
     * After each remove
     * @param LifecycleEventArgs $args
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $this->notify($args);
    }


    /**
     * After each persist
     * @param LifecycleEventArgs $args
     */
    public function notify(LifecycleEventArgs $args)
    {

        $entityManager = $args->getEntityManager();
        $entity = $args->getEntity();


        /**
         * For Product
         */
        if ($entity instanceof Produit) {
            $this->container->get('session')->getFlashBag()->add(
                'notify',
                'okay'
            );
            $productquantity = $entityManager->getRepository('HorusSiteBundle:Produit')->getProductsIsQuantityNull();
            $token = sha1("1" . "q" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$productquantity > 0) {

                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $productquantity . ' produits bientôt en rupture de stock');
                $notification->setTitre('<i class="glyphicon glyphicon-exclamation-sign"></i> Quantité de produit');
                $notification->setNature(1);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();


            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $productdesactivate = $entityManager->getRepository('HorusSiteBundle:Produit')->getProductsIsDesactive();
            $token = sha1("1" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$productdesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();
                $notification->setContent('Il y a ' . $productdesactivate . ' produits dépubliés');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Produit inactif');
                $notification->setNature(1);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();


            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


            $soonbegin = $entityManager->getRepository('HorusSiteBundle:Produit')->getProductsSoonBegin();
            $token = sha1("1" . "b" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$soonbegin > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $soonbegin . ' produits qui seront bientôt en ligne');
                $notification->setTitre('<i class="glyphicon glyphicon-time"></i> Produit bientôt disponible');
                $notification->setNature(1);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $quantity = $entityManager->getRepository('HorusSiteBundle:Produit')->getProductsIsImagesNull();
            $token = sha1("1" . "f" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' produits qui ont aucune image');
                $notification->setTitre('<i class="glyphicon glyphicon-info-sign"></i> Images de produit');
                $notification->setNature(1);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $quantity = $entityManager->getRepository('HorusSiteBundle:Produit')->getProductsIsFournisseursNull();
            $token = sha1("1" . "fo" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' produits qui ont aucun fournisseur');
                $notification->setTitre('<i class="glyphicon glyphicon-warning-sign"></i> Fournisseur de produit');
                $notification->setNature(1);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


        }


        /**
         * For Category
         */
        if ($entity instanceof Category) {

            $categoryquantity = $entityManager->getRepository('HorusSiteBundle:Category')->getCategoryIsProductNull();
            $token = sha1("2" . "q" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$categoryquantity > 0) {

                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $categoryquantity . ' catégorie vides');
                $notification->setTitre('<i class="glyphicon glyphicon-warning-sign"></i> Catégorie vide');
                $notification->setNature(2);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $categorydesactivate = $entityManager->getRepository('HorusSiteBundle:Category')->getCategoryIsDesactive();
            $token = sha1("2" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$categorydesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $categorydesactivate . ' catégories dépubliées');
                $notification->setTitre('<i class="glyphicon  glyphicon-eye-close"></i> Catégorie dépubliée');
                $notification->setNature(2);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }
        }


        /**
         * For Family
         */
        if ($entity instanceof Famille) {

            $famillequantity = $entityManager->getRepository('HorusSiteBundle:Famille')->getFamilleIsProductNull();
            $token = sha1("3" . "q" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$famillequantity > 0) {

                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $famillequantity . ' famille vide de produits');
                $notification->setTitre('<i class="glyphicon glyphicon-warning-sign"></i> Famille vide');
                $notification->setNature(3);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $familledesactivate = $entityManager->getRepository('HorusSiteBundle:Famille')->getFamilleIsDesactive();
            $token = sha1("3" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$familledesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $familledesactivate . ' familles dépubliées');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Famille dépubliée');
                $notification->setNature(3);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }
        }


        /**
         * For Pages
         */
        if ($entity instanceof Page) {


            $pagequantity = $entityManager->getRepository('HorusSiteBundle:Page')->getNbArticle();
            $token = sha1("4" . "q" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pagequantity > 0) {

                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $pagequantity . " pages vides d'articles");
                $notification->setTitre('<i class="glyphicon glyphicon-info-sign"></i> Page vide');
                $notification->setNature(4);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $pagesdesactivate = $entityManager->getRepository('HorusSiteBundle:Page')->getPagesIsDesactive();
            $token = sha1("4" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pagesdesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $pagesdesactivate . ' pages désactivées');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Page dépubliée');
                $notification->setNature(4);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $pageswait = $entityManager->getRepository('HorusSiteBundle:Page')->getPagesWait();
            $token = sha1("4" . "w" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pageswait > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $pageswait . ' pages en attente de relecture');
                $notification->setTitre('<i class="glyphicon glyphicon-refresh"></i> Page en attente');
                $notification->setNature(4);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

        }


        /**
         * For Articles
         */
        if ($entity instanceof Article) {

            $pagesdesactivate = $entityManager->getRepository('HorusSiteBundle:Article')->getArticlesIsDesactive();
            $token = sha1("5" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pagesdesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $pagesdesactivate . ' articles dépubliés');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Article dépublié');
                $notification->setNature(5);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $pageswait = $entityManager->getRepository('HorusSiteBundle:Article')->getArticlesWait();
            $token = sha1("5" . "w" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pageswait > 0) {
                if (!$notification)
                    $notification = new Notifications();
                $notification->setContent('Il y a ' . $pageswait . ' articles en attente de relecture');
                $notification->setTitre('<i class="glyphicon glyphicon-refresh"></i> Article en attente');
                $notification->setNature(5);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }
        }


        /**
         * For Commandes
         */
        if ($entity instanceof Commandes) {

            $quantity = $entityManager->getRepository('HorusSiteBundle:Commandes')->getCommandesReapro();
            $token = sha1("6" . "r" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' commandes en attente de réaprovisionement');
                $notification->setTitre('<i class="glyphicon glyphicon-random"></i> Commandes en attente');
                $notification->setNature(6);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


            $quantity = $entityManager->getRepository('HorusSiteBundle:Commandes')->getCommandesVirr();
            $token = sha1("6" . "v" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' commandes en attente de virrement');
                $notification->setTitre('<i class="glyphicon glyphicon-record"></i> Commandes en attente');
                $notification->setNature(6);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


            $quantity = $entityManager->getRepository('HorusSiteBundle:Commandes')->getCommandesLiv();
            $token = sha1("6" . "l" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' commandes en attente de livraison');
                $notification->setTitre('<i class="glyphicon glyphicon-retweet"></i> Commandes en attente');
                $notification->setNature(6);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


            $quantity = $entityManager->getRepository('HorusSiteBundle:Commandes')->getCommandesErreur();
            $token = sha1("6" . "er" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' erreurs de commandes');
                $notification->setTitre('<i class="glyphicon glyphicon-remove-circle"></i> Commandes en attente');
                $notification->setNature(6);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


            $quantity = $entityManager->getRepository('HorusSiteBundle:Commandes')->getCommandesPrepa();
            $token = sha1("6" . "p" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$quantity > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $quantity . ' préparation en cours');
                $notification->setTitre('<i class="glyphicon glyphicon-share-alt"></i> Commandes en attente');
                $notification->setNature(6);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }
        }


        /**
         * For Commentaire
         */
        if ($entity instanceof Commentaire) {

            $pagesdesactivate = $entityManager->getRepository('HorusSiteBundle:Commentaire')->getCommentaireIsDesactive();
            $token = sha1("7" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pagesdesactivate > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $pagesdesactivate . ' commentaires dépubliés');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Commentaire dépublié');
                $notification->setNature(7);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $pageswait = $entityManager->getRepository('HorusSiteBundle:Commentaire')->getCommentaireWait();
            $token = sha1("7" . "w" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$pageswait > 0) {
                if (!$notification)
                    $notification = new Notifications();
                $notification->setContent('Il y a ' . $pageswait . ' commentaires en attente de relecture');
                $notification->setTitre('<i class="glyphicon glyphicon-refresh"></i> Commentaire en attente');
                $notification->setNature(7);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }
        }


        /**
         * For Actions Commerciales
         */
        if ($entity instanceof Commercial) {


            $desactivation = $entityManager->getRepository('HorusSiteBundle:Commercial')->getCommercialIsDesactive();
            $token = sha1("8" . "d" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$desactivation > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $desactivation . ' actions commerciales dépubliés');
                $notification->setTitre('<i class="glyphicon glyphicon-eye-close"></i> Action commerciale dépubliée');
                $notification->setNature(8);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $soonbegin = $entityManager->getRepository('HorusSiteBundle:Commercial')->getCommercialSoonBegin();
            $token = sha1("8" . "b" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$soonbegin > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $soonbegin . ' actions commerciales qui vont commencé dans moins de 3 jour');
                $notification->setTitre('<i class="glyphicon glyphicon-time"></i> Action commerciale');
                $notification->setNature(8);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }

            $soonbegin = $entityManager->getRepository('HorusSiteBundle:Commercial')->getCommercialSoonEnd();
            $token = sha1("8" . "e" . date('m/Y'));
            $notification = $this->dm->getRepository('HorusSiteBundle:Notifications')->findOneByToken($token);

            if ((int)$soonbegin > 0) {
                if (!$notification)
                    $notification = new Notifications();

                $notification->setContent('Il y a ' . $soonbegin . ' actions commerciales qui se terminent dans moins de 3 jour');
                $notification->setTitre('<i class="glyphicon glyphicon-time"></i> Action commerciale');
                $notification->setNature(8);
                $notification->setToken($token);
                $this->dm->persist($notification);
                $this->dm->flush();

            } else {
                if ($notification) {
                    $this->dm->remove($notification);
                    $this->dm->flush();
                }
            }


        }


    }
}

?>
