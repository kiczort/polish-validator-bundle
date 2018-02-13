<?php

/*
 * This file is part of the Polish Validator Bundle package.
 *
 * (c) Grzegorz Koziński
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Kiczort\PolishValidatorBundle\Tests\Constraints;

use Kiczort\PolishValidatorBundle\Validator\Constraints\Nip;
use Kiczort\PolishValidatorBundle\Validator\Constraints\NipValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Validation;

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

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new Nip());
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
        $constraint = new Nip(array(
            'message' => 'myMessage',
        ));

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
        return array(
            array('1234563218'),
        );
    }

    /**
     * @return array
     */
    public function getInvalidNipNumbers()
    {
        return array(
            array('123456789'),
            array('12345678901'),
            array('0000000000'),
            array('123456789a'),
            array('1234563217'),
        );
    }

    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5_BC;
    }
}
