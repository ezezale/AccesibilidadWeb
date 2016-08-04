<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\News;
use AppBundle\Form\NewsType;

class MainController extends AbstractController{
	
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request){

    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "home";
        return $this->render('AppBundle:pages:index.html.twig', $twigVars);
    }
    
    /**
     * @Route("/news/", name="news")
     */
    public function newsAction(Request $request){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "news";
    	return $this->render('AppBundle:pages:news.html.twig', $twigVars);
    }
    
    /**
     * @Route("/site/", name="site")
     */
    public function siteAction(Request $request){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "site";
    	return $this->render('AppBundle:pages:site.html.twig', $twigVars);
    }
    
    /**
     * @Route("/tutorial/", name="tutorial")
     */
    public function tutorialAction(Request $request){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "tutorial";
    	return $this->render('AppBundle:pages:tutorial.html.twig', $twigVars);
    }
    
    /**
     * @Route("/tutorial/show/{$id}", name="tutorialShow")
     */
    public function tutorialSAction(Request $request, $id){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "tutorial";
    	$em = $this->getDoctrine()->getManager();
    	$obj = $em->find("AppBundle:Tutorial", $id);
    	if (is_null($obj)){
    		$this->get('session')->getFlashBag()->add(
    				'error',
    				str_replace("%id%",$id,"Tutorial no encontrado")
    				);
    		return $this->redirect($this->generateUrl("tutorial"));
    	}else{
    		$twigVars['current'] = $obj;
    	}
    	return $this->render('AppBundle:pages:show.html.twig', $twigVars);
    }
    
    /**
     * @Route("/site/show/{$id}", name="siteShow")
     */
    public function siteSAction(Request $request, $id){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "site";
    	$em = $this->getDoctrine()->getManager();
    	$obj = $em->find("AppBundle:Site", $id);
    	if (is_null($obj)){
    		$this->get('session')->getFlashBag()->add(
    				'error',
    				str_replace("%id%",$id,"Enlace no encontrado")
    				);
    		return $this->redirect($this->generateUrl("site"));
    	}else{
    		$twigVars['current'] = $obj;
    	}
    	return $this->render('AppBundle:pages:show.html.twig', $twigVars);
    }
    
    /**
     * @Route("/news/show/{$id}", name="newsShow")
     */
    public function newsSAction(Request $request, $id){
    
    	$twigVars = $this->baseVarsForTemplate();
    	$twigVars['typeForm'] = "news";
    	$em = $this->getDoctrine()->getManager();
    	$obj = $em->find("AppBundle:News", $id);
    	if (is_null($obj)){
    		$this->get('session')->getFlashBag()->add(
    				'error',
    				str_replace("%id%",$id,"Articulo no encontrado")
    				);
    		return $this->redirect($this->generateUrl("news"));
    	}else{
    		$twigVars['current'] = $obj;
    	}
    	return $this->render('AppBundle:pages:show.html.twig', $twigVars);
    }
    
}
