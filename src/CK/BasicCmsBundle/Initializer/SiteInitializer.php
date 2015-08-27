<?php

namespace CK\BasicCmsBundle\Initializer;

use CK\BasicCmsBundle\Document\Site;
use Doctrine\Bundle\PHPCRBundle\Initializer\InitializerInterface;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use PHPCR\Util\NodeHelper;

class SiteInitializer implements InitializerInterface
{
    private $basePath;

    /**
     * SiteInitializer constructor.
     * @param $basePath
     */
    public function __construct($basePath = '/cms')
    {
        $this->basePath = $basePath;
    }

    /**
     * This method should be used to establish the requisite
     * structure needed by the application or bundle of the
     * content repository.
     *
     * @param ManagerRegistry $registry
     */
    public function init(ManagerRegistry $registry)
    {
        $documentManager = $registry->getManager();

        if ($documentManager->find(null, $this->basePath)) {
            return;
        }

        $site = new Site();
        $site->setId($this->basePath);
        $documentManager->persist($site);
        $documentManager->flush();

        $session = $registry->getConnection();

        NodeHelper::createPath($session, $this->basePath . '/articles');
        NodeHelper::createPath($session, $this->basePath . '/pages');
        NodeHelper::createPath($session, $this->basePath . '/posts');
        NodeHelper::createPath($session, $this->basePath . '/routes');

        $session->save();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ck_site_initializer';
    }
}
