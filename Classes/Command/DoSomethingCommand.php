<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

declare(strict_types=1);

/**
 * https://docs.typo3.org/m/typo3/reference-coreapi/13.4/en-us/ApiOverview/CommandControllers/Tutorial.html
 */

namespace VendorName\Sitepackage\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Call this command with:
 * typo3 sitepackage:dosomething anyArgument -o anyOptionValue
 * typo3 sitepackage:dosomething anyArgument --exampleOption=anyOptionValue
 */

/**
 * https://docs.typo3.org/m/typo3/reference-coreapi/13.4/en-us/ApiOverview/CommandControllers/Tutorial.html#console-command-tutorial-registration-attribute
 */
#[AsCommand(
    name: 'sitepackage:dosomething',
    description: 'A command that does nothing and always succeeds.',
    aliases: ['examples:dosomethingalias'],
)]
class DoSomethingCommand extends Command
{
    protected function configure(): void
    {
        $this->setHelp('This command does nothing. It always succeeds.')
            ->addArgument(
                'exampleArgument',
                InputArgument::OPTIONAL,
                'This is an example argument.'
            )
            ->addOption(
                'exampleOption',
                'o',
                InputOption::VALUE_OPTIONAL,
                'You can use --exampleOption or -o when running command'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $exampleArgument = $input->getArgument('exampleArgument');
        $io->writeln('<info>exampleArgument:</info> ' . $exampleArgument);

        $exampleOption = $input->getOption('exampleOption');
        $io->writeln('<info>exampleOption:</info> ' . $exampleOption);

        return Command::SUCCESS;
    }
}
