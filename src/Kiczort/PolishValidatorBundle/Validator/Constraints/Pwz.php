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
 * @author Michał MLeczko <kontakt@michalmleczko.waw.pl>
 *
 * @Annotation
 */
class Pwz extends Constraint
{
    public $invalidCharactersMessage = 'PWZ number contains invalid characters.';
    public $tooShortMessage = 'PWZ number is too short.';
    public $tooLongMessage = 'PWZ number is too long.';
    public $nonValidMessage = 'PWZ number is invalid';
}
