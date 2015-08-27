<?php

namespace CK\BasicCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function showAction($contentDocument)
    {
        return $this->render('CKBasicCmsBundle:Event:show.html.twig', array(
            'event' => $contentDocument,
        ));
    }
}
