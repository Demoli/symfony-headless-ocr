<?php

/**
 * Copyright Skywire. All rights reserved.
 * See LICENSE.txt for license details.
 *
 * @author      Skywire Core Team
 * @copyright   Copyright (c) 2020 Skywire (http://www.skywire.co.uk)
 */
declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'file',
            FileType::class,
            [
                'mapped'      => false,
                'required'    => true,
                'constraints' => [
                    new File(
                        [
                            'maxSize'          => '1024k',
                            'mimeTypes'        => [
                                'image/jpg',
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                            ],
                            'mimeTypesMessage' => 'Please upload a valid image',
                        ]
                    ),
                ],
            ]
        );
    }

    /**
     * @return string|null
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
