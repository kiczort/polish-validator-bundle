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

use Kiczort\PolishValidator\ValidatorInterface;
use Symfony\Component\Validator\Constraint;

/**
 * @author Michał Mleczko <kontakt@michalmleczko.waw.pl>
 *
 * @Annotation
 */
class PwzValidator extends ValidatorAbstract
{

    /**
     * @return ValidatorInterface
     */
    public function getBaseValidator(): ValidatorInterface
    {
        return new \Kiczort\PolishValidator\PwzValidator();
    }

    /**
     * @param Constraint $constraint
     * @return array
     */
    public function getValidationOptions(Constraint $constraint): array
    {
        return [];
    }

    /**
     * @return string
     */
    public function getValidatorConstraintClass(): string
    {
        return Pwz::class;
    }
}
