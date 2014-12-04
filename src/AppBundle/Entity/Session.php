<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Session
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SessionRepository")
 */
class Session
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="time", type="integer")
     */
    private $time;

    /**
     * @var Term
     *
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="sessions")
     */
    private $term;

    /**
     * @var Discipline
     *
     * @ORM\ManyToOne(targetEntity="Discipline", inversedBy="sessions")
     */
    private $discipline;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get time
     *
     * @return integer
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set time
     *
     * @param integer $time
     *
     * @return Session
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return Discipline
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param Discipline $discipline
     *
     * @return Session
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;

        return $this;
    }

    /**
     * @return Term
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param Term $term
     *
     * @return Session
     */
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }


}
