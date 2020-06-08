<?php

namespace WebRTB\AddressSplitter\Tests\Unit;

use WebRTB\AddressSplitter\App\Address;
use WebRTB\AddressSplitter\Tests\AbstractTestCase;

/**
 * Class BaseTest
 * @package WebRTB\AddressSplitter\Tests\Unitå
 */
class BaseTest extends AbstractTestCase
{
    /**
     * A basic test example
     *
     * @return void
     */
    public function testSplitVoorbeeldstraat()
    {
        $testvars = [
            'Voorbeeldstraat 24',
            'Voorbeeldstraat 24 ',
            'Voorbeeldstraat 24a',
            'Voorbeeldstraat 24abc',
            'Voorbeeldstraat 24 ABC',
            'Dorpstraat 2',
            'Dorpstr. 2',
            'Laan 1933 2',
            '18 Septemberplein 12',
            'Kerkstraat 42-f3',
            'Kerk straat 2b',
            '42nd street, 1337a',
            '1e Constantijn Huigensstraat 9b',
            'Maas-Waalweg 15',
            'De Dompelaar 1 B',
            'Kümmersbrucker Straße 2',
            'Friedrichstädter Straße 42-46',
            'Höhenstraße 5A',
            'Saturnusstraat 60-75',
            'Saturnusstraat 60 - 75',
            // '1, rue de l\'eglise',
        ];

        // Make sure empty strings are not excepted
        $this->assertEquals(['', '', ''], Address::split(""));

        $results = [];
        foreach ($testvars as $key => $value) {

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
            $this->assertStringContainsString($result[0], $testvars[$key]);
            $this->assertStringContainsString($result[1], $testvars[$key]);
            $this->assertStringContainsString($result[2], $testvars[$key]);
        }
    }
}