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
 * DataDecoderTest.
 * PHPUnit test class for DataDecoder class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataDecoderTest extends AbstractDataDecoderTest
{
    /**
     * Relative path to the fixture of decoded data file.
     */
    const FIXTURE_FILE = 'fixtures/data';

    /**
     * Instance of tested class.
     *
     * @var DataDecoder
     */
    private $dataDecoder;

    /**
     * Wrapped by decapsulator
     * tested class instance,
     * with non-public functions and properties
     * accessible.
     *
     * @var ExOrg\Decapsulator\ObjectDecapsulator
     */
    private $dataDecoderDecapsulated;

    /**
     * Data decoding strategy mock.
     * Mocked DataDecodingStrategyInterface.
     *
     * @var mixed
     */
    private $dataDecodingStrategyMock;

    /**
     * Test Exorg\DataCoder\DataDecoder class
     * has been implemented.
     */
    public function testDataDecoderClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataDecoder')
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
                $this->dataDecoder,
                'setDataFormat'
            )
        );
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper property.
     */
    public function testSetDataFormatFunction()
    {
        $expectedDataFormat = 'FIRSTNONEXISTENT';

        $this->dataDecoder->setDataFormat($expectedDataFormat);

        $actualDataFormat = $this->dataDecoderDecapsulated->dataFormat;

        $this->assertEquals($expectedDataFormat, $actualDataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException Exorg\DataCoder\DataFormatInvalidException
     */
    public function testSetDataFormatFunctionWithEmptyDataFormat()
    {
        $dataFormat = '';

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     *
     * @expectedException Exorg\DataCoder\DataFormatInvalidException
     */
    public function testSetDataFormatFunctionWithNullDataFormat()
    {
        $dataFormat = null;

        $this->dataDecoder->setDataFormat($dataFormat);
    }

    /**
     * Test setDataFormat($dataFormat) method
     * sets proper decoding strategy.
     */
    public function testSetDataFormatFunctionSetsDecodingStrategy()
    {
        $dataFormat = 'FIRSTNONEXISTENT';

        $this->dataDecoder->setDataFormat($dataFormat);

        $dataDecodingStrategy = $this->dataDecoderDecapsulated->dataDecodingStrategy;

        $this->assertInstanceOf('\Exorg\DataCoder\FirstnonexistentDataDecoder', $dataDecodingStrategy);
    }

    /**
     * Test decode data returns proper result.
     */
    public function testDecodeData()
    {
        $this->setUpDataDecodingStrategyForDecodeDataTest();
        $this->setUpDataDecoderWithStrategy();

        $data = $this->provideDecodedData();

        $expectedResult = $this->provideExpectedResultOfDecodedData();
        $actualResult = $this->dataDecoder->decodeData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDataDecoder();
        $this->initialiseDataDecoderDecapsulated();
        $this->initialiseDataDecodingStrategyMock();
    }

    /**
     * Provide relative path
     * of the data file used for decoding strategy test.
     *
     * @return string
     */
    protected function provideFixtureFilePath()
    {
        return self::FIXTURE_FILE;
    }

    /**
     * Initialise DataDecoder fixture.
     */
    private function initialiseDataDecoder()
    {
        $this->dataDecoder = new DataDecoder();
    }

    /**
     * Initialise DataDecoderDecapsulated fixture.
     */
    private function initialiseDataDecoderDecapsulated()
    {
        $this->dataDecoderDecapsulated = ObjectDecapsulator::buildForObject($this->dataDecoder);
    }

    /**
     * Initialise data decoding strategy mock.
     */
    private function initialiseDataDecodingStrategyMock()
    {
        $this->dataDecodingStrategyMock = $this->getMockBuilder('Exorg\DataCoder\DataDecodingStrategyInterface')
            ->setMethods(array('decodeData'))
            ->getMock();
    }

    /**
     * Set up DataDecodingStrategy mock
     * and prepare for configure DataDecoder with it
     * to test decodeData method.
     */
    private function setUpDataDecodingStrategyForDecodeDataTest()
    {
        $this->dataDecodingStrategyMock
            ->expects($this->once())
            ->method('decodeData')
            ->with('result -> success')
            ->will(
                $this->returnValue($this->provideExpectedResultOfDecodedData())
            );
    }

    /**
     * Set up DataDecoder with DataDecodingStrategy mock.
     */
    private function setUpDataDecoderWithStrategy()
    {
        $this->dataDecoderDecapsulated->dataDecodingStrategy = $this->dataDecodingStrategyMock;
    }
}
