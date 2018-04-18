<?php


namespace Xervice\Database\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Xervice\Console\Command\AbstractCommand;

class MigrateCommand extends AbstractCommand
{

    protected function configure()
    {
        $this->setName('propel:migrate')
             ->setDescription('Migrate propel');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     * @throws \Core\Locator\Dynamic\ServiceNotParseable
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->migrate();
    }

}