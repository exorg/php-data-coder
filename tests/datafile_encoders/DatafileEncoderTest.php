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

use Exorg\Decapsulator\ObjectDecapsulator;

/**
 * DatafileEncoderTest.
 * PHPUnit test class for DatafileEncoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileEncoderTest extends \PHPUnit_Framework_TestCase
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
     * has been implemented.
     */
    public function testDatafileEncoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DatafileEncoder')
        );
    }

    /**
     * Test if setDataFormat($dataFormat) method
     * has been defined.
     */
    public function testSetDataFormatFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->datafileEncoder,
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithEmptyDataFormat()
    {
        $dataFormat = '';

        $this->datafileEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDataFormatFunctionWithNullDataFormat()
    {
        $dataFormat = null;

        $this->datafileEncoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper property.
     *
     * @dataProvider dataFormatsResultsProvider
     */
    public function testSetDataFormatFunction($dataFormat, $expectedResult)
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->setDataFormat($dataFormat);
        $this->datafileEncoder->encodeFile(array('Dummy data'), $dataFilePath);

        $actualResult = file_get_contents($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if encodeFile($filePath) method
     * has been defined.
     */
    public function testEncodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->datafileEncoder,
                'encodeFile'
            )
        );
    }

    /**
     * Test encodeFile method throws exception
     * when improper format has been set directly.
     *
     * @expectedException Exorg\DataCoder\CoderClassNotFoundException
     */
    public function testEncodeFileWhenImproperFormatIsSet()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->setDataFormat('nonexistent');
        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile method properly encodes data file
     * when format has been set directly.
     */
    public function testEncodeFileWhenFormatIsSet()
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
     *
     * @expectedException Exorg\DataCoder\CoderClassNotFoundException
     */
    public function testEncodeFileWhenFormatIsNotSetAndFileHasImproperExtension()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.nonexistentformat');

        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile function throws exception
     * when data format hasn't been set
     * and encoder must recognize format by file extension
     * but file has no extension.
     *
     * @expectedException \LogicException
     */
    public function testEncodeFileWhenFormatIsNotSetAnFileHasNotExtension()
    {
        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data');

        $this->datafileEncoder->encodeFile(array(), $dataFilePath);
    }

    /**
     * Test encodeFile function returns proper result
     * when data format hasn't been set
     * and encoder must recognize format by file extension.
     */
    public function testEncodeFileWhenFormatIsNotSet()
    {
        $expectedResult = "<FORMAT ENCODED DATA>Dummy data</FORMAT ENCODED DATA>";

        $dataFilePath = self::$dataFileFixturesHelper->buildCreatedFilePath('data.format');

        $this->datafileEncoder->encodeFile(array('Dummy data'), $dataFilePath);

        $actualResult = file_get_contents($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provides data formats
     * and expected results returned by proper encoders.
     *
     * @return array
     */
    public function dataFormatsResultsProvider()
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
    public static function setUpBeforeClass()
    {
        self::$dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileEncoder = new DatafileEncoder();
    }
}
