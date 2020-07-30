<?php

namespace WebRTB\AddressSplitter\Tests;

use Faker\Factory;
use Faker\Provider\nl_NL\Address;
use PHPUnit\Framework\TestCase;
use WebRTB\AddressSplitter\App\Split;

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
     * @param bool $numberComesFirst
     * @param bool $housenumber
     * @param int $times Nr of times to run faker
     * @param int $debug
     * @return void
     */
    protected function runWithFaker(
        string $locale,
        bool $numberComesFirst = false,
        bool $housenumber = true,
        int $times = 100,
        int $debug = 0): void
    {
        /**
         * @var Address $faker
         */
        $faker = Factory::create($locale);

        $addresses = [];
        for ($i = 0; $i < $times; $i++) {
            $addresses[] = $faker->streetAddress();
        }

        $this->runArrayWithAddresses($addresses, $locale, $numberComesFirst, $housenumber, $debug);
    }

    /**
     * @param array $addresses
     * @param string $locale
     * @param bool $numberComesFirst
     * @param bool $housenumber
     * @param int $debug
     */
    protected function runArrayWithAddresses(
        array $addresses,
        string $locale,
        bool $numberComesFirst = false,
        bool $housenumber = true,
        int $debug = 0): void
    {
        $stats = ["streets" => 0, "housenumbers" => 0, "additions" => 0];
        foreach ($addresses as $key => $value) {

            $result = Split::split($value, $numberComesFirst);
            $result['original'] = $value;

            // Dump results if debug is enabled
            if ($key < $debug) {
                dump($result);
            }

            // See if all keys are there
            $this->assertArrayHasKey(0, $result, $value);
            $this->assertArrayHasKey(1, $result, $value);
            $this->assertArrayHasKey(2, $result, $value);
            $this->assertArrayNotHasKey(3, $result, $value);

            // Test strings filled
            $this->assertTrue(
                !empty($result[0]),
                sprintf('Street is not filled: %s', print_r($result, true))
            );
            $this->assertTrue(
                !$housenumber || isset($result[1]),
                sprintf('Housenumber is not filled: %s', print_r($result, true))
            );

            if (!empty($result[0])) {
                $stats["streets"]++;
            }
            if (!empty($result[1])) {
                $stats["housenumbers"]++;
            }
            if (!empty($result[2])) {
                $stats["additions"]++;
            }
        }

        // Dump stats if debug is enabled
        if ($debug) {
            dump([$locale => $stats]);
        }
    }
}
