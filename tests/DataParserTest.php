<?php

/*
 * This file is part of the DatafilesParser package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exorg\DatafilesParser;

/**
 * DataParserTest.
 * PHPUnit test class for DataParser class.
 *
 * @package DatafilesParser
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-datafiles-parser
 */
class DataParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Relative path to the fixture of parsing data file.
     */
    const FIXTURE_FILE = 'fixtures/data';

    /**
     * Instance of tested class.
     *
     * @var DataParser
     */
    private $dataParser;

    /**
     * Data parsing strategy mock.
     * Mocked DataParsingStrategyInterface.
     *
     * @var mixed
     */
    private $dataParsingStrategyMock;

    /**
     * Test Exorg\DatafilesParser\DataParser class
     * has been implemented.
     */
    public function testDataParserClassExists()
    {
        $dataParser = new dataParser();

        $this->assertInstanceOf('Exorg\DatafilesParser\DataParser', $dataParser);
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

        $this->dataParser->setDataParsingStrategy($stdClassMock);
    }

    /**
     * Test setDataParsingStrategy method
     * accepts argument of Exorg\DatafilesParser\DataParsingStrategyInterface interface.
     */
    public function testSetDataParsingStrategyAcceptsCorrectArgument()
    {
        $dataParsingStrategyMock = $this->getMockBuilder('Exorg\DatafilesParser\DataParsingStrategyInterface')
            ->getMock();

        $this->dataParser->setDataParsingStrategy($dataParsingStrategyMock);
    }

    /**
     * Test parse data returns proper result.
     */
    public function testParseData()
    {
        $this->setUpDataParsingStrategyForParseDataTest();
        $this->setUpDataParserWithStrategy();

        $data = $this->provideParsedData();

        $expectedResult = $this->provideExpectedResultOfParseData();
        $actualResult = $this->dataParser->parseData($data);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->initialiseDataParser();
        $this->initialiseDataParsingStrategyMock();
    }

    /**
     * Initialise data parser fixture.
     */
    private function initialiseDataParser()
    {
        $this->dataParser = new DataParser();
    }

    /**
     * Initialise data parsing strategy mock.
     */
    private function initialiseDataParsingStrategyMock()
    {
        $this->dataParsingStrategyMock = $this->getMockBuilder('Exorg\DatafilesParser\DataParsingStrategyInterface')
            ->setMethods(array('parseData'))
            ->getMock();
    }

    /**
     * Set up DataParsingStrategy mock
     * and prepare for configure DataParser with it
     * to test parseData method.
     */
    private function setUpDataParsingStrategyForParseDataTest()
    {
        $this->dataParsingStrategyMock
            ->expects($this->once())
            ->method('parseData')
            ->with('result -> success')
            ->will(
                $this->returnValue($this->provideExpectedResultOfParseData())
            );
    }

    /**
     * Set up DataParser with DataParsingStrategy mock.
     */
    private function setUpDataParserWithStrategy()
    {
        $this->dataParser->setDataParsingStrategy($this->dataParsingStrategyMock);
    }

    /**
     * Provide expected result of testing parseData method.
     */
    private function provideExpectedResultOfParseData()
    {
        $expectedResult = array('result' => 'success');

        return $expectedResult;
    }

    /**
     * Provide data for the parsing process.
     *
     * @return array()
     */
    private function provideParsedData()
    {
        $this->turnOffErrors();

        $dataFileContent = $this->readDataContent();
        $dataReadCorrectly = ($dataFileContent !== false);

        if (! $dataReadCorrectly) {
            $this->fail("Data file cannot be read.");
        }

        return $dataFileContent;
    }

    /**
     * Read content of the fixture data file
     * destined for parsing.
     *
     * @return string
     */
    private function readDataContent()
    {
        $dataFilePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . self::FIXTURE_FILE;

        $dataFileContent = file_get_contents($dataFilePath);

        return $dataFileContent;
    }

    /**
     * Turn off errors reporting.
     */
    private function turnOffErrors()
    {
        $emptyFunction = function () {};

        set_error_handler($emptyFunction);

        error_reporting();
    }
}
