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

namespace ExOrg\DataCoder;

use PHPUnit\Framework\TestCase;

/**
 * Coder Class Not Found Exception Test.
 * PHPUnit test class for CoderClassNotFoundException class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class CoderClassNotFoundExceptionTest extends TestCase
{
    const CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME = 'ExOrg\DataCoder\CoderBuilder\CoderClassNotFoundException';

    /**
     * Test if Coder Class Not Found Exception class
     * has been created.
     */
    public function testCoderClassNotFoundExceptionClassExists()
    {
        $this->assertTrue(
            class_exists(self::CODER_CLASS_NOT_FOUND_EXCEPTION_FULLY_QUALIFIED_CLASS_NAME)
        );
    }
}
