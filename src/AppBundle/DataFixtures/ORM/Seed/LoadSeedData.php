<?php

namespace AppBundle\DataFixtures\ORM\Seed;

use AppBundle\DataFixtures\ORM\LoadData;

/**
 * Class LoadSeedData
 *
 * @package   AppBundle\DataFixtures\ORM\Seed
 * @author    Matej Velikonja <mvelikonja@astina.ch>
 * @copyright 2014 Astina AG (http://astina.ch)
 */
class LoadSeedData extends LoadData
{
    /**
     * Returns an array of file paths to fixtures
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        return [ __DIR__ . '/../../Data/seeds.yml' ];
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }
}
