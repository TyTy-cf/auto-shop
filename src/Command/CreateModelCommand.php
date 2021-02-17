<?php


namespace App\Command;

use App\Service\ModelService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateModelCommand extends Command
{
    private ModelService $service;

    /**
     * CreateModelCommand constructor.
     * @param ModelService $service
     */
    public function __construct(ModelService $service)
    {
        $this->service = $service;
        parent::__construct();
    }


    /**
     * There we initialize the command we will use and named it
     */
    protected function configure()
    {
        $this
            ->setName('app:model')
            ->setDescription('Load the models of the project')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating all models...');
        $this->service->createModels();
        $output->writeln('models created with success !');
        return command::SUCCESS;
    }
}
