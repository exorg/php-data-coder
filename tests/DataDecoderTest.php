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
     * Test setDataDecodingStrategy method
     * does't accept argument of incorrect type.
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetDataDecodingStrategyDoesNotAcceptIncorrectArgument()
    {
        $stdClassMock = $this->getMockBuilder('stdClass')
            ->getMock();

        $this->dataDecoder->setDataDecodingStrategy($stdClassMock);
    }

    /**
     * Test setDataDecodingStrategy method
     * accepts argument of Exorg\DataCoder\DataDecodingStrategyInterface interface.
     */
    public function testSetDataDecodingStrategyAcceptsCorrectArgument()
    {
        $dataParsingStrategyMock = $this->getMockBuilder('Exorg\DataCoder\DataDecodingStrategyInterface')
            ->getMock();

        $this->dataDecoder->setDataDecodingStrategy($dataParsingStrategyMock);
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
        $this->dataDecoder->setDataDecodingStrategy($this->dataDecodingStrategyMock);
    }
}
