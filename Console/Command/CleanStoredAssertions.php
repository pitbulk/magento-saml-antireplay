<?php
/**
 * SAML Extension for Magento2 which adds support to prevent Replay Attacks
 *
 * @package     Pitbulk_Antireplay
 * @copyright   Copyright (c) 2023 Sixto Martin Garcia (http://saml.info)
 * @license     Commercial
 */

namespace Pitbulk\Antireplay\Console\Command;

use Magento\Framework\Setup\SchemaSetupInterface;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CleanStoredAssertions extends Command
{
    public const COMMAND_NAME = 'antireplay:clean-assertions';
    public const TABLE_NAME = 'saml2_assertion';

    private $_setup;

    public function __construct(
        SchemaSetupInterface $setup
    )
    {
        $this->_setup = $setup;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription('This command belong the Pitbulk_Antireplay extension. It removes stored entries of the processed assertions.');
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
     protected function execute(InputInterface $input, OutputInterface $output): int
     {
        $exitCode = 0;
        try {
            $this->_setup->getConnection()->truncateTable(self::TABLE_NAME);
            $output->writeln(sprintf(
                '<comment>%s %s<comment>',
                self::TABLE_NAME,
                ' database truncated.'
            ));
        } catch (Exception $e) {
            $output->writeln(sprintf(
                '<error>%s</error>',
                $e->getMessage()
            ));
            $exitCode = 1;
        }
        return $exitCode;
     }
}
