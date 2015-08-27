<?php

namespace CK\BasicCmsBundle\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Knp\Menu\NodeInterface;
use Symfony\Cmf\Component\Routing\RouteReferrersReadInterface;

/**
 * @PHPCR\Document(referenceable=true)
 */
class Article implements RouteReferrersReadInterface, NodeInterface
{
    use ContentTrait;

    /**
     * @PHPCR\Children()
     */
    protected $children;

    /**
     * Get the name of the node
     *
     * Each child of a node must have a unique name
     *
     * @return string
     */
    function getName()
    {
        return $this->title;
    }

    /**
     * Get the child nodes implementing NodeInterface
     *
     * @return \Traversable
     */
    function getChildren()
    {
        return $this->children;
    }

    /**
     * Get the options for the factory to create the item for this node
     *
     * @return array
     */
    function getOptions()
    {
        return array(
            'label' => $this->title,
            'content' => $this,

            'attributes'         => array(),
            'childrenAttributes' => array(),
            'displayChildren'    => true,
            'linkAttributes'     => array(),
            'labelAttributes'    => array(),
        );
    }
}