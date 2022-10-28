<?php


namespace App\Libs;


use League\Uri\Uri;
use League\Uri\UriResolver;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerHelper
{
    public static function extractAttribute(Crawler $crawler, $filter, $attribute, $default = null): ?string
    {
        if (str_starts_with($filter, "/")) {
            $elm = $crawler->filterXPath($filter);
        } else {
            $elm = $crawler->filter($filter);
        }

        if ($elm->count() < 1) {
            return $default;
        }
        return match ($attribute) {
            'html' => $elm->html($default),
            'text', 'txt', 'content' => $elm->text($default),
            default => $elm->attr($attribute) ?? $default,
        };
    }

    public static function extractAttributes(Crawler $crawler, $filter, $attributes, $default = null): array
    {
        $results = [];
        $method = str_starts_with($filter, "/") ? "filterXPath" : "filter";
        $crawler->$method($filter)->each(function (Crawler $elm) use (&$results, $attributes, $default) {
            $row = [];
            foreach ($attributes as $attribute) {
                try {
                    $row[$attribute] = match ($attribute) {
                        'html' => $elm->html($default),
                        'text', 'txt', 'content' => $elm->text($default),
                        default => $elm->attr($attribute) ?? $default,
                    };
                } catch (\Exception $ex) {
                    $row[$attribute] = $default;
                }
            }
            $results[] = $row;
        });
        return $results;
    }

    public static function makeFullUrl($referer, $href)
    {
        $href = trim($href);
        $href = rtrim($href, "/");

        if (str_contains($href, "//")) {
            return $href;
        }

        $href = UriResolver::resolve(
            Uri::createFromString($href),
            Uri::createFromString($referer),
        )->__toString();

        return rtrim($href, "/");
    }

    public static function getUrl($refer, string $category, array $categories)
    {
        foreach ($categories as $cate) {
            if ($cate["text"] == $category) {
                $category_url = CrawlerHelper::makeFullUrl($refer, $cate['href']);
                return $category_url;
            }
        }
        return false;
    }

    public static function hasUrl(string $url): Boolean
    {
        return true;
    }
}
