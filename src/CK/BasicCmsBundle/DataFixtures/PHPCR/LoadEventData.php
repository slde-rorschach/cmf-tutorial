<?php

namespace CK\BasicCmsBundle\DataFixtures\PHPCR;

use CK\BasicCmsBundle\Document\Event;
use CK\BasicCmsBundle\Document\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;


class LoadEventData implements FixtureInterface
{
    public function load(ObjectManager $dm)
    {
        if (!$dm instanceof DocumentManager) {
            $class = get_class($dm);
            throw new \RuntimeException(
                "Fixture requires a PHPCR ODM DocumentManager instance, instance of '$class' given."
            );
        }

        $parent = $dm->find(null, '/cms/events');

        $rootEvent = new Event();
        $rootEvent->setTitle('main');
        $rootEvent->setParentDocument($parent);
        $dm->persist($rootEvent);


        $articel = new Event();
        $articel->setTitle('Home event');
        $articel->setParentDocument($rootEvent);
        $articel->setContent("Welcome to the homepage of this really basic CMS.");
        $dm->persist($articel);


        $aboutEvent = new Event();
        $aboutEvent->setTitle('About events');
        $aboutEvent->setParentDocument($rootEvent);
        $aboutEvent->setContent("Some lorem about ipsum.");
        $dm->persist($aboutEvent);

        $dm->flush();
    }
}