<?php

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class ListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctrine:data-fixtures:list {group?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all groups or data-fixtures for a group';

    /**
     * @var string[]
     */
    protected array $config = [];

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
        }
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (! $this->argument('group')) {
            foreach ($this->config as $groupName => $groupConfig) {
                $this->info($groupName);
            }

            return 0;
        }

        foreach ($this->config['fixtures'] as $fixtureName) {
            $this->info($fixtureName);
        }

        return 0;
    }
}
