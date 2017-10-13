<?php declare(strict_types=1);
/*
 * This file is part of sebastian/partition-phpunit-suite.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\PartitionPhpunitSuite\Cli;

use SebastianBergmann\PartitionPhpunitSuite\BuildXmlWriter;
use SebastianBergmann\PartitionPhpunitSuite\MakefileWriter;
use SebastianBergmann\PartitionPhpunitSuite\RuntimeException;
use Symfony\Component\Console\Command\Command as AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class Command extends AbstractCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('partition-phpunit-suite')
             ->setDefinition(
                 [
                   new InputArgument(
                       'test-xml',
                       InputArgument::REQUIRED
                   ),
                   new InputArgument(
                       'phpunit-binary',
                       InputArgument::REQUIRED
                   ),
                   new InputArgument(
                       'phpunit-xml',
                       InputArgument::REQUIRED
                   )
                 ]
             )
             ->addOption(
                 'build-xml',
                 null,
                 InputOption::VALUE_REQUIRED,
                 'Generate build.xml for use with Apache Ant'
             )
             ->addOption(
                 'makefile',
                 null,
                 InputOption::VALUE_REQUIRED,
                 'Generate Makefile for use with GNU make'
             );
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @return null|int null or 0 if everything went fine, or an error code
     *
     * @throws RuntimeException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists($input->getArgument('test-xml'))) {
            throw new RuntimeException(
                \sprintf(
                    'File "%s" does not exist',
                    $input->getArgument('test-xml')
                )
            );
        }

        if ($input->getOption('build-xml')) {
            $writer = new BuildXmlWriter;

            $writer->write(
                $input->getOption('build-xml'),
                $input->getArgument('phpunit-binary'),
                $input->getArgument('phpunit-xml')
            );
        }

        if ($input->getOption('makefile')) {
            $writer = new MakefileWriter;

            $writer->write(
                $input->getOption('makefile'),
                $input->getArgument('phpunit-binary'),
                $input->getArgument('phpunit-xml')
            );
        }
    }
}
