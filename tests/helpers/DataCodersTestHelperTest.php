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
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->dataCodersTestHelper = new DataCodersTestHelper();
    }
}
