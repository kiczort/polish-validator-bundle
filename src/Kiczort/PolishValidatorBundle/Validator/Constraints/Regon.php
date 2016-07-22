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
class Regon extends Constraint
{
    public $message = 'This is not a valid REGON number.';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'kiczort.validator.regon';
    }
}
