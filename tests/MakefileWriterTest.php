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

use PHPUnit\Framework\TestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

final class MakefileWriterTest extends TestCase
{
    /**
     * @var MakefileWriter
     */
    private $writer;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * @var string[]
     */
    private $tests;

    /**
     * @var string[]
     */
    private $groups;

    protected function setUp()
    {
        $this->writer = new MakefileWriter;
        $this->root   = vfsStream::setup();
        $this->tests  = \file(__DIR__ . '/_fixture/tests.txt');
        $this->groups = \file(__DIR__ . '/_fixture/groups.txt');
    }

    public function testWritesMakefileCorrectly(): void
    {
        $actual = vfsStream::url('root') . '/build.xml';

        $this->writer->write($actual, $this->tests, $this->groups, 'phpunit', 'phpunit.xml');

        $this->assertFileEquals(__DIR__ . '/_expectation/Makefile', $actual);
    }
}
