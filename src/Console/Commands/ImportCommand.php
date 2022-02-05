<?php

declare(strict_types=1);

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Illuminate\Console\Command;

use function app;
use function config;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctrine:data-fixtures:import
        {group : The fixtures group name}
        {--purge-with-truncate : if specified will purge the object manager tables before running fixtures for the ORMPurger only}
        {--do-not-append : will delete ALL data in the database before running fixtures}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a group of fixtures.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Init loader
        $config = config('doctrine-data-fixtures');

        if (! $this->argument('group')) {
            return 1;
        }

        if (! isset($config[$this->argument('group')])) {
            $this->error('data-fixtures group does not exist');

            return 1;
        }

        $config = $config[$this->argument('group')];

        $objectManager = app($config['objectManager']);
        $purger        = app($config['purger']);
        $executorClass = $config['executor'];
        $loader        = new Loader();

        $executor = new $executorClass($objectManager, $purger);

        foreach ($config['fixtures'] as $fixture) {
            $loader->addFixture(app($fixture));
        }

        // --purge-with-truncate is only valid for the ORMPurger
        if ($this->option('purge-with-truncate')) {
            $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        }

        $executor->execute($loader->getFixtures(), ! $this->option('do-not-append'));

        $this->info('Fixtures loaded');

        return 0;
    }
}
