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
 * DataCodersTestHelperTest.
 * PHPUnit base test class for
 * DataCodersTestHelper.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataCodersTestHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of tested class.
     *
     * @var DataCodersTestHelper
     */
    private $dataCodersTestHelper = null;

    /**
     * Test if Exorg\DataCoder\DataCodersTestHelper class
     * has been created.
     */
    public function testDataCodersTestHelperClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataCodersTestHelper')
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
                $this->dataCodersTestHelper,
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
                $this->dataCodersTestHelper,
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

        $this->dataCodersTestHelper->setDataFormat('self-test');
        $actualData = $this->dataCodersTestHelper->loadEncodedData();

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

        $this->dataCodersTestHelper->setDataFormat('another');
        $actualData = $this->dataCodersTestHelper->loadEncodedData();
    }

    /**
     * Test if loadDecodedData function
     * has been defined.
     */
    public function testLoadDecodedDataFunctionExists()
    {
        $this->assertTrue(
            method_exists(
                $this->dataCodersTestHelper,
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

        $this->dataCodersTestHelper->setDataFormat('self-test');
        $actualResult = $this->dataCodersTestHelper->loadDecodedData();

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

        $this->dataCodersTestHelper->setDataFormat('another');
        $actualResult = $this->dataCodersTestHelper->loadDecodedData();
    }

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->dataCodersTestHelper = new DataCodersTestHelper();
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
