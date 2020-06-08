<?php

namespace WebRTB\AddressSplitter\Tests;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use WebRTB\AddressSplitter\App\Address;

/**
 * Class AbstractTestCase
 * @package WebRTB\AddressSplitter\Tests
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Test split address class with faker for specific locale
     *
     * @param string $locale String representing faker language
     * @param int $times Nr of times to run faker
     * @return void
     */
    protected function runWithFaker(string $locale, int $times = 25): void
    {
        /**
         * @var \Faker\Provider\nl_NL\Address $faker
         */
        $faker = Factory::create($locale);

        $addresses = [];
        for ($i = 0; $i < $times; $i++)
        {
            $addresses[] = $faker->streetAddress();
        }

        foreach ($addresses as $key => $value) {

            $result = Address::split($value);

            // See if all keys are there
            $this->assertArrayHasKey(0, $result, $value);
            $this->assertArrayHasKey(1, $result, $value);
            $this->assertArrayHasKey(2, $result, $value);
            $this->assertArrayNotHasKey(3, $result, $value);

            // Test strings filled
            $this->assertTrue(!empty($result[0]), sprintf('Street is not filled: %s', $value));
            $this->assertTrue(!empty($result[1]), sprintf('Housenumber is not filled: %s', $value));

            // Test strings contains
            $this->assertStringContainsString($result[0], $addresses[$key]);
            $this->assertStringContainsString($result[1], $addresses[$key]);
            $this->assertStringContainsString($result[2], $addresses[$key]);
        }
    }
}
