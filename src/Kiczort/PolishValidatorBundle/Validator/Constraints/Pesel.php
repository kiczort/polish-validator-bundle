<?php

/*
 * This file is part of the Polish Validator Bundle package.
 *
 * (c) Grzegorz Koziński
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kiczort\PolishValidatorBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 *
 * @Annotation
 */
class Pesel extends Constraint
{
    public $message = 'This is not a valid PESEL number.';
    public $strict;

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'kiczort.validator.pesel';
    }
}
