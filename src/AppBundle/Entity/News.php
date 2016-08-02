<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News extends DefaultEntity{

	/**
	 * @ORM\Column(type="string", length=255, unique=TRUE)
	 * @Assert\NotNull(message="Debe escribir un nombre")
	 * @Assert\NotBlank()
     * @Assert\Length(
     *      min = "3",
     *      max = "255",
     *      minMessage = "El nombre debe tener como minimo {{ limit }} caracteres",
     *      maxMessage = "El nombre debe tener como maximo {{ limit }} caracteres",
     * )
	 */
	private $name;


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
	 * @ORM\Column(type="string")
	 * @Assert\Image(
	 * 				maxSize="4M",
	 *  			mimeTypesMessage = "Suba un archivo de imagen valido",
	 *  			uploadErrorMessage = "No se pudo subir la imagen",
	 *  			maxSizeMessage = "El archivo es muy grande, El tamaño maximo permitido es {{ limit }} {{ suffix }}",
	 *  			disallowEmptyMessage = "No se permiten archivos vacios ( Ej. de 0 bytes)"
	 *  )
	 */
	private $image;
	
	/**
	 * Set image
	 *
	 * @param string $image
	 * @return News
	 */
	public function setImage($image)
	{
		$this->image = $image;
	
		return $this;
	}
	
	/**
	 * Get image
	 *
	 * @return string
	 */
	public function getImage()
	{
		return $this->image;
	}
	
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
     * @return News
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
    
}
