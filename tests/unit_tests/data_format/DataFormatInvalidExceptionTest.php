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
 * DataFormatInvalidExceptionTest.
 * PHPUnit test class for DataFormatInvalidException class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFormatInvalidExceptionTest extends TestCase
{
    /**
     * Test if Exorg\DataCoder\DataFormatInvalidException class
     * has been created.
     */
    public function testDataFormatInvalidExceptionClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\DataFormatInvalidException')
        );
    }
}
