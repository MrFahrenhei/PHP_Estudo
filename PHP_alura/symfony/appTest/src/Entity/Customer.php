<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $nome;
    /**
     * @ORM\Column(type="string")
     */
    public $type;
    /**
     * @ORM\Column(type="string")
     */
    public $email;
    /**
     * @ORM\Column(type="string")
     */
    public $psw;

}