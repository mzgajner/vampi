<?php

namespace AppBundle\DataFixtures\ORM\Fixture;

use AppBundle\DataFixtures\ORM\LoadData;

/**
 * Class LoadFixtureData
 *
 * @package   AppBundle\DataFixtures\ORM\Fixture
 * @author    Matej Velikonja <mvelikonja@astina.ch>
 * @copyright 2014 Astina AG (http://astina.ch)
 */
class LoadFixtureData extends LoadData
{
    /**
     * Returns an array of file paths to fixtures
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        return [ __DIR__ . '/../../Data/fixtures.yml'];
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}
