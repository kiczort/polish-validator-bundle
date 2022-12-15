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
use Symfony\Component\Validator\Attribute\HasNamedArguments;

/**
 * @author Michał Mleczko <kontakt@michalmleczko.waw.pl>
 *
 * @Annotation
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Pwz extends Constraint
{
    public string $message = 'This is not a valid PWZ number.';

    /**
     * @param string $message
     */
    #[HasNamedArguments]
    public function __construct(string $message, array $groups = null, mixed $payload = null)
    {
        parent::__construct([], $groups, $payload);
        $this->message = $message;
    }


    /**
     * {@inheritdoc}
     */
    public function validatedBy(): string
    {
        return static::class.'kiczort.validator.pwz';
    }
}
