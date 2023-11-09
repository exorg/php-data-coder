<?php

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\DataFormat;

use PHPUnit\Framework\TestCase;

/**
 * DataFormatTest.
 * PHPUnit test class for DataFormat class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFormatTest extends TestCase
{
    const DATA_FORMAT_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\DataFormat\DataFormat';

    /**
     * Test ExOrg\DatafilesParser\DataFormat enum
     * has been implemented.
     */
    public function testDataFormatExists()
    {
        $this->assertTrue(
            class_exists(self::DATA_FORMAT_FULLY_QUALIFIED_CLASS_NAME)
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
        $actualFormatFullName = constant(self::DATA_FORMAT_FULLY_QUALIFIED_CLASS_NAME . "::" . $formatAbbreviation);

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
