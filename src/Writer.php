<?php declare(strict_types=1);
/*
 * This file is part of sebastian/partition-phpunit-suite.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\PartitionPhpunitSuite;

interface Writer
{
    /**
     * @param string   $filename
     * @param string[] $tests
     * @param string[] $groups
     * @param string   $phpunitBinary
     * @param string   $phpunitXml
     */
    public function write(string $filename, array $tests, array $groups, string $phpunitBinary, string $phpunitXml): void;
}
