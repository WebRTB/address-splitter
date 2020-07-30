<?php

namespace WebRTB\AddressSplitter\Tests\Unit\de_CH;

use WebRTB\AddressSplitter\Tests\AbstractTestCase;

/**
 * Class AddressTest
 * @package WebRTB\AddressSplitter\Tests\Unit\de_CH
 */
class AddressTest extends AbstractTestCase
{
    /**
     * Run tests for this locale
     */
    public function testAddress()
    {
        $this->runWithFaker('de_CH');
    }
}
