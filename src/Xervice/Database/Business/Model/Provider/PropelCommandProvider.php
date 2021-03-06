<?php
declare(strict_types=1);


namespace Xervice\Database\Business\Model\Provider;


use Symfony\Component\Process\Process;

class PropelCommandProvider implements PropelCommandProviderInterface
{
    /**
     * @var string
     */
    private $propelCommand;

    /**
     * @var string
     */
    private $rootDirectory;

    /**
     * @var string
     */
    private $configDir;

    /**
     * @var array
     */
    private $result;

    /**
     * PropelCommandProvider constructor.
     *
     * @param string $propelCommand
     * @param string $rootDirectory
     * @param string $configDir
     */
    public function __construct(string $propelCommand, string $rootDirectory, string $configDir)
    {
        $this->propelCommand = $propelCommand;
        $this->rootDirectory = $rootDirectory;
        $this->configDir = $configDir;
    }


    /**
     * @param string $command
     *
     * @return array
     * @throws \Symfony\Component\Process\Exception\LogicException
     * @throws \Symfony\Component\Process\Exception\RuntimeException
     */
    public function execute(string $command) : array
    {
        $this->result = [];
        $process = new Process(
            $this->propelCommand . ' ' . $command . ' --config-dir=' . $this->configDir,
            $this->rootDirectory
        );

        $process->run([$this, 'handle']);

        return $this->result;
    }

    /**
     * @param mixed $type
     * @param mixed $buffer
     */
    public function handle($type, $buffer): void
    {
        $this->result[] = [
            'type' => $type,
            'buffer' => $buffer
        ];
    }
}
