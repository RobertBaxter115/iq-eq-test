<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateApiDocs extends Command
{
    protected $signature = 'api:docs';
    protected $description = 'Generate API documentation';

    public function handle()
    {
        $this->info('Generating API documentation...');

        $this->call('l5-swagger:generate');

        $this->info('API documentation generated successfully!');
        $this->info('You can view the documentation at: ' . config('app.url') . '/api/documentation');
    }
}
