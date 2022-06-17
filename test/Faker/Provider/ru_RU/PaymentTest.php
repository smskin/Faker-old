<?php

namespace Faker\Provider\ru_RU;

use Faker\Generator;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    protected function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new Payment($faker));
        $this->faker = $faker;
    }

    public function testBic()
    {
        $this->assertRegExp('/^[0-9]{9}$/', $this->faker->bic);
        $this->assertEquals("77", substr($this->faker->bic("77"), 2, 2));
    }

    public function testBankAccountNumber()
    {
        $bik = $this->faker->bic;
        $this->assertRegExp('/^[0-9]{20}$/', $this->faker->bankAccountNumber($bik));
    }

    public function testBankCorrAccountNumber()
    {
        $bik = $this->faker->bic;
        $this->assertRegExp('/^[0-9]{20}$/', $this->faker->bankCorrAccountNumber($bik));
    }
}
