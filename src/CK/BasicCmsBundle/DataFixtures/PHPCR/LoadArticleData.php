<?php

namespace CK\BasicCmsBundle\DataFixtures\PHPCR;

use CK\BasicCmsBundle\Document\Article;
use CK\BasicCmsBundle\Document\Page;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ODM\PHPCR\DocumentManager;


class LoadArticleData implements FixtureInterface
{
    public function load(ObjectManager $dm)
    {
        if (!$dm instanceof DocumentManager) {
            $class = get_class($dm);
            throw new \RuntimeException(
                "Fixture requires a PHPCR ODM DocumentManager instance, instance of '$class' given."
            );
        }

        $parent = $dm->find(null, '/cms/articles');

        $rootArticle = new Article();
        $rootArticle->setTitle('main');
        $rootArticle->setParentDocument($parent);
        $dm->persist($rootArticle);


        $articel = new Article();
        $articel->setTitle('Home article');
        $articel->setParentDocument($rootArticle);
        $articel->setContent("Welcome to the homepage of this really basic CMS.");
        $dm->persist($articel);


        $aboutArticle = new Article();
        $aboutArticle->setTitle('About articles');
        $aboutArticle->setParentDocument($rootArticle);
        $aboutArticle->setContent("Some lorem about ipsum.");
        $dm->persist($aboutArticle);

        $dm->flush();
    }
}