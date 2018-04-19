<?php


namespace Xervice\Database\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Xervice\Console\Command\AbstractCommand;

class ModelBuildCommand extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('propel:model:build')
             ->setDescription('Generate propel models');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->getFacade()->buildModel() as $line) {
            $output->write($line);
        }
    }

}