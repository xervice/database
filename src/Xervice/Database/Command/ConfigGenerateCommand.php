<?php


namespace Xervice\Database\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;

class ConfigGenerateCommand extends AbstractCommand
{

    protected function configure()
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