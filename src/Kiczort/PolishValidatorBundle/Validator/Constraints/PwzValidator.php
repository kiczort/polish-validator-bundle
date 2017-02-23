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
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * @author Michał MLeczko <kontakt@michalmleczko.waw.pl>
 *
 * @Annotation
 */
class PwzValidator extends ConstraintValidator
{
    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$constraint instanceof Pwz) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__ . '\PwzValidator');
        }

        $canonical = str_replace(' ', '', $value);


        if (strlen($canonical) < 7) {
            $this->context->addViolation($constraint->tooShortMessage,
                ['{{ value }}' => $this->formatValue($value)]);

            return;
        }

        if (strlen($canonical) > 7) {
            $this->context->addViolation($constraint->tooLongMessage,
                ['{{ value }}' => $this->formatValue($value)]);

            return;
        }

        if (!preg_match('/^[1-9]\d+$/', $canonical)) {
            $this->context->addViolation(
                $constraint->invalidCharactersMessage,
                ['{{ value }}' => $this->formatValue($value)]
            );

            return;
        }

        preg_match('/^(?P<sum>[1-9])(?P<digits>\d{6})$/', $canonical, $matches);

        $sum = 0;
        foreach (str_split($matches['digits']) as $pos => $val) {
            $sum += $val * ($pos + 1);
        }

        $sum %= 11;

        if ($sum != $matches['sum']) {
            $this->context->addViolation(
                $constraint->nonValidMessage,
                ['{{ value }}' => $this->formatValue($value)]
            );

            return;
        }
    }
}
