<?php

namespace CK\BasicCmsBundle\DataFixtures\PHPCR;

use CK\BasicCmsBundle\Document\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;

class LoadPageData implements FixtureInterface
{
    public function load(ObjectManager $dm)
    {
        if (!$dm instanceof DocumentManager) {
            $class = get_class($dm);
            throw new \RuntimeException(
                "Fixture requires a PHPCR ODM DocumentManager instance, instance of '$class' given."
            );
        }

        $parent = $dm->find(null, '/cms/pages');

        $rootPage = new Page();
        $rootPage->setTitle('main');
        $rootPage->setParentDocument($parent);
        $dm->persist($rootPage);


        $page = new Page();
        $page->setTitle('Home');
        $page->setParentDocument($rootPage);
        $page->setContent("Welcome to the homepage of this really basic CMS.");
        $dm->persist($page);


        $aboutPage = new Page();
        $aboutPage->setTitle('About');
        $aboutPage->setParentDocument($rootPage);
        $aboutPage->setContent("Some lorem about ipsum.");
        $dm->persist($aboutPage);

        $dm->flush();
    }
}