<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DataCoder;

/**
 * CheckingDataDecodingResultTrait.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
trait CheckingDataDecodingResultTrait
{
    /**
     * Provide correct result of the parsing.
     *
     * @return array
     */
    public function provideExpectedResultOfDecodedData()
    {
        $expectedResult = array (
            "firstName" => "John",
            "lastName" => "Smith",
            "isAlive" => true,
            "age" => 25,
            "height_cm" => 167.6,
            "address" => array (
                "streetAddress" => "21 2nd Street",
                "city" => "New York",
                "state" => "NY",
                "postalCode" => "10021-3100",
            ),
            "phoneNumbers" => array (
                array (
                    "type" => "home",
                    "number" => "212 555-1234",
                ),
                array (
                    "type" => "office",
                    "number" => "646 555-4567",
                ),
            ),
            "children" => array (
            ),
            "spouse" => null,
        );

        return $expectedResult;
    }
}
