<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Term
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TermRepository")
 */
class Term
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
     * @ORM\Column(name="text", type="string", length=255)
     */
    private $text;

    /**
     * @var Session[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Session", mappedBy="term")
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
     * Set text
     *
     * @param string $text
     * @return Term
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
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

    public function toJsonArray()
    {
        return array(
            'id'   => $this->getId(),
            'text' => $this->getText(),
        );
    }

}
