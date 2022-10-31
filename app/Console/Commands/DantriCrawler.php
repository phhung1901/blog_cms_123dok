<?php

namespace App\Console\Commands;

use App\Http\Services\Admin\Post\PostService;
use App\Libs\CrawlerHelper;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Psy\Exception\TypeErrorException;
use Symfony\Component\DomCrawler\Crawler;

class DantriCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:dantri_crawler';

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
    protected $home = 'https://dantri.com.vn/';

    public function handle()
    {
        $data_post = $this->getPost("https://dantri.com.vn/kinh-doanh/khong-co-nguoi-mua-sieu-xe-rolls-royce-cua-ong-trinh-van-quyet-bi-ha-gia-20221024155906013.htm");
        PostService::createCrawPost($data_post);


        $categories = $this->getCategories();

        foreach ($categories as $category) {
            try {
                $posts = $this->getPosts($category["text"]);
            } catch (\Exception $e) {
                continue;
            }
            foreach ($posts[0] as $post) {
                try {
                    $url = CrawlerHelper::makeFullUrl($this->home, $post["href"]);
                    $this->info("Crawing url: " . $url);
                    PostService::createCrawPost($this->getPost($url));
                    $this->info("Done !");
                } catch (\Exception $e) {
                    continue;
                }
            }
        }
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

        $categories = CrawlerHelper::extractAttributes($dom, ".nf-menu > li > .nf-submenu > li > a", ['text', 'href']);

        return $categories;
    }

    protected function getPost(string $url)
    {
        $post_url = $this->getHtml($url);
        $dom = new Crawler($post_url);

        $category = $dom->filter(".breadcrumbs > li:last-child > a")->text();
        $tags = CrawlerHelper::extractAttributes($dom, ".tags-wrap > li > a", ['text']);
        $title = $dom->filter(".singular-container > .title-page")->text();
        $description = $dom->filter(".singular-container > .singular-sapo")->text();
        $contents = $dom->filter(".singular-container > .singular-content")->html();
        $thumb = $dom->filter(".singular-container > .singular-content > .image > img")->attr("src");

        return [$title, $description, $contents, $thumb, $category, $tags];
    }

    protected function getPosts(string $category)
    {
        $categories = $this->getCategories();
        $category_url = CrawlerHelper::getUrl($this->home, $category, $categories);

        $html = $this->getHtml($category_url);
        $dom = new Crawler($html);

        $posts = CrawlerHelper::extractAttributes($dom, ".article > .article-item > .article-content > .article-title > a", ["text", "href"]);
        return [$posts];
    }

    protected function getPaginates()
    {

    }
}
