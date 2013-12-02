<?php

namespace Horus\SiteBundle\Fixtures;



use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Horus\SiteBundle\Entity\Article;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Class LoadArticlesDatas
 * @package Horus\SiteBundle\Fixtures
 */
class LoadArticlesDatas implements FixtureInterface,ContainerAwareInterface, OrderedFixtureInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle("Home cinema");
        $article->setContent("Le home cinema, cinéma à domicile, cinéma à la maison, cinéma chez soi, cinédom ou cinéma maison (au Canada), traduit de l'anglais « home theater », désigne l'ensemble des équipements et installations permettant au particulier, de bénéficier du confort sonore et visuel d'une salle de cinéma. Par extension, ces dispositifs permettent de valoriser diverses sources télévisuelles comme le DVD, le blu-ray ainsi que les jeux vidéo. Un ensemble « home cinema » est censé procurer un meilleur confort et des sensations acoustiques et visuelles plus spectaculaires. Alors que les normes sonores portant sur la Haute Fidélité exigent de tendre vers une certaine perfection, le « home cinema » est principalement basé sur le traitement psycho-acoustique et de certains effets visuels. Ainsi, les dispositifs de visualisation tels que téléviseur, vidéoprojecteur ou rétroprojecteur ne se limitent pas à une amélioration de la résolution des images, comme la Haute Définition mais intègrent les effets complémentaires tels que la stéréoscopie 3D. Ce terme est utilisé pour décrire un ensemble comprenant un simple téléviseur associé à un système acoustique à au moins quatre enceintes. En Europe, les détaillants de produits haute fidélité nomment souvent home cinema certains ensembles acoustiques (amplificateur avec séries d'enceintes).");

        $em = $this->container->get('doctrine.orm.entity_manager');
        $category = $em->getRepository('HorusSiteBundle:Category')->find(10);

        $article->setCategory($category);

        $manager->persist($article);
//        $manager->flush();
    }


    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 3; // the order in which fixtures will be loaded
    }

}
