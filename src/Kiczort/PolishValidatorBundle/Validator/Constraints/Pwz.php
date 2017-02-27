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
    public $nonValidMessage = 'PWZ number is invalid';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'kiczort.validator.pwz';
    }
}
