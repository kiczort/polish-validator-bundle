<?php

/*
 * This file is part of the Polish Validator Bundle package.
 *
 * (c) Grzegorz Koziński
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Kiczort\PolishValidatorBundle\Constraints;

use Kiczort\PolishValidatorBundle\Validator\Constraints\Nip;
use Kiczort\PolishValidatorBundle\Validator\Constraints\NipValidator;
use stdClass;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class NipValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @return NipValidator
     */
    protected function createValidator()
    {
        return new NipValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Nip());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Nip());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedTypeException::class);
        $this->validator->validate(new stdClass(), new Nip());
    }

    /**
     * @dataProvider getValidNipNumbers
     */
    public function testValidNip($nip)
    {
        $this->validator->validate($nip, new Nip());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidNipNumbers
     */
    public function testInvalidNip($nip)
    {
        $constraint = new Nip([
            'message' => 'myMessage',
        ]);

        $this->validator->validate($nip, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $nip . '"')
            ->assertRaised();
    }

    /**
     * @return array
     */
    public function getValidNipNumbers()
    {
        return [
            ['1234563218'],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidNipNumbers()
    {
        return [
            ['123456789'],
            ['12345678901'],
            ['0000000000'],
            ['123456789a'],
            ['1234563217'],
        ];
    }

}
