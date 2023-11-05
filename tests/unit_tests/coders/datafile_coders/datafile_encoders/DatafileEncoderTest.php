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
use Exorg\Decapsulator\ObjectDecapsulator;

/**
 * DatafileEncoderTest.
 * PHPUnit test class for DatafileEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileEncoderTest extends TestCase
{
    /**
     * Helper for handling data file fixtures.
     *
     * @var DataFileFixturesHelper
     */
    private static $dataFileFixturesHelper = null;

    /**
     * Instance of tested class.
     *
     * @var DatafileEncoder
     */
    private $datafileEncoder;

    /**
     * Test Exorg\DataCoder\DatafileEncoder class
     * has been created.
     */
    public function testDatafileEncoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DatafileEncoder')
        );
    }

    /**
     * Test if setDataFormat function
     * has been defined.
     */
    public function testSetDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DatafileEncoder',
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat type is improper.
     */
    public function testSetDataFormatWithNotStringDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = 1024;

        $this->datafileEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is null.
     */
    public function testSetDataFormatWithNullDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = null;

        $this->datafileEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function
     * thows exception when dataFormat is empty string.
     */
    public function testSetDataFormatWithEmptyDataFormat()
    {
        $this->expectException('\InvalidArgumentException');

        $dataFormat = '';

        $this->datafileEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat function sets proper format
     * that allows to build proper Data Encoder.
     *
     * @dataProvider dataFormatsAndResultsProvider
     */
    public function testSetDataFormat($dataFormat, $expectedResult)
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->setDataFormat($dataFormat);
        $this->datafileEncoder->encodeFile(array('Dummy data'), $dataFilePath);

        $actualResult = file_get_contents($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if encodeFile function
     * has been defined.
     */
    public function testEncodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DatafileEncoder',
                'encodeFile'
            )
        );
    }

    /**
     * Test encodeFile function throws exception
     * when improper format has been set directly.
     */
    public function testEncodeFileWhenImproperDataFormatIsSet()
    {
        $this->expectException('\Exorg\DataCoder\CoderClassNotFoundException');

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->setDataFormat('nonexistent');
        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile function properly encodes data file
     * when format has been set directly.
     */
    public function testEncodeFileWhenDataFormatIsSet()
    {
        $expectedResult = "<FORMAT ENCODED DATA>Another dummy data</FORMAT ENCODED DATA>";

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.anotherformat');

        $this->datafileEncoder->setDataFormat('format');
        $this->datafileEncoder->encodeFile(array('Another dummy data'), $dataFilePath);

        $actualResult = file_get_contents($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test encodeFile function throws exception
     * when data format hasn't been set
     * and encoder must recognize format by file extension
     * but file has improper extension.
     */
    public function testEncodeFileWhenDataFormatIsNotSetAndFileHasImproperExtension()
    {
        $this->expectException('\Exorg\DataCoder\CoderClassNotFoundException');

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.nonexistentformat');

        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile function throws exception
     * when data format hasn't been set
     * and encoder must recognize format by file extension
     * but file has no extension.
     */
    public function testEncodeFileWhenDataFormatIsNotSetAnFileHasNotExtension()
    {
        $this->expectException('\LogicException');

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data');

        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile function returns proper result
     * when data format hasn't been set
     * and encoder must recognize format by file extension.
     */
    public function testEncodeFileWhenDataFormatIsNotSet()
    {
        $expectedResult = "<FORMAT ENCODED DATA>Dummy data</FORMAT ENCODED DATA>";

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->encodeFile(array('Dummy data'), $dataFilePath);

        $actualResult = file_get_contents($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provide data formats
     * and expected results returned by proper encoders.
     *
     * @return array
     */
    public static function dataFormatsAndResultsProvider()
    {
        return array(
            array('format1', '<FORMAT 1 ENCODED DATA/>'),
            array('Format2', '<FORMAT 2 ENCODED DATA/>'),
            array('FORMAT3', '<FORMAT 3 ENCODED DATA/>'),
        );
    }

    /**
     * This method is called before the first test of this test class is run.
     */
    public static function setUpBeforeClass(): void
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->datafileEncoder = new DatafileEncoder();
    }
}
