<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Discipline
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DisciplineRepository")
 */
class Discipline
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
     * @var string
     *
     * @ORM\Column(name="machineName", type="string", length=255)
     */
    private $machineName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Session[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Session", mappedBy="discipline")
     */
    private $sessions;

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
     * @return mixed
     */
    public function getMachineName()
    {
        return $this->machineName;
    }

    /**
     * @param mixed $machineName
     *
     * @return $this
     */
    public function setMachineName($machineName)
    {
        $this->machineName = $machineName;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Discipline
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Session[]|ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param Session[]|ArrayCollection $sessions
     *
     * @return $this
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;

        return $this;
    }

}
