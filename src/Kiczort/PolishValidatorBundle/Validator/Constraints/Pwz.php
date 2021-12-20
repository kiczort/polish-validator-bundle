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
 * @author Michał Mleczko <kontakt@michalmleczko.waw.pl>
 *
 * @Annotation
 */
class Pwz extends Constraint
{
    public $message = 'This is not a valid PWZ number.';

    /**
     * {@inheritdoc}
     */
    public function validatedBy(): string
    {
        return 'kiczort.validator.pwz';
    }
}
