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
     * @ORM\Column(name="text", type="string", length=255, unique=true)
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=10)
     */
    private $lang;

    /**
     * @var Session[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Session", mappedBy="term")
     */
    private $sessions;

    function __construct($text, $lang)
    {
        if (!empty($text)) {
            $this->text = $text;
        }
        if (!empty($lang)) {
            $this->lang = $lang;
        }
    }

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
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param string $lang
     *
     * @return $this
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
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
