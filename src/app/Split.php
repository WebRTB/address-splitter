<?php

namespace WebRTB\AddressSplitter\App;

use WebRTB\AddressSplitter\App\Exceptions\SplitAddressException;

/**
 * Class Address
 * @package WebRTB\AddressSplitter\App
 */
class Split
{
    /**
     * Main function that splits the address fields
     *
     * @see https://gist.github.com/benvds/350404
     * @see https://stackoverflow.com/questions/24305532/split-street-house-number-and-addition-from-address
     * @see https://gist.github.com/christiaanwesterbeek/c574beaf73adcfd74997
     *
     * @param string $inputAddress
     * @param bool $numberComesFirst
     * @param bool $exceptions
     * @return array with splitted adress fields
     * @throws SplitAddressException
     */
    public static function split(
        string $inputAddress,
        bool $numberComesFirst = false,
        bool $exceptions = false): array
    {
        // String of special characters in address input that are allowed
        $c = 'äáàâåöóòôüúùûëéèêïíìîýÿÄÁÀÂÖÓÒÔÜÚÙÛËÉÈÊÏÍÌÎÝßñÑŞÇçğšæÆ';

        $address = new Address($inputAddress);
        if ($numberComesFirst) {
            $hasMatch = preg_match(
                "/^(\d+)([\w\/\‘\'\-\.]*)[,\s]+(\d*[\w{$c}\d \/\‘\'\-\.]+)$/",
                $address->getStrippedInput(),
                $match
            );
        } else {
            $hasMatch = preg_match(
                "/^(\d*[\w{$c}\d \/\‘\'\-\.]+)[,\s]+(\d+)[\s]*([\w{$c}\d\-\/]*)$/",
                $address->getStrippedInput(),
                $match
            );
        }

        if ($hasMatch) {
            array_shift($match); // remove element 0 (the entire match)
            //match is now always an array with length of 3

            if ($numberComesFirst) {
                $address->setStreet($match[2]);
                $address->setHousenumber($match[0]);
                $address->setAddition($match[1]);
            } else {
                $address->setStreet($match[0]);
                $address->setHousenumber($match[1]);
                $address->setAddition($match[2]);
            }

            return $address->toArray();

        } elseif ($exceptions) {

            throw new SplitAddressException("Parsed address could not be split", 0, $address);

        } else {

            return [$address->getOrginalInput(), null, null];

        }
    }
}