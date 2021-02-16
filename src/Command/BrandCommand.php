<?php


namespace App\Command;


use App\Entity\Brand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BrandCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @var array
     */
    protected array $brands = [
        'Renault',
        'Opel',
        'Mercedes',
        'Toyota',
        'Nissan',
        'Ford',
        'Ferrari',
        'Volkswagen',
        'Audi',
        'WackyRaces',
        'CTR',
    ];

    /**
     * CreateBrandCommand constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:brand')
            ->setDescription('Load the categories of the project');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating all brands...');
        // Output : où afficher la progressbar
        // duexième argument : sa taille max !
        // On créé la progress bar en se basant sur la taille de notre tableau de brands
        $progressBar = new ProgressBar($output, count($this->brands));
        $progressBar->start();
        // Pour chaque brand présente dans notre tableau
        foreach($this->brands as $brand) {
            // On créé une category et on la nomme avec notre brand en cours d'itération de la boucle
            $brandObject = new Brand();
            $brandObject->setName($brand);
            // On persist l'objet
            $this->em->persist($brandObject);
            // On avance la progressbar
            $progressBar->advance();
        }
        // On a finit, on peut terminer la progressbar
        $progressBar->finish();
        // On peut sauvegarder nos objets en base de données
        $this->em->flush();
        // Informer l'utilisateur que tout s'est bien passé
        $output->writeln('Brands created with success !');
        return command::SUCCESS;
    }
}
