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

use Kiczort\PolishValidatorBundle\Validator\Constraints\Pesel;
use Kiczort\PolishValidatorBundle\Validator\Constraints\PeselValidator;
use Symfony\Component\Validator\Tests\Constraints\AbstractConstraintValidatorTest;
use Symfony\Component\Validator\Validation;

/**
 * @author Grzegorz Koziński <gkozinski@gmail.com>
 */
class PeselValidatorTest extends AbstractConstraintValidatorTest
{
    /**
     * @return PeselValidator
     */
    protected function createValidator()
    {
        return new PeselValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Pesel());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid()
    {
        $this->validator->validate('', new Pesel());

        $this->assertNoViolation();
    }

    /**
     * @expectedException \Symfony\Component\Validator\Exception\UnexpectedTypeException
     */
    public function testExpectsStringCompatibleType()
    {
        $this->validator->validate(new \stdClass(), new Pesel());
    }

    /**
     * @dataProvider getNoneStrictValidPeselNumbers
     */
    public function testValidPesel($pesel)
    {
        $this->validator->validate($pesel, new Pesel());

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getStrictValidPeselNumbers
     */
    public function testValidPeselStrict($pesel)
    {
        $this->validator->validate($pesel, new Pesel(array(
            'strict' => true,
        )));

        $this->assertNoViolation();
    }

    /**
     * @dataProvider getNoneStrictInvalidPeselNumbers
     */
    public function testInvalidPesel($pesel)
    {
        $constraint = new Pesel(array(
            'message' => 'myMessage',
        ));

        $this->validator->validate($pesel, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $pesel . '"')
            ->assertRaised();
    }

    /**
     * @dataProvider getStrictInvalidPeselNumbers
     */
    public function testInvalidPeselStrict($pesel)
    {
        $constraint = new Pesel(array(
            'strict' => true,
            'message' => 'myMessage',
        ));

        $this->validator->validate($pesel, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $pesel . '"')
            ->assertRaised();
    }

    /**
     * @return array
     */
    public function getNoneStrictValidPeselNumbers()
    {
        return array(
            array('55813111111'),
            array('44051401358'),
        );
    }

    /**
     * @return array
     */
    public function getStrictValidPeselNumbers()
    {
        return array(
            array('44051401359'),
        );
    }

    /**
     * @return array
     */
    public function getNoneStrictInvalidPeselNumbers()
    {
        return array(
            array('12314'),
            array('12314111111'),
            array('55813211111'),
            array('123a41f1111'),
        );
    }

    /**
     * @return array
     */
    public function getStrictInvalidPeselNumbers()
    {
        return array(
            array('44051401358'),
        );
    }

    protected function getApiVersion()
    {
        return Validation::API_VERSION_2_5_BC;
    }
}
