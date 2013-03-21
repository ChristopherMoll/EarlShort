<?php
namespace EarlShort\MainBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=18)
     *
     * @Assert\NotBlank(message="Please enter your username.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The username is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="18", message="The username is too long.", groups={"Registration", "Profile"})
     */

    protected $username;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    protected $email;


    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="8", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="64", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $plainPassword;



}