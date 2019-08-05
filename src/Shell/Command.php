<?php

/**
 * @author Cassiano Vailati
 */
namespace As400Utils\Shell;
use As400Utils\XMLToolkit;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use As400Utils\Command as IBMCommand;

/**
 * IBMi Shell Command
 *
 * Runs a command in shell with support for Background execution with SBMJOB.
 *
 */
class Command implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /** @var XMLToolkit */
    protected $xmlToolkit;

    /** @var string */
    protected $jobQ = '';

    /**
     * Constructor.
     *
     * @param XMLToolkit $xmlToolkit
     * @param string $command The command to execute
     * @param LoggerInterface|null $logger
     * @param string $tempDir
     * @param string $jobQ
     */
    public function __construct(
        XMLToolkit $xmlToolkit,
        $command = null,
        LoggerInterface $logger = null,
        $tempDir = '/tmp',
        $jobQ = ''
    ) {
        parent::__construct($command, $logger, $tempDir);
        $this->xmlToolkit = $xmlToolkit;
        $this->jobQ = $jobQ;
    }

    /**
     * Runs the command in a background process.
     *
     * @return int|string
     */
    public function submit()
    {
        $commandString = $this->getSubmitCommandString();
        $command = new IBMCommand($this->xmlToolkit, $this->logger);
        $command->setCommand($commandString);

        if ($this->logger) $this->logger->info($commandString);

        return $command->exec();
    }

    /**
     * Returns the command string to execute
     *
     * @return string
     */
    public function getSubmitCommandString()
    {
        $commandString = parent::getCommandString($this->outputFile);
        $jobQString = !empty($this->jobQ) ? 'JOBQ('.$this->jobQ.')' : '';

        return "SBMJOB CMD(QSH CMD('$commandString')) INLLIBL(*JOBD) ".$jobQString; //USER(USERNAME)
    }
}
