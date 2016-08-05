<?php

namespace AppBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BaseFixtures
 * @package AppBundle\DataFixtures
 */
abstract class BaseFixtures implements FixtureInterface, ContainerAwareInterface
{
    const DEFAULT_LOCALE = 'pl_PL';

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return \Faker\Generator
     */
    public function initializeFaker()
    {
        return Factory::create(self::DEFAULT_LOCALE);
    }
}