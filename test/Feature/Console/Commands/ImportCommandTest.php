<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Console\Commands;

use ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\TestCase;

class ImportCommandTest extends TestCase
{
    public function testImportGroup(): void
    {
        $this->createDatabase();

        $this->artisan('doctrine:data-fixtures:import', ['group' => 'test1'])
            ->expectsOutput('Fixtures loaded')
            ->assertExitCode(0);
    }

    public function testEmptyGroup(): void
    {
        $this->createDatabase();

        $this->artisan('doctrine:data-fixtures:import', ['group' => null])
            ->assertExitCode(1);
    }

    public function testInvalidGroup(): void
    {
        $this->createDatabase();

        $this->artisan('doctrine:data-fixtures:import', ['group' => 'invalid'])
            ->expectsOutput('data-fixtures group does not exist')
            ->assertExitCode(1);
    }

    public function testPurgeWithTruncate(): void
    {
        $this->createDatabase();

        $this->artisan('doctrine:data-fixtures:import', ['group' => 'test1', '--purge-with-truncate' => true])
            ->expectsOutput('Fixtures loaded')
            ->assertExitCode(0);
    }

    public function testDoNotAppend(): void
    {
        $this->createDatabase();

        $this->artisan('doctrine:data-fixtures:import', ['group' => 'test1', '--do-not-append' => true])
            ->expectsOutput('Fixtures loaded')
            ->assertExitCode(0);
    }
}
