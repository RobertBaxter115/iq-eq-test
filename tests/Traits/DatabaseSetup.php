<?php

namespace Tests\Traits;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

trait DatabaseSetup
{
    protected static $migrated = false;

    public function setUpDatabase()
    {
        if (!static::$migrated) {
            // Ensure we're using SQLite in-memory database
            config(['database.default' => 'sqlite']);
            config(['database.connections.sqlite.database' => ':memory:']);
            
            // Run migrations without seeding
            Artisan::call('migrate:fresh');
            
            static::$migrated = true;
        }
    }

    protected function tearDown(): void
    {
        // Clean up the in-memory database after each test
        if (DB::connection()->getDatabaseName() === ':memory:') {
            DB::disconnect();
        }
        
        parent::tearDown();
    }
}
