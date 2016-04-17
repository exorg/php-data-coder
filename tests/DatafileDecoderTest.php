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
 * DatafileDecoderTest.
 * PHPUnit test class for DatafileDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Relative path of directory with data fixtures
     * used in tests.
     */
    const DATA_FIXTURES_RELATIVE_PATH = 'data/encoded';

    /**
     * Instance of tested class.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Test Exorg\DataCoder\DatafileDecoder class
     * has been implemented.
     */
    public function testDatafileDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DatafileDecoder')
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
                $this->datafileDecoder,
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

        $this->datafileDecoder->setDataFormat($dataFormat);
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

        $this->datafileDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper property.
     *
     * @dataProvider dataFormatsResultsProvider
     */
    public function testSetDataFormatFunction($dataFormat, $expectedResult)
    {
        $dataFilePath = self::buildDataFixturePath('data.dummy');

        $this->datafileDecoder->setDataFormat($dataFormat);
        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if decodeFile($filePath) method
     * has been defined.
     */
    public function testDecodeFileFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->datafileDecoder,
                'decodeFile'
            )
        );
    }

    /**
     * Test decodeFile method throws exception
     * when file doesn't exist.
     *
     * @expectedException Exorg\DataCoder\FileException
     */
    public function testDecodeFileWhenFileDoesNotExist()
    {
        $dataFilePath = self::buildDataFixturePath('noexistent.dummy');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile method throws exception
     * when improper format has been set directly.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testDecodeFileWhenImproperFormatIsSet()
    {
        $dataFilePath = self::buildDataFixturePath('data.dummy');

        $this->datafileDecoder->setDataFormat('nonexistent');
        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile method properly decodes data file
     * when format has been set directly.
     */
    public function testDecodeFileWhenFormatIsSet()
    {
        $expectedResult = "<DUMMY DATA>Another dummy data</DUMMY DATA>";

        $dataFilePath = self::buildDataFixturePath('data.anotherdummy');

        $this->datafileDecoder->setDataFormat('dummy');
        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has improper extension.
     *
     * @expectedException Exorg\DataCoder\DecoderClassNotFoundException
     */
    public function testDecodeFileWhenFormatIsNotSetAndFileHasImproperExtension()
    {
        $dataFilePath = self::buildDataFixturePath('data.nonexistent');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function throws exception
     * when data format hasn't been set
     * and decoder must recognize format by file extension
     * but file has no extension.
     *
     * @expectedException \LogicException
     */
    public function testDecodeFileWhenFormatIsNotSetAnFileHasNotExtension()
    {
        $dataFilePath = self::buildDataFixturePath('data');

        $this->datafileDecoder->decodeFile($dataFilePath);
    }

    /**
     * Test decodeFile function returns proper result
     * when data format hasn't been set
     * and decoder must recognize format by file extension.
     */
    public function testDecodeFileWhenFormatIsNotSet()
    {
        $expectedResult = "<DUMMY DATA>Dummy data</DUMMY DATA>";

        $dataFilePath = self::buildDataFixturePath('data.dummy');

        $actualResult = $this->datafileDecoder->decodeFile($dataFilePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Provides data formats
     * and expected results returned by proper decoders.
     *
     * @return array
     */
    public function dataFormatsResultsProvider()
    {
        return array(
            array('dummy1', '<DUMMY 1 DATA/>'),
            array('dummy2', '<DUMMY 2 DATA/>'),
            array('dummy3', '<DUMMY 3 DATA/>'),
        );
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->datafileDecoder = new DatafileDecoder();
    }

    /**
     * Returns absolute path to the data fixture.
     *
     * @param string $dataFileName
     * @return string
     */
    private static function buildDataFixturePath($dataFileName)
    {
        $absoluteFilePath = __DIR__
            . DIRECTORY_SEPARATOR
            . self::DATA_FIXTURES_RELATIVE_PATH
            . DIRECTORY_SEPARATOR
            . $dataFileName;

        return $absoluteFilePath;
    }
}
