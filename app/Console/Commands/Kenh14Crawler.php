<?php

namespace App\Console\Commands;

use App\Libs\CrawlerHelper;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class Kenh14Crawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:kenh14_crawler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * The home page url.
     *
     * @var string
     */
    protected $home = 'https://kenh14.vn/';


    public function handle()
    {
//        $this->getCategories();
        $this->getPosts('https://kenh14.vn/den-thac-tinh-yeu-o-sapa-lang-nghe-chuyen-tinh-cua-nang-tien-va-chang-tieu-phu-20221026112541057.chn');
    }

    protected function getHtml(string $url): string
    {
        $html = (new Client([
            'verify' => false,
            'timeout' => 30, // 30 seconds
        ]))->get($url)
            ->getBody()->getContents();

        return $html;
    }

    protected function getCategories()
    {
        $home_html = $this->getHtml($this->home);
        $dom = new Crawler($home_html);

        $categories = CrawlerHelper::extractAttributes($dom, ".kbh-menu-list > li a", ['text', 'href']);

        $craw = array_map(function ($item) {
            return CrawlerHelper::makeFullUrl($this->home, $item['href']);
        }, $categories);

        dd($categories);
    }

    protected function getPosts(string $url)
    {
        $post_url = $this->getHtml($url);
        $dom = new Crawler($post_url);

        $category = $dom->filter(".kbh-menu-list > .active > a")->text();
        $tags = CrawlerHelper::extractAttributes($dom, ".klw-new-tags > .knt-list > li > a", ['text', 'href']);
        $title = $dom->filter(".kbwc-title")->text();
        $contents = $dom->filter(".knc-content")->html();

        dd($title);
    }
}
