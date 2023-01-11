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

use Kiczort\PolishValidatorBundle\Validator\Constraints\Pwz;
use Kiczort\PolishValidatorBundle\Validator\Constraints\PwzValidator;
use stdClass;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 * @author Michał Mleczko
 */
class PwzValidatorTest extends ConstraintValidatorTestCase
{
    public function testNullIsValid()
    {
        $this->validator->validate(null, new Pwz());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Pwz());

        $this->assertNoViolation();
    }

    public function testExpectsStringCompatibleType()
    {
        $this->expectException(UnexpectedTypeException::class);
        $this->validator->validate(new stdClass(), new Pwz());
    }

    /**
     * @dataProvider getValidPwzNumbers
     */
    public function testValidPwz($pwz)
    {
        $this->validator->validate($pwz, new Pwz(...[]));

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidPwzNumbers
     */
    public function testInvalidPwz($pwz)
    {
        $constraint = new Pwz([
            'message' => 'myMessage',
        ]);

        $this->validator->validate($pwz, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $pwz . '"')
            ->assertRaised();
    }

    /**
     * @return array
     */
    public function getValidPwzNumbers()
    {
        return [
            ['7305386'],
            ['7520143'],
            ['5773472'],
            ['1241156'],
            ['8839283'],
            ['4470910'],
            ['4850185'],
        ];
    }

    /**
     * @return array
     */
    public function getInvalidPwzNumbers()
    {
        return [
            ['0'],
            ['0000000000000'],
            ['0000000'],
            ['1111111'],
            ['2222222'],
        ];
    }

    /**
     * @return PwzValidator
     */
    protected function createValidator()
    {
        return new PwzValidator();
    }

}
