<?php

namespace Horus\SiteBundle\Twig\Extension;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;

/**
 * Class DemoExtension
 * @package Horus\SiteBundle\Twig\Extension
 */
class DemoExtension extends \Twig_Extension
{
    /**
     * @var \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader
     */
    protected $loader;
    /**
     * @var
     */
    protected $controller;

    /**
     * @param FilesystemLoader $loader
     */
    public function __construct(FilesystemLoader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @param $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array();
    }

    /**
     * @return string
     */
    protected function getControllerCode()
    {
        $r = new \ReflectionClass($this->controller[0]);
        $m = $r->getMethod($this->controller[1]);
        $code = file($r->getFilename());
        return '    '.$m->getDocComment()."\n".implode('', array_slice($code, $m->getStartline() - 1, $m->getEndLine() - $m->getStartline() + 1));
    }

    /**
     * @param $template
     * @return string
     */
    protected function getTemplateCode($template)
    {
        return $this->loader->getSource($template->getTemplateName());
    }

    /**
     * Returns the name of the extension.
     * @return string The extension name
     */
    public function getName()
    {
        return 'demo';
    }
}
