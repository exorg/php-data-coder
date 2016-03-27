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
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data';

    /**
     * Instance of tested class.
     *
     * @var DataDecoder
     */
    private $dataDecoder;

    /**
     * Data parsing strategy mock.
     * Mocked DataParsingStrategyInterface.
     *
     * @var mixed
     */
    private $dataParsingStrategyMock;

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
     * Test setDataParsingStrategy method
     * does't accept argument of incorrect type.
     *
     * @expectedException PHPUnit_Framework_Error
     */
    public function testSetDataParsingStrategyDoesNotAcceptIncorrectArgument()
    {
        $stdClassMock = $this->getMockBuilder('stdClass')
            ->getMock();

        $this->dataDecoder->setDataParsingStrategy($stdClassMock);
    }

    /**
     * Test setDataParsingStrategy method
     * accepts argument of Exorg\DataCoder\DataParsingStrategyInterface interface.
     */
    public function testSetDataParsingStrategyAcceptsCorrectArgument()
    {
        $dataParsingStrategyMock = $this->getMockBuilder('Exorg\DataCoder\DataParsingStrategyInterface')
            ->getMock();

        $this->dataDecoder->setDataParsingStrategy($dataParsingStrategyMock);
    }

    /**
     * Test decode data returns proper result.
     */
    public function testDecodeData()
    {
        $this->setUpDataParsingStrategyForDecodeDataTest();
        $this->setUpDataDecoderWithStrategy();

        $data = $this->provideDecodedData();

        $expectedResult = $this->provideExpectedResultOfDecodedData();
        $actualResult = $this->dataDecoder->parseData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDataDecoder();
        $this->initialiseDataParsingStrategyMock();
    }

    /**
     * Provide relative path
     * of the data file used for parsing strategy test.
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
     * Initialise data parsing strategy mock.
     */
    private function initialiseDataParsingStrategyMock()
    {
        $this->dataParsingStrategyMock = $this->getMockBuilder('Exorg\DataCoder\DataParsingStrategyInterface')
            ->setMethods(array('decodeData'))
            ->getMock();
    }

    /**
     * Set up DataParsingStrategy mock
     * and prepare for configure DataDecoder with it
     * to test decodeData method.
     */
    private function setUpDataParsingStrategyForDecodeDataTest()
    {
        $this->dataParsingStrategyMock
            ->expects($this->once())
            ->method('decodeData')
            ->with('result -> success')
            ->will(
                $this->returnValue($this->provideExpectedResultOfDecodedData())
            );
    }

    /**
     * Set up DataDecoder with DataParsingStrategy mock.
     */
    private function setUpDataDecoderWithStrategy()
    {
        $this->dataDecoder->setDataParsingStrategy($this->dataParsingStrategyMock);
    }
}
