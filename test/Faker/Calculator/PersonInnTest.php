<?php

namespace Faker\Calculator;

use PHPUnit\Framework\TestCase;

class PersonInnTest extends TestCase
{
    public function checksumProvider()
    {
        return array(
            array('1001209581', '40'),
            array('4711001027', '19'),
            array('1011006675', '54'),
            array('1001225767', '00'),
            array('7825082670', '54'),
            array('1001086821', '90')
        );
    }

    /**
     * @dataProvider checksumProvider
     */
    public function testChecksum($inn, $checksum)
    {
        $this->assertEquals($checksum, PersonInn::checksum($inn), $inn);
    }

    public function validatorProvider()
    {
        return array(
            array('100120958140', true),
            array('471100102719', true),
            array('101100667554', true),
            array('100122576700', true),
            array('782508267054', true),

            array('111111111111', false),
            array('012345678910', false),
        );
    }

    /**
     * @dataProvider validatorProvider
     */
    public function testIsValid($inn, $isValid)
    {
        $this->assertEquals($isValid, PersonInn::isValid($inn), $inn);
    }
}
