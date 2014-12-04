<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Class LoadFixtureData
 *
 * @package   AppBundle\DataFixtures\ORM
 * @author    Jure Zitnik <jzitnik@astina.ch>
 * @copyright 2014 Astina AG (http://astina.ch)
 */
abstract class LoadData extends DataFixtureLoader implements OrderedFixtureInterface
{


    /**
     * @var array
     */
    private $increments;

    /**
     * Returns random keywords separated by comma.
     *
     * @return string
     */
    public function realKeywords()
    {
        $generator           = \Faker\Factory::create('en');
        $text                = strtolower($generator->realText());
        $cleanText           = preg_replace('/[\W]+/', ' ', $text);
        // remove words that are 3 or les char long
        $cleanText           = preg_replace('/\b[0-9]+\b\s?|\b[a-z]{1,3}\b\s?/i', '', $cleanText);
        $commaSeparatedWords = str_replace(' ', ', ', $cleanText);

        return trim($commaSeparatedWords, ',');
    }

    /**
     * @param string $key
     * @param int    $start
     * @param int    $step
     *
     * @return int
     */
    public function incrementingNumber($key, $start = 1, $step = 1)
    {
        if (!isset($this->increments[$key])) {
            $this->increments[$key] = $start;
        }
        $val = $this->increments[$key];
        $this->increments[$key] += $step;

        return $val;
    }

    /**
     * @param $text
     *
     * @return string
     */
    public function nl2p($text)
    {
        $lines = explode(PHP_EOL, $text);
        return "<p>".implode("</p><p>", $lines)."</p>";
    }
}
