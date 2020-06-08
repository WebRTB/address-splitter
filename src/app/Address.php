<?php

namespace WebRTB\AddressSplitter\App;

/**
 * Class Address
 * @package WebRTB\AddressSplitter\App
 */
class Address
{	
	/**
     * Main function that splits the address fields
     *
     * @see https://gist.github.com/benvds/350404
     * @see https://stackoverflow.com/questions/24305532/split-street-house-number-and-addition-from-address
     * @see https://gist.github.com/christiaanwesterbeek/c574beaf73adcfd74997
     *
	 * @param string $address
	 * @return array with splitted adress fields
	 */
	public static function split(string $address): array
	{
		$hasMatch = preg_match('/^(\d*[\wäöüß\d \'\-\.]+)[,\s]+(\d+)\s*([\wäöüß\d\-\/]*)$/', $address, $match);
		if ($hasMatch) {
			array_shift($match); // remove element 0 (the entire match)
    		//match is now always an array with length of 3
			return $match;
		} else {
			return [$address, "", ""];
		}
	}
}