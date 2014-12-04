<?php

namespace AppBundle\DataFixtures\ORM\Fixture;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class FixturesCleanup
 *
 * @package   AppBundle\DataFixtures\ORM\Fixture
 * @author    Matej Velikonja <mvelikonja@astina.ch>
 * @copyright 2014 Astina AG (http://astina.ch)
 */
class FixturesCleanup implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $dir = $this->container->getParameter('upload.dir');

        // if directory does not exists, we don't have to delete it
        if (! file_exists($dir)) {
            return;
        }

        $fs     = new Filesystem();
        $finder = new Finder();
        $files  = $finder->in($dir);

        $fs->remove($files);
    }

    /**
     * Gets order in which to run fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return -10;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
