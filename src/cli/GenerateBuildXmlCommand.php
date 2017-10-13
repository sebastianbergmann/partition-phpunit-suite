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

class GenerateBuildXmlCommand extends AbstractCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this->setName('generate-build-xml')
            ->setDescription('Generate build.xml file for use with Apache Ant')
             ->setDefinition(
                 [
                     new InputArgument(
                         'build-xml',
                         InputArgument::REQUIRED,
                         'Path to Apache Ant build.xml file that should be generated'
                     ),
                     new InputArgument(
                         'test-list-xml',
                         InputArgument::REQUIRED,
                         'Path to XML file generated using "phpunit --list-tests-xml"'
                     ),
                     new InputArgument(
                         'phpunit-binary',
                         InputArgument::REQUIRED,
                         'Path to PHPUnit binary to be used for parallel test execution'
                     ),
                     new InputArgument(
                         'phpunit-configuration',
                         InputArgument::REQUIRED,
                         'Path to PHPUnit XML configuration file to be used for parallel test execution'
                     )
                 ]
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
        if (!file_exists($input->getArgument('test-list-xml'))) {
            throw new RuntimeException(
                \sprintf(
                    'File "%s" does not exist',
                    $input->getArgument('test-list-xml')
                )
            );
        }

        $writer = new BuildXmlWriter;

        $writer->write(
            $input->getOption('build-xml'),
            $input->getArgument('phpunit-binary'),
            $input->getArgument('phpunit-configuration')
        );
    }
}
