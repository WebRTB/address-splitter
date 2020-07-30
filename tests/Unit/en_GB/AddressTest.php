<?php

namespace WebRTB\AddressSplitter\Tests\Unit\en_GB;

use WebRTB\AddressSplitter\Tests\AbstractTestCase;

/**
 * Class AddressTest
 * @package WebRTB\AddressSplitter\Tests\Unit\en_GB
 */
class AddressTest extends AbstractTestCase
{
    /**
     * Run tests for this locale
     */
    public function testAddress()
    {
        $this->runWithFaker('en_GB', true);
    }
}
