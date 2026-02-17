<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanExpiredCookieConsents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cookie:clean-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean expired cookie consent records from database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // If you're storing consents in database, clean expired ones
        $this->info('Cleaning expired cookie consents...');
        
        // Example: Delete consents older than 365 days
        $deleted = DB::table('cookie_consents')
            ->where('created_at', '<', now()->subDays(365))
            ->delete();
        
        $this->info("Deleted {$deleted} expired cookie consents.");
        
        return Command::SUCCESS;
    }
}