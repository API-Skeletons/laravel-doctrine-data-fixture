<?php

namespace ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Console\Commands;

use ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\TestCase;

class ListCommandTest extends TestCase
{
    public function testListGroups(): void
    {
        $this->artisan('doctrine:data-fixtures:list', ['group' => null])
            ->expectsOutput('test1')
            ->expectsOutput('test2')
            ->doesntExpectOutput('test3')
            ->assertExitCode(0);
    }

    public function testListGroupFixtures(): void
    {
        $this->artisan('doctrine:data-fixtures:list', ['group' => 'test1'])
            ->expectsOutput('ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures\Fixture1')
            ->expectsOutput('ApiSkeletonsTest\Laravel\Doctrine\DataFixtures\Fixtures\Fixture2')
            ->doesntExpectOutput('test3')
            ->assertExitCode(0);
    }
}
