<?php


namespace App\Command;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CategoriesCommand.php
 *
 * @author Kevin Tourret
 */
class CategoriesCommand extends Command
{
    /**
     * @var EntityManagerInterface $em
     */
    private EntityManagerInterface $em;

    /**
     * @var string[] array categories
     */
    private $arrayCategories = [
        'Citadine',
        'SUV',
        'Pick up',
        'Break',
        'Monospace',
        'Berlines',
    ];

    /**
     * CategoriesCommand constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    /**
     * There we initialize the command we will use and named it
     */
    protected function configure()
    {
        $this
            ->setName('app:categories')
            ->setDescription('Load the categories of the project')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Creating all categories...');
        // Output : où afficher la progressbar
        // duexième argument : sa taille max !
        // On créé la progress bar en se basant sur la taille de notre tableau de categories
        $progressBar = new ProgressBar($output, count($this->arrayCategories));
        $progressBar->start();
        // Pour chaque categorie présente dans notre tableau
        foreach($this->arrayCategories as $category) {
            // On créé une category et on la nomme avec notre category en cours d'itération de la boucle
            $categObject = new Category();
            $categObject->setName($category);
            // On persist l'objet
            $this->em->persist($categObject);
            // On avance la progressbar
            $progressBar->advance();
        }
        // On a finit, on peut terminer la progressbar
        $progressBar->finish();
        // On peut sauvegarder nos objets en base de données
        $this->em->flush();
        // Informer l'utilisateur que tout s'est bien passé
        $output->writeln('Categories created with success !');
        return command::SUCCESS;
    }

}
