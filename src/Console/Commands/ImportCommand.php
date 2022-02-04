<?php

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Purger\PurgerInterface;
use Doctrine\Persistence\ObjectManager;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctrine:data-fixtures:import {group} {--purge-with-truncate} {--do-not-append}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import a group of fixtures.';

    /**
     * @var string[]
     */
    protected array $config = [];

    protected ObjectManager $objectManager;

    protected Loader $loader;

    protected PurgerInterface $purger;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Application $application)
    {
        parent::__construct();

        $this->config = $application['config']['doctrine-data-fixtures'];

        if ($this->argument('group')) {
            if (! isset($this->config[$this->argument('group')])) {
                throw new \Exception('data-fixtures group does not exist');
            }

            $this->config = $this->config[$this->argument('group')];

            $this->objectManager = $application->get($this->config['objectManager']);
            $this->loader = $application->get($this->config['loader']);
            $this->purger = $application->get($this->config['purger']);
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($this->config['fixtures'] as $fixture) {
            $this->loader->addFixture($fixture);
        }

        // --purge-with-truncate is only valid for the ORMPurger
        if ($this->option('purge-with-truncate')) {
            $this->purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        }

        $this->executor->execute($this->loader->getFixtures(), ! $this->option('do-not-append'));

        $this->success('Fixtures loaded');

        return 0;
    }
}
