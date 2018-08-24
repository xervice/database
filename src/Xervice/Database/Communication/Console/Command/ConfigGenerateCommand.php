<?php
declare(strict_types=1);


namespace Xervice\Database\Communication\Console\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Business\Model\Command\AbstractCommand;

/**
 * @method \Xervice\Database\Business\DatabaseFacade getFacade()
 */
class ConfigGenerateCommand extends AbstractCommand
{

    /**
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('propel:config:generate')
             ->setDescription('Generate propel config files from project config');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->generateConfig();
    }
}
