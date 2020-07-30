<?php


namespace WebRTB\AddressSplitter\App\Exceptions;

use Exception;
use Throwable;
use WebRTB\AddressSplitter\App\Address;

class SplitAddressException extends Exception
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * SplitAddressException constructor.
     * @param string $message
     * @param int $code
     * @param Address|null $address
     */
    public function __construct($message = "", $code = 0, Address $address = null)
    {
        parent::__construct($message, $code);
        $this->address = $address;
    }

    /**
     * @return bool
     */
    public function hasAddress(): bool
    {
        return boolval($this->getAddress());
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
}