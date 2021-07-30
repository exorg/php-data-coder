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

/**
 * DataFileFixturesHelperTest.
 * PHPUnit base test class for
 * DataFileFixturesHelper.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFileFixturesHelperTest extends TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataFileFixturesHelper
     */
    private $dataFileFixturesHelper = null;

    /**
     * Test if Exorg\DataCoder\DataFileFixturesHelper class
     * has been created.
     */
    public function testDataCodersTestHelperClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataFileFixturesHelper')
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
                'Exorg\DataCoder\DataFileFixturesHelper',
                'setDataFormat'
            )
        );
    }

    /**
     * Test if loadEncodedData function
     * has been defined.
     */
    public function testLoadEncodedDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataFileFixturesHelper',
                'loadEncodedData'
            )
        );
    }

    /**
     * Test for function loadEncodedData
     * when improper format data has been set.
     *
     * @expectedException UnexpectedValueException
     */
    public function testLoadEncodedDataWithImproperDataFormat()
    {
        $this->dataFileFixturesHelper->setDataFormat('another');
        $actualData = $this->dataFileFixturesHelper->loadEncodedData();
    }

    /**
     * Test for function loadEncodedData.
     */
    public function testLoadEncodedData()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->dataFileFixturesHelper->setDataFormat('self-test');
        $actualData = $this->dataFileFixturesHelper->loadEncodedData();

        $this->assertEquals($expectedData, $actualData);
    }

    /**
     * Test if loadDecodedData function
     * has been defined.
     */
    public function testLoadDecodedDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataFileFixturesHelper',
                'loadDecodedData'
            )
        );
    }

    /**
     * Test for function loadDecodedData
     * when improper format data has been set.
     *
     * @expectedException UnexpectedValueException
     */
    public function testLoadDecodedDataWithImproperDataFormat()
    {
        $this->dataFileFixturesHelper->setDataFormat('another');
        $actualResult = $this->dataFileFixturesHelper->loadDecodedData();
    }

    /**
     * Test for function loadDecodedData.
     */
    public function testLoadDecodedData()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->dataFileFixturesHelper->setDataFormat('self-test');
        $actualResult = $this->dataFileFixturesHelper->loadDecodedData();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * Test if buildEncodedFilePath function
     * has been defined.
     */
    public function testBuildEncodedFilePathFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataFileFixturesHelper',
                'buildEncodedFilePath'
            )
        );
    }

    /**
     * Test if buildEncodedFilePath function
     * builds proper path.
     */
    public function testBuildEncodedFilePath()
    {
        $expectedPath = realpath(__DIR__ . '/../data/encoded/data.self-test');
        $actualPath = $this->dataFileFixturesHelper->buildEncodedFilePath('data.self-test');

        $this->assertEquals($expectedPath, $actualPath);
    }

    /**
     * Test if buildDecodedFilePath function
     * has been defined.
     */
    public function testBuildDecodedFilePathFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataFileFixturesHelper',
                'buildDecodedFilePath'
            )
        );
    }

    /**
     * Test if buildDecodedFilePath function
     * builds proper path.
     */
    public function testBuildDecodedFilePath()
    {
        $expectedPath = realpath(__DIR__ . '/../data/decoded/self-test.php');
        $actualPath = $this->dataFileFixturesHelper->buildDecodedFilePath('self-test.php');

        $this->assertEquals($expectedPath, $actualPath);
    }

    /**
     * Test if buildCreatedFilePath function
     * has been defined.
     */
    public function testBuildCreatedFilePathFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                'Exorg\DataCoder\DataFileFixturesHelper',
                'buildCreatedFilePath'
            )
        );
    }

    /**
     * Test if buildCreatedFilePath function
     * builds proper path.
     */
    public function testBuildCreatedFilePath()
    {
        $expectedPath = realpath(__DIR__ . '/../data/created/') . DIRECTORY_SEPARATOR . 'self-test';
        $actualPath = $this->dataFileFixturesHelper->buildCreatedFilePath('self-test');

        $this->assertEquals($expectedPath, $actualPath);
    }

    /**
     * Set up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Write content to the special self test file
     * from directory with encoded data.
     *
     * @param string $content
     */
    private function writeContentToSelfTestEncodedFile($content)
    {
        $filePath = __DIR__ . "/../data/encoded/data.self-test";
        file_put_contents($filePath, $content);
    }

    /**
     * Write result to the special self test file
     * from directory with decoded data.
     *
     * @param string $content
     */
    private function writeResultToSelfTestDecodedFile($result)
    {
        $content = "\$result = array(\n";
        foreach ($result as $key => $value) {
            $content .= "    '$key' => '$value',\n";
        }
        $content .= ');';

        $filePath = __DIR__ . "/../data/decoded/self-test.php";
        file_put_contents($filePath, $content);
    }
}
