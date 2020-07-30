<?php

namespace WebRTB\AddressSplitter\Tests\Unit;

use WebRTB\AddressSplitter\Tests\AbstractTestCase;

/**
 * Class BaseTest
 *
 * This class is meant to test specific addresses that are known to fail or represent special cases
 *
 * @package WebRTB\AddressSplitter\Tests\Unitå
 */
class BaseTest extends AbstractTestCase
{
    /**
     * A basic test example
     *
     * @return void
     */
    public function testSplit()
    {
        $addresses = [
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
            'Plein \'40-\'45 10',
            'Plein 1945 1',
            'Steenkade t/o 56',
            'Steenkade a/b Twee Gezusters 8',
        ];
        $this->runArrayWithAddresses($addresses, 'base', false, true, 40);
    }

    /**
     * A basic test example where a housenumber comes first
     *
     * @return void
     */
    public function testSplitNumberFirst()
    {
        $addresses = [
            '1, rue de l\'eglise',
            '27 Old Gloucester St'
        ];
        $this->runArrayWithAddresses($addresses, 'base', true, true, 0);
    }
}