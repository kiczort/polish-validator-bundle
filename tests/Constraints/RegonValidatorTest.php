<?php

/*
 * This file is part of the Polish Validator Bundle package.
 *
 * (c) Grzegorz Koziński
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Kiczort\PolishValidatorBundle\Tests\Constraints;

use Kiczort\PolishValidatorBundle\Validator\Constraints\Regon;
use Kiczort\PolishValidatorBundle\Validator\Constraints\RegonValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Validation;

/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class RegonValidatorTest extends ConstraintValidatorTestCase
{
    public function testNullIsValid()
    {
        $this->validator->validate(null, new Regon());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Regon());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedTypeException::class);
        $this->validator->validate(new \stdClass(), new Regon());
    }

    /**
     * @dataProvider getValidRegonNumbers
     */
    public function testValidRegon($regon)
    {
        $this->validator->validate($regon, new Regon());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidRegonNumbers
     */
    public function testInvalidRegon($regon)
    {
        $constraint = new Regon([
            'message' => 'myMessage',
        ]);

        $this->validator->validate($regon, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $regon . '"')
            ->assertRaised();
    }

    /**
     * @return array
     */
    public function getValidRegonNumbers()
    {
        return [
            ['123456785'],
            ['12345678512347'],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidRegonNumbers()
    {
        return [
            ['12345678512346'],
            ['123456786'],
            ['12345678a'],
            ['1234567890123'],
            ['123456789012'],
            ['12345678901'],
            ['1234567890'],
            ['123456789012345'],
            ['12345678'],
        ];
    }

    /**
     * @return RegonValidator
     */
    protected function createValidator()
    {
        return new RegonValidator();
    }

}
