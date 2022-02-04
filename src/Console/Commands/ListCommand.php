<?php

declare(strict_types=1);

namespace ApiSkeletons\Laravel\Doctrine\DataFixtures\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

class ListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctrine:data-fixtures:list
        {group? : The fixtures group name}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all groups or data-fixtures for a group';

    /** @var string[] */
    protected array $config = [];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->config = config('doctrine-data-fixtures');

        if ($this->argument('group')) {
            $this->config = $this->config[$this->argument('group')];
        }

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
