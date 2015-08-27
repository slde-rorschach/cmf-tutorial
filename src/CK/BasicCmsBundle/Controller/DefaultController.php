<?php

namespace CK\BasicCmsBundle\Controller;

use CK\BasicCmsBundle\Document\Site;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $documentManager = $this->getManager();
        $site = $documentManager->find(Site::class, '/cms');

        $homepage = $site->getHomepage();

        if (!$homepage) {
            throw $this->createNotFoundException('No homepage found');
        }

        return $this->forward('CKBasicCmsBundle:Default:page', array(
            'contentDocument' => $homepage
        ));
    }

    public function pageAction($contentDocument)
    {
        $documentManager = $this->getManager();
        $posts = $documentManager->getRepository('CKBasicCmsBundle:Post')->findAll();

        return $this->render('CKBasicCmsBundle:Default:page.html.twig', array(
            'page' => $contentDocument,
            'posts' => $posts
        ));
    }

    public function makeHomepageAction($id)
    {
        $documentManager = $this->getManager();

        $site = $documentManager->find(null, '/cms');

        if (!$site) {
            throw $this->createNotFoundException('Could not find /cms document');
        }

        $page = $documentManager->find(null, $id);

        $site->setHomepage($page);
        $documentManager->persist($page);
        $documentManager->flush();

        return $this->redirect($this->generateUrl('admin_ck_basiccms_page_edit', array(
            'id' => $page->getId()
        )));
    }

    /**
     * @return \Doctrine\Bundle\PHPCRBundle\ManagerRegistry
     */
    private function getManager()
    {
        return $this->get('doctrine_phpcr')->getManager();
    }
}
