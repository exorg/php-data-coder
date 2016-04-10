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
 * NonexistentFileExceptionTest.
 * PHPUnit test class for NonexistentFileException class.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class NonexistentFileExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test if Exorg\DataCoder\NonexistentFileExceptionTest class
     * has been created.
     */
    public function testNonexistentFileExceptionTestClassExists()
    {
        $this->assertTrue(
            class_exists('Exorg\DataCoder\NonexistentFileException')
        );
    }
}
