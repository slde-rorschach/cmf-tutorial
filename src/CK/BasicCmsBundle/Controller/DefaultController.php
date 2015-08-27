<?php

namespace CK\BasicCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function pageAction($contentDocument)
    {
        $documentManager = $this->get('doctrine_phpcr')->getManager();
        $posts = $documentManager->getRepository('CKBasicCmsBundle:Post')->findAll();

        return $this->render('CKBasicCmsBundle:Default:page.html.twig', array(
            'page' => $contentDocument,
            'posts' => $posts
        ));
    }
}
