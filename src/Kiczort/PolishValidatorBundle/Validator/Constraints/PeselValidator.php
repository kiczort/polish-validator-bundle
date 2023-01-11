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
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class PeselValidator extends ValidatorAbstract
{
    /**
     * @return ValidatorInterface
     */
    public function getBaseValidator(): ValidatorInterface
    {
        return new \Kiczort\PolishValidator\PeselValidator();
    }

    /**
     * @param Constraint $constraint
     * @return array
     */
    public function getValidationOptions(Constraint $constraint): array
    {
        return ['strict' => (bool) $constraint->strict];
    }

    /**
     * @return string
     */
    public function getValidatorConstraintClass(): string
    {
        return Pesel::class;
    }
}
