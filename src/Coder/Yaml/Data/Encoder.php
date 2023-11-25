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

namespace ExOrg\DataCoder\Coder\Yaml\Data;

use ExOrg\DataCoder\Coder\Data\AbstractEncoder;
use ExOrg\DataCoder\Coder\Data\EncodingStrategyInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Yaml Data Encoder.
 * Data encoder for YAML format.
 *
 * @package DataCoder
 * @author Katarzyna Krasińska <katheroine@gmail.com>
 * @copyright Copyright (c) 2015-2023 Katarzyna Krasińska
 * @license http://opensource.org/licenses/MIT MIT License
 * @link https://github.com/ExOrg/php-data-coder
 */
class Encoder extends AbstractEncoder implements EncodingStrategyInterface
{
    /**
     * Encode given PHP array to YAML data.
     *
     * @param array $data
     *
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function encodeData(array $data): string
    {
        $this->validateData($data);

        $encodedData = Yaml::dump($data);

        return $encodedData;
    }
}
