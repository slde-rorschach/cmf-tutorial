<?php

namespace CK\BasicCmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function showAction($contentDocument)
    {
        return $this->render('CKBasicCmsBundle:Article:show.html.twig', array(
            'article' => $contentDocument,
        ));
    }
}
