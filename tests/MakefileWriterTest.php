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

    protected function setUp()
    {
        $this->writer = new MakefileWriter;
        $this->root   = vfsStream::setup();
    }

    public function testWritesMakefileCorrectly(): void
    {
        $actual = vfsStream::url('root') . '/Makefile';

        $this->writer->write($actual, 'phpunit', 'phpunit.xml');

        $this->assertFileEquals(__DIR__ . '/_expectation/Makefile', $actual);
    }
}
