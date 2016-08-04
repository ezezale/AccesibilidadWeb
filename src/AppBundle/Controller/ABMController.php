<?php
namespace AppBundle\Controller;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\News;
use AppBundle\Form\NewsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\SiteType;
use AppBundle\Entity\Site;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use AppBundle\Entity\Tutorial;


class ABMController extends AbstractController{
	
	/**
	 * @Route("/news/edit/{id}", name="abmNews", defaults={"id" = null})
	 * @Route("/news/edit/", defaults={"id" = null})
	 */
	public function abmNewsAction(Request $request, $id){
		$twigVars = $this->baseVarsForTemplate();
		$twigVars['typeForm'] = "news";
		$twigVars['typeFormLabel'] = "Noticias y Actualidad";
		return $this->abmForm($request, $twigVars, $id,"News","Articulo no encontrado","abmNews");
	}
	
	/**
	 * @Route("/site/edit/{id}", name="abmSite", defaults={"id" = null})
	 * @Route("/site/edit/", defaults={"id" = null})
	 */
	public function abmSiteAction(Request $request, $id){
		$twigVars = $this->baseVarsForTemplate();
		$twigVars['typeForm'] = "site";
		$twigVars['typeFormLabel'] = "Enlace";
		return $this->abmForm($request, $twigVars, $id,"Site","Enlace no encontrado","abmSite");
	}
	
	/**
	 * @Route("/tutorial/edit/{id}", name="abmTutorial", defaults={"id" = null})
	 * @Route("/tutorial/edit/", defaults={"id" = null})
	 */
	public function abmTutorialAction(Request $request, $id){
		$twigVars = $this->baseVarsForTemplate();
		$twigVars['typeForm'] = "tutorial";
		$twigVars['typeFormLabel'] = "Tutorial";
		return $this->abmForm($request, $twigVars, $id,"Site","Tutorial no encontrado","abmTutorial");
	}
	
	protected function beforeForm(&$request,&$obj){
		if (!$obj instanceof Tutorial){ 	
			$file_name = $obj->getImage();
			if ($file_name){
				$obj->setImage(new UploadedFile($this->getParameter('image_'.strtolower((new \ReflectionClass($obj))->getShortName()))."/".$file_name,$file_name));
			}
		}
	}
	
	protected function beforeSave(&$obj){
		if (!$obj instanceof Tutorial){ 		
			$fileName = $this->get('app.'.strtolower((new \ReflectionClass($obj))->getShortName()).'_uploader')->upload($obj);
			$obj->setImage($fileName);
		}
	}
}