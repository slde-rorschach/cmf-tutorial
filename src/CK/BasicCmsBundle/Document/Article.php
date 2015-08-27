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
     * @var \DateTime
     * @PHPCR\Date
     */
    protected $date;

    /**
     * @PHPCR\ReferenceMany(strategy="weak", targetDocument="Event")
     */
    protected $events;

    /**
     * @return mixed
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param mixed $events
     */
    public function setEvents($events)
    {
        $this->events = $events;
    }

    /**
     * @PHPCR\PrePersist()
     */
    public function updateDate()
    {
        if (!$this->date) {
            $this->date = new \DateTime();
        }
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Get the name of the node
     *
     * Each child of a node must have a unique name
     *
     * @return string
     */
    public function getName()
    {
        return $this->title;
    }

    /**
     * Get the child nodes implementing NodeInterface
     *
     * @return \Traversable
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Get the options for the factory to create the item for this node
     *
     * @return array
     */
    public function getOptions()
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