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

use Kiczort\PolishValidatorBundle\Validator\Constraints\Regon;
use Kiczort\PolishValidatorBundle\Validator\Constraints\RegonValidator;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Validation;

/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class RegonValidatorTest extends AbstractConstraintValidatorTest
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

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
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
        $constraint = new Regon(array(
            'message' => 'myMessage',
        ));

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
        return array(
            array('123456785'),
            array('12345678512347'),
        );
    }

    /**
     * @return array
     */
    public function getInvalidRegonNumbers()
    {
        return array(
            array('12345678512346'),
            array('123456786'),
            array('12345678a'),
            array('1234567890123'),
            array('123456789012'),
            array('12345678901'),
            array('1234567890'),
            array('123456789012345'),
            array('12345678'),
        );
    }

    /**
     * @return RegonValidator
     */
    protected function createValidator()
    {
        return new RegonValidator();
    }

    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5_BC;
    }
}
