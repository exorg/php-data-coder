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
 * DatafileDecoderForYamlTest.
 * PHPUnit test class for DatafileDecoder class
 * for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DatafileDecoderForYamlTest extends \PHPUnit_Framework_TestCase
{
    use CheckingDataDecodingResultTrait;

    /**
     * Relative path to the fixture of decoded datafile
     * with format extension.
     */
    const FIXTURE_EXT_FILE = 'fixtures/data.yaml';

    /**
     * Relative path to the fixture of decoded datafile
     * without format extension.
     */
    const FIXTURE_NOEXT_FILE = 'fixtures/data-yaml';


    /**
     * File decoder object.
     *
     * @var DatafileDecoder
     */
    private $datafileDecoder;

    /**
     * Test decodeFile method properly decodes data file.
     */
    public function testParseFile()
    {
        $filePath = $this->provideFileWithExtensionPath();

        $expectedResult = $this->provideExpectedResultOfDecodedData();
        $actualResult = $this->datafileDecoder->decodeFile($filePath);

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test decodeFile method properly decodes data file
     * when format has been set.
     */
    public function testParseFileWhenFormatIsSet()
    {
        $filePath = $this->provideFileWithNoExtensionPath();

        $expectedResult = $this->provideExpectedResultOfDecodedData();
        $this->datafileDecoder->setDataFormat('YAML');
        $actualResult = $this->datafileDecoder->decodeFile($filePath);

        $this->assertEquals($expectedResult, $actualResult);
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
     * Provide YAML file with format extension path.
     */
    protected function provideFileWithExtensionPath()
    {
        $filePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . self::FIXTURE_EXT_FILE;

        return $filePath;
    }

    /**
     * Provide YAML file without format extension path.
     */
    protected function provideFileWithNoExtensionPath()
    {
        $filePath = (__DIR__)
            . DIRECTORY_SEPARATOR
            . self::FIXTURE_NOEXT_FILE;

        return $filePath;
    }
}
