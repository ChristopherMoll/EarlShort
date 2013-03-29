<?php

namespace EarlShort\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EarlShort\MainBundle\Entity\User as User;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Link
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EarlShort\MainBundle\Entity\LinkRepository")
 */
class Link
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="text")
     * @Assert\Url()
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var integer
     *
     * @ORM\Column(name="visitCount", type="integer")
     */
    private $visitCount;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="links")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    protected $creator;

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
     * Set path
     *
     * @param string $path
     * @return Link
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set destination
     *
     * @param string $destination
     * @return Link
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;
    
        return $this;
    }

    /**
     * Get destination
     *
     * @return string 
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set created
     *
     * @return Link
     */
    public function setCreated()
    {
        $this->created = new \DateTime();
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @return Link
     */
    public function setUpdated()
    {
        $this->updated = new \DateTime();
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     *
     * @ORM\PrePersist
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set visitCount
     *
     * @param int $count
     *
     * @return Link
     */
    public function setVisitCount($count=null)
    {
        if($count===null)
            $this->visitCount++;
        else $this->visitCount = $count;

        return $this;
    }

    /**
     * Get visitCount
     *
     * @return integer 
     */
    public function getVisitCount()
    {
        return $this->visitCount;
    }

    /**
     * Set Creator
     *
     * @param User $creator
     *
     * @return Link
     */
    public function setCreator(User $creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Get Creator
     *
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
