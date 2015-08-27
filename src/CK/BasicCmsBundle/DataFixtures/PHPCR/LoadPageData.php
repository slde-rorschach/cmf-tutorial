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

        $page = new Page();
        $page->setTitle('Home');
        $page->setParentDocument($parent);
        $page->setContent("Welcome to the homepage of this really basic CMS.");

        $dm->persist($page);
        $dm->flush();
    }
}