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
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;


/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
abstract class ValidatorAbstract extends ConstraintValidator
{
    /**
     * @return ValidatorInterface
     */
    abstract public function getBaseValidator();

    /**
     * @param Constraint $constraint
     * @return array
     */
    abstract public function getValidationOptions(Constraint $constraint);

    /**
     * @return string
     */
    abstract public function getValidatorConstraintClass();

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        $constraintClass = $this->getValidatorConstraintClass();

        if (get_class($constraint) !== $constraintClass) {
            throw new UnexpectedTypeException($constraint, $constraintClass);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        $validator = $this->getBaseValidator();
        if (!$validator->isValid($value, $this->getValidationOptions($constraint))) {
            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->addViolation();
            } else {
                $this->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->addViolation();
            }
        }
    }
}
