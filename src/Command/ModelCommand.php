<?php


namespace App\Command;


use App\Entity\Brand;
use App\Service\ModelService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ModelCommand.php
 *
 * @author Kevin Tourret
 */
class ModelCommand extends Command
{
    /**
     * @var ModelService $modelService
     */
    private ModelService $modelService;

    /**
     * ModelCommand constructor.
     * @param ModelService $modelService
     */
    public function __construct(ModelService $modelService)
    {
        $this->modelService = $modelService;
        parent::__construct();
    }

    /**
     * Allow to execute an other Command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param string $command
     * @return int
     * @throws Exception
     */
    protected function executeCommand(InputInterface $input, OutputInterface $output, string $command): int
    {
        $command = $this->getApplication()->find($command);
        return $command->run($input, $output);
    }

    protected function configure()
    {
        $this
            ->setName('app:models')
            ->setDescription('Load the models of the project');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Creating all brands...');
        $this->executeCommand($input, $output, 'app:brand');
        $output->writeln('<info>Creating all categories...');
        $this->executeCommand($input, $output, 'app:categories');
        $output->writeln('<info>Creating all models...');
        $this->modelService->createModels();
        // Informer l'utilisateur que tout s'est bien passé
        $output->writeln('<info>Everything is created with success !');
        return command::SUCCESS;
    }
}
