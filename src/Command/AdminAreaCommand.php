<?php

namespace App\Command;

use App\Service\AdministrativeArea\AdminAreaImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AdminAreaCommand extends Command
{
    protected static $defaultName = 'app:admin-area';
    protected static $defaultDescription = 'Import french administrative area';


    private AdminAreaImportService $adminAreaImportService;

    /**
     * AdminAreaCommand constructor.
     * @param AdminAreaImportService $adminAreaImportService
     */
    public function __construct(AdminAreaImportService $adminAreaImportService)
    {
        parent::__construct();
        $this->adminAreaImportService = $adminAreaImportService;
    }


    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->adminAreaImportService->importRegions();
        $this->adminAreaImportService->importDepartments();

        $io->success('Import done');

        return Command::SUCCESS;
    }
}
