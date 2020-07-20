<?php

namespace WebRTB\AddressSplitter\App;

use JsonSerializable;

/**
 * Class Address
 * @package WebRTB\AddressSplitter\App
 */
class Address implements JsonSerializable
{
    /**
     * @var string
     */
    protected $orginalInput;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $housenumber;

    /**
     * @var string
     */
    protected $addition;

    public function __construct(string $inputAddress)
    {
        $this->orginalInput = $inputAddress;
    }

    /**
     * @return string
     */
    public function getOrginalInput(): string
    {
        return $this->orginalInput;
    }

    /**
     * @return string
     */
    public function getStrippedInput(): string
    {
        $input = $this->getOrginalInput();

        // Remove new lines, tabs and trailing spaces from input
        $input = trim(preg_replace('/\s+/S', " ", $input));

        // Remove known unimportant annotations
        $input = str_replace([
            'Flat ',
            'Studio ',
            'Bourgondië, '
        ], '', $input);

        return $input;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street ?? "";
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getHousenumber(): string
    {
        return $this->housenumber ?? "";
    }

    /**
     * @param string $housenumber
     */
    public function setHousenumber(string $housenumber): void
    {
        $this->housenumber = $housenumber;
    }

    /**
     * @return string
     */
    public function getAddition(): string
    {
        return $this->addition ?? "";
    }

    /**
     * @param string $addition
     */
    public function setAddition(string $addition): void
    {
        $this->addition = $addition;
    }

    /**
     * Get array representation of address
     *
     * @return array
     */
    public function toArray(): array
    {
        return [$this->getStreet(), $this->getHousenumber(), $this->getAddition()];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->toArray());
    }

    /**
     * JSON serialize address
     *
     * @return mixed|void
     */
    public function jsonSerialize()
    {
        $this->toArray();
    }
}