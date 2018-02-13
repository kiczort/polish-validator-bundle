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

use Kiczort\PolishValidatorBundle\Validator\Constraints\Pwz;
use Kiczort\PolishValidatorBundle\Validator\Constraints\PwzValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;
use Symfony\Component\Validator\Validation;

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

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new Pwz());
    }

    /**
     * @dataProvider getValidPwzNumbers
     */
    public function testValidPwz($pwz)
    {
        $this->validator->validate($pwz, new Pwz());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getInvalidPwzNumbers
     */
    public function testInvalidPwz($pwz)
    {
        $constraint = new Pwz(array(
            'message' => 'myMessage',
        ));

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
        return array(
            array('7305386'),
            array('7520143'),
            array('5773472'),
            array('1241156'),
            array('8839283'),
            array('4470910'),
            array('4850185'),
        );
    }

    /**
     * @return array
     */
    public function getInvalidPwzNumbers()
    {
        return array(
            array('0'),
            array('0000000000000'),
            array('0000000'),
            array('1111111'),
            array('2222222'),
        );
    }

    /**
     * @return PwzValidator
     */
    protected function createValidator()
    {
        return new PwzValidator();
    }

    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5_BC;
    }
}
