<?php

namespace App\Command;

use App\Manager\CountryManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

class ImportImportCountryCommand extends Command
{
    protected static $defaultName = 'import:import-country';

    private $countryManager;

    public function __construct(CountryManager $countryManager)
    {
        $this->countryManager = $countryManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Import countries from txt list')
            ->addArgument('list', InputArgument::REQUIRED, '.txt that contain countries name, one by line. Path from root project');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('list');

        // Open file
        $finder = new Finder();
        $finder->files()->in(__DIR__ . "\..\..\\")->name($arg1);

        foreach ($finder as $file) {
            $contents = $file->getContents();
            $contents = explode("\n", $contents);
            $this->countryManager->import($contents);
        }

        $io->success('Your contries has been imported');

        return 0;
    }


}
