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
class DataFileFixturesHelperTest extends \PHPUnit_Framework_TestCase
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
                $this->dataFileFixturesHelper,
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
                $this->dataFileFixturesHelper,
                'loadEncodedData'
            )
        );
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
     * Test for function loadEncodedData
     * when improper format data has been set.
     *
     * @expectedException UnexpectedValueException
     */
    public function testLoadEncodedDataWithImproperDataFormat()
    {
        $expectedData = (string) microtime();
        $this->writeContentToSelfTestEncodedFile($expectedData);

        $this->dataFileFixturesHelper->setDataFormat('another');
        $actualData = $this->dataFileFixturesHelper->loadEncodedData();
    }

    /**
     * Test if loadDecodedData function
     * has been defined.
     */
    public function testLoadDecodedDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataFileFixturesHelper,
                'loadDecodedData'
            )
        );
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
     * Test for function loadDecodedData
     * when improper format data has been set.
     *
     * @expectedException UnexpectedValueException
     */
    public function testLoadDecodedDataWithImproperDataFormat()
    {
        $expectedResult = array(
            'value' => (string) microtime(),
        );
        $this->writeResultToSelfTestDecodedFile($expectedResult);

        $this->dataFileFixturesHelper->setDataFormat('another');
        $actualResult = $this->dataFileFixturesHelper->loadDecodedData();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->dataFileFixturesHelper = new DataFileFixturesHelper();
    }

    /**
     * Writes content to the special self test file
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
     * Writes result to the special self test file
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
