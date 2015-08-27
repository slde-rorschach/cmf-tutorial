<?php

namespace CK\BasicCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('CKBasicCmsBundle:Default:index.html.twig', array('name' => $name));
    }
}
