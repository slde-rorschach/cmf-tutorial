<?php

namespace CK\BasicCmsBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrinePHPCRAdminBundle\Admin\Admin;

class PageAdmin extends Admin
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
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $parent = $this->getModelManager()->find(null, '/cms/pages');
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
}
