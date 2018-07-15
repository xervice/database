<?php
declare(strict_types=1);


namespace Xervice\Database\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Command\AbstractCommand;

/**
 * @method \Xervice\Database\DatabaseFacade getFacade()
 */
class ModelBuildCommand extends AbstractCommand
{

    /**
     *
     * @throws \Symfony\Component\Console\Exception\InvalidArgumentException
     */
    protected function configure(): void
    {
        $this->setName('propel:model:build')
             ->setDescription('Generate propel models');
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
        foreach ($this->getFacade()->buildModel() as $line) {
            $output->write($line);
        }
    }
}
