<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request){
    	$em = $this->getDoctrine()->getManager();
    	$em->getRepository("AppBundle:Site")->findBy(array("baja_logica" => false), array("name" => "ASC"));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
        
        /*$number = rand(0, 100);
        
        return new Response(
        		'<html><body>Lucky number: '.$number.'</body></html>'
        		);*/
    }
}
