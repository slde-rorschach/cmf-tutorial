<?php

namespace CK\BasicCmsBundle\Admin;

use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends PageAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form)
    {
        parent::configureFormFields($form);

        $form->with('form.group_general')
            ->add('date', 'date')
            ->end();
    }
}
