<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="tutorial")
 */
class Tutorial extends DefaultEntity{

	/**
	 * @ORM\Column(type="string", length=130, unique=TRUE)
	 * @Assert\NotNull(message="Debe escribir un nombre")
	 * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "2",
     *      max = "130",
     *      minMessage = "El nombre debe tener como minimo {{ limit }} caracteres",
     *      maxMessage = "El nombre debe tener como maximo {{ limit }} caracteres",
     * )
	 */
	private $name;


    /**
    * @ORM\ManyToOne(targetEntity="Site", cascade={"remove"}, fetch="EAGER")
    * @ORM\JoinColumn(name="site_id", referencedColumnName="id")
    * @Assert\Type(type="AppBundle\Entity\Site")
    * @Assert\NotNull(message="Debe seleccionar o crear la descripción del Sitio correspondiente al Tutorial")
    */
	private $site;

	/**
	 * @ORM\Column(type="text")
	 * @Assert\NotNull(message="Debe escribir una descripción del Tutorial")
     * @Assert\Length(
     *      min = "100",
     *      minMessage = "La descripción debe tener como minimo {{ limit }} caracteres",
     * )
	 */
	private $descripcion;

	/**
	 * Set name
	 *
	 * @param string $name
	 *
	 * @return Site
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Tutorial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set site
     *
     * @param \AppBundle\Entity\Site $site
     *
     * @return Tutorial
     */
    public function setSite(\AppBundle\Entity\Site $site = null)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return \AppBundle\Entity\Site
     */
    public function getSite()
    {
        return $this->site;
    }
       
}
