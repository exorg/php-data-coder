<?php

declare(strict_types=1);

/*
 * This file is part of the DataCoder package.
 *
 * (c) Katarzyna Krasińska <katheroine@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ExOrg\DataCoder\DataFormat;

use PHPUnit\Framework\TestCase;

/**
 * Data Format Invalid Exception Test.
 * PHPUnit test class for DataFormatInvalidException class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFormatInvalidExceptionTest extends TestCase
{
    const DATA_FORMAT_INVALID_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\DataFormat\DataFormatInvalidException';

    /**
     * Test if Data Format Invalid Exception class
     * has been created.
     */
    public function testDataFormatInvalidExceptionClassExists()
    {
        $this->assertTrue(
            class_exists(self::DATA_FORMAT_INVALID_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME)
        );
    }
}
