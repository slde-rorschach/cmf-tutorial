<?php

namespace CK\BasicCmsBundle\Admin;

use CK\BasicCmsBundle\Document\Event;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class ArticleAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('title', 'text');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->with('form.group_general')
            ->add('title', 'text')
            ->add('content', 'textarea')
            ->add('date', 'date')
            ->add('events', 'phpcr_document',
                array(
                    'property' => 'title',
                    'class'    => Event::class,
                    'multiple' => true,
                ))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $parent = $this->getModelManager()->find(null, '/cms/articles');
        $object->setParentDocument($parent);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('title', 'doctrine_phpcr_string');
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFormats()
    {
        return array();
    }

    /**
     * DEPRECATED: Use configureTabMenu instead.
     *
     * @param MenuItemInterface $menu
     * @param                   $action
     * @param AdminInterface $childAdmin
     *
     * @return mixed
     *
     * @deprecated Use configureTabMenu instead
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if ('edit' !== $action) {
            return;
        }

        $article = $this->getSubject();

        $menu->addChild('make-homepage', array(
            'label' => 'Make Homepage',
            'attributes' => array('class' => 'btn'),
            'route' => 'make_homepage',
            'routeParameters' => array(
                'id' => $article->getId(),
            ),
        ));
    }
}
