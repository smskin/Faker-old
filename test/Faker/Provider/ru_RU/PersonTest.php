<?php

namespace Faker\Test\Provider\ru_RU;

use Faker\Generator;
use Faker\Provider\ru_RU\Person;
use PHPUnit\Framework\TestCase;

final class PersonTest extends TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    protected function setUp()
    {
        $faker = new Generator();
        $faker->addProvider(new Person($faker));
        $this->faker = $faker;
    }

    public function testLastNameFemale()
    {
        $this->assertEquals("а", substr($this->faker->lastName('female'), -2, 2));
    }

    public function testLastNameMale()
    {
        $this->assertNotEquals("а", substr($this->faker->lastName('male'), -2, 2));
    }

    public function testLastNameRandom()
    {
        $this->assertNotNull($this->faker->lastName());
    }

    public function testPersonInn()
    {
        $this->assertRegExp('/^[0-9]{12}$/', $this->faker->personInn);
        $this->assertEquals("77", substr($this->faker->personInn("77"), 0, 2));
        $this->assertEquals("02", substr($this->faker->personInn(2), 0, 2));
    }

    public function testPersonOgrn()
    {
        $this->assertRegExp('/^[0-9]{15}$/', $this->faker->personOgrn);
        $this->assertEquals("77", substr($this->faker->personOgrn("77"), 3, 2));
        $this->assertEquals("02", substr($this->faker->personOgrn(2), 3, 2));
    }
}
