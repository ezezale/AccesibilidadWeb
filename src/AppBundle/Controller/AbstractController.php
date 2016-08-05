<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;

abstract class AbstractController extends Controller{

	protected function baseVarsForTemplate(){
		$em = $this->getDoctrine()->getManager();
		$sites = $em->getRepository("AppBundle:Site")->findBy(array("baja_logica" => false), array("created" => "DESC"),5);
		$tutorials = $em->getRepository("AppBundle:Tutorial")->findBy(array("baja_logica" => false), array("created" => "DESC"),5);
		$news = $em->getRepository("AppBundle:News")->findBy(array("baja_logica" => false), array("created" => "DESC"),3);
		
		return array('sites' => $sites,
					 'tutorials' => $tutorials,
					 'news' => $news,
					 'menues' => $this->getMenues()
		);
	}

	public function abmForm(Request &$request, &$twigVars, $id,$objectName,$failNotice,$redirect){
		$class_name = "AppBundle\\Entity\\".$objectName;
		$type_class_name = "AppBundle\\Form\\".$objectName."Type";
		if (is_null($id)){
			$obj = new $class_name();
		}else{
			$em = $this->getDoctrine()->getManager();
			$obj = $em->find("AppBundle:".$objectName, $id);
			if (is_null($obj)){
				$this->get('session')->getFlashBag()->add(
						'error',
						str_replace("%id%",$id,$failNotice)
						);
				return $this->redirect($this->generateUrl($redirect));
			}
			
		}
		if ($objectName = "Tutorial"){
			$image = null;
		}else{
			$image = $obj->getImage();
		}
		$this->beforeForm($request,$obj);
		$form = $this->createForm($type_class_name,$obj);
		$form->handleRequest($request);
		
		if ($form->isSubmitted()){
			if ($form->isValid()) {
				
				$em = $this->getDoctrine()->getManager();
				
				if ($image == null && $form->getData()->getImage() == null){
					$twigVars['noImageErr'] = "Debe cargar una imagen";
				}else{
					if (!($obj instanceof Tutorial)){
						if ($form->getData()->getImage() != null){
							$this->beforeSave($obj);
						}else{
							$form->getData()->setImage($image);
						}
					}
					if (is_null($id)){
						$obj = $form->getData();
						$em->persist($obj);
					}
					$em->flush();
					$this->get('session')->getFlashBag()->add(
							'notice',
							'Los cambios han sido guardados!'
							);
					if ($redirect){
						return $this->redirect($this->generateUrl($redirect,array("id"=>$obj->getId())));
					}
				}
			}
		}else{
			$twigVars['current'] = $obj;
		}
		
		
		$twigVars['id'] = $id;
		$twigVars['form'] = $form->createView();
		
        return $this->render('AppBundle:pages:form.html.twig', $twigVars);
	}
	
	protected function getMenues(){
		return array(array('label'=>'Inicio','url'=>'/','name'=>'home'),
							array('label'=>'Noticias','url'=>'/news','name'=>'news'),
							array('label'=>'Enlaces','url'=>'/site','name'=>'site'),
							array('label'=>'Tutoriales','url'=>'/tutorial','name'=>'tutorial')
							);
	}
	
	protected function beforeForm(&$request, &$obj){}
	protected function beforeValidation(Request &$request,$obj){}	
	protected function beforeSave(&$obj){}
	
}
