<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\MappedSuperclass
 */
abstract class DefaultEntity {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="boolean",nullable=true)
     */
    protected $baja_logica = false;
    

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\NotNull()
     * @Assert\NotBlank()
     */
    private $created;

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
     * Set baja_logica
     *
     * @param boolean $bajaLogica
     * @return DefaultEntity
     */
    public function setBajaLogica($bajaLogica)
    {
        $this->baja_logica = $bajaLogica;
    
        return $this;
    }

    /**
     * Get baja_logica
     *
     * @return boolean 
     */
    public function getBajaLogica()
    {
        return $this->baja_logica;
    }
    

    /**
     * Set date
     *
     * @param \DateTime $created
     *
     * @return News
     */
    public function setCreated($created)
    {
    	$this->created = $created;
    
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
     * Gets triggered only on insert
    
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
    	$this->created = new \DateTime("now");
    }
    

    public function __toString(){
    	return this.getName();
    }
    
}