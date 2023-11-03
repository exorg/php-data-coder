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

use PHPUnit\Framework\TestCase;

/**
 * DataFormatTest.
 * PHPUnit test class for DataFormat class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2021 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFormatTest extends TestCase
{
    /**
     * Test Exorg\DatafilesParser\DataFormat enum
     * has been implemented.
     */
    public function testDataFormatExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataFormat')
        );
    }

    /**
     * Test if DataFormat have proper keys and values,
     * that means data format abbreviations
     * corresponding data format full names defined.
     *
     * @dataProvider formatAbbreviationAndFullNameProvider
     * @param string $formatAbbreviation
     * @param string $formatFullName
     */
    public function testDataFormatsItems($formatAbbreviation, $expectedFormatFullName)
    {
        $actualFormatFullName = constant("Exorg\DataCoder\DataFormat::$formatAbbreviation");

        $this->assertEquals($expectedFormatFullName, $actualFormatFullName);
    }

    /**
     * Data provider
     * for testing DataFromat abbreviations and full format names.
     *
     * @return array
     */
    public static function formatAbbreviationAndFullNameProvider()
    {
        return array(
            array('JSON', 'JSON'),
            array('YAML', 'YAML'),
            array('YML', 'YAML'),
        );
    }
}
