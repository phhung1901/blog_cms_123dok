<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class PageCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:page_crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $html = (new Client([
            'verify' => false,
            'timeout' => 30, // 30 seconds
        ]))->get('https://topdev.vn/blog/oauth2-la-gi/')
            ->getBody()->getContents();

        dd($html);
//        return Command::SUCCESS;
    }
}
