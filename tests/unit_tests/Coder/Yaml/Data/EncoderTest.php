<?php

declare(strict_types=1);

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\Coder\Yaml\Data;

use PHPUnit\Framework\TestCase;
use ExOrg\DataCoder\Fixture\DataFileFixturesHelper;

/**
 * Yaml Data Encoder Test.
 * PHPUnit test class for YamlDataEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class EncoderTest extends TestCase
{
    const ENCODER_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\Coder\Yaml\Data\Encoder';

    /**
     * Encoded data format.
     */
    const DATA_FORMAT_YAML = 'yaml';

    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static DataFileFixturesHelper $dataFileFixturesHelper;

    /**
     * Instance of tested class.
     *
     * @var Encoder
     */
    private Encoder $yamlDataEncoder;

    /**
     * Test Yaml Data Encoder class
     * has been created.
     */
    public function testYamlDataEncoderClassExists()
    {
        $this->assertTrue(
            class_exists(self::ENCODER_FULLY_QUALIFIED_CLASS_NAME)
        );
    }

    /**
     * Test if encodeData function
     * has been defined.
     */
    public function testEncodeDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                self::ENCODER_FULLY_QUALIFIED_CLASS_NAME,
                'encodeData'
            )
        );
    }

    /**
     * Test encodeData function
     * throws exception when data is not an array.
     */
    public function testEncodeDataWithNotArrayData()
    {
        $this->expectException('\TypeError');

        $data = 1024;

        $this->yamlDataEncoder->encodeData($data);
    }

    /**
     * Test encodeData function properly encodes data
     * in the YAML format.
     */
    public function testEncodeData()
    {
        $data = self::$dataFileFixturesHelper->loadDecodedData();
        $expectedResult = self::$dataFileFixturesHelper->loadEncodedData();

        $actualResult = $this->yamlDataEncoder->encodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * This method is called before the first test of this test class is run.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
        self::$dataFileFixturesHelper->setDataFormat(self::DATA_FORMAT_YAML);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->yamlDataEncoder = new Encoder();
    }
}
