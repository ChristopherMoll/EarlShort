<?php

namespace EarlShort\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EarlShort\MainBundle\Entity\User as User;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use DateTime as DateTime;


/**
 * Link
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EarlShort\MainBundle\Entity\LinkRepository")
 * @UniqueEntity(fields="path",message="Sorry, that path is already taken.")
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
     * @ORM\Column(name="path", type="string", length=255, unique=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="text")
     * @Assert\Url(message="Please enter a valid URL.")
     */
    private $destination;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="expiration", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $expiration;

    /**
     * @var integer
     *
     * @ORM\Column(name="visitCount", type="integer")
     */
    private $visitCount;

    /**
     * @var integer
     *
     * @ORM\Column(name="visitLimit", type="integer", nullable=true)
     * @Assert\Range(
     *      min = "0",
     *      max = "1000",
     *      minMessage = "The visitor limit must be positive, or 0 for unlimited.",
     *      maxMessage = "Please enter a number between 0 and {{ limit }}."
     * )
     */
    private $visitLimit;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="links")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id", nullable=true)
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
    public function setPath($path=null)
    {
        if($path === null)
            $this->path = $this->generatePath();
        else
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
        $this->created = new DateTime();
        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime 
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
        $this->updated = new DateTime();
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return DateTime 
     *
     * @ORM\PrePersist
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set expiration
     * 
     * @param DateTime $expiration
     * @return Link
     */
    public function setExpiration(DateTime $expiration)
    {
        $this->expiration = $expiration;
        
        return $this;
    }

    /**
     * Get updated
     *
     * @return DateTime
     *
     */
    public function getExpiration()
    {
        return $this->expiration;
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
     * Set visitLimit
     *
     * @param int $limit
     *
     * @return Link
     */
    public function setVisitLimit($limit=0)
    {
        $this->visitLimit = $limit;

        return $this;
    }

    /**
     * Get visitLimit
     *
     * @return integer
     */
    public function getVisitLimit()
    {
        return $this->visitLimit;
    }

    /**
     * Set Creator
     *
     * @param User $creator
     *
     * @return Link
     */
    public function setCreator(User $creator = null)
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

    /**
     * Generate Path
     *
     * @param int $length
     *
     * @return string
     */
    private function generatePath($length=5)
    {
        return substr(md5(microtime()), 0, $length);
    }

    /**
     * Check Expiration
     *
     * @return boolean
     */
    public function isExpired()
    {
        if($this->getVisitLimit() > 0) {
            return ($this->getVisitCount() > $this->getVisitLimit());
        }

        if($this->getExpiration() == null)
            return false;

        $now = new DateTime();
        return $now >= $this->getExpiration();
    }
}
