<?php
use Codeception\Util\Stub;

/**
 *  The actual setUp and tearDown was implemented by parent class \Codeception\TestCase\Test
 * Class AddArticleTest
 */
class ReposArticleTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {

    }

    // tests
    public function testGetArticlesByCategory()
    {
        $container = $this->getModule('Symfony2')->container;
        $em = $container->get('doctrine')->getManager();
        $articles = $em->getRepository('HeticSiteBundle:Article')->getArticlesByCategory(4);
        $this->assertEquals(2, count($articles));

    }

    // tests
    public function testGetArticlesByTags()
    {
        $container = $this->getModule('Symfony2')->container;
        $em = $container->get('doctrine')->getManager();

        $articles = $em->getRepository('HeticSiteBundle:Article')->getArticlesByTags('sex-appeal');
        $this->assertEquals(0, count($articles));
        $markdown = new MarkdownParser();
        $html = $markdown->parse("**Hello world**");
        $articles = $em->getRepository('HeticSiteBundle:Article')->getArticlesByTags('Duke Nukem');
        $this->assertEquals(0, count($articles));
        $articles = $em->getRepository('HeticSiteBundle:Article')->getArticlesByTags('800 millions d’euros');
        $this->assertEquals(2, count($articles));
        $articles = $em->getRepository('HeticSiteBundle:Article')->getArticlesByTags('Lilian Thuram');
        $this->assertEquals(2, count($articles));
    }

    // tests
    public function testFindCategory()
    {
        $container = $this->getModule('Symfony2')->container;
        $em = $container->get('doctrine')->getManager();
        $article = $em->getRepository('HeticSiteBundle:Category')->find(2);
        print($article->getName());


    }

}