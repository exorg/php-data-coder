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

use Garoevans\PhpEnum\Enum;

/**
 * Data Format.
 * Data Formats enumeration.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class DataFormat extends Enum
{
    // phpcs:disable
    const __default = self::JSON;
    // phpcs:disable

    const JSON = "JSON";
    const YAML = "YAML";
    const YML = "YAML";
}
