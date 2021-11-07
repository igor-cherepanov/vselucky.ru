<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ParsePikinail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pikinail:parse-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function handle()
    {
        $siteLink = 'https://pikinail.ru/catalog/';
        $contentResponse = Http::get($siteLink);
        if ($contentResponse->ok()) {
            $content = $contentResponse->body();
            $crawler = new Crawler($content);
            $contentWrapper = $crawler->filterXPath('//div[contains(@class, "wrapper_inner")]')->first();
            $mainCategoriesNodes = $contentWrapper->filterXPath('//img[contains(@class, "img-responsive")]');
            $mainCategoriesData = $mainCategoriesNodes->each(function (Crawler $node, $i) {
                return [
                    'url'     => $node->parents()->attr('href'),
                    'img_src' => $node->attr('data-src'),
                    'name'    => $node->attr('alt'),
                ];
            });

            $mainCategories = [];
            foreach ($mainCategoriesData as $categoryData) {
                $category = Category::where('name', $categoryData['name'])->first();
                if ($category === null) {
                    /** @var Category $category */
                    $category = Category::create([
                        'piki_url'    => 'https://pikinail.ru' . $categoryData['url'],
                        'name'        => $categoryData['name'],
                        'description' => null,
                        'parent_id'   => null,
                        'img_url'     => 'https://pikinail.ru' . $categoryData['img_src'],
                    ]);
                    $mainCategories[] = $category;
                }
            }

            foreach ($mainCategories as $mainCategory) {
                $siteLink = $mainCategory->getPikiUrl();
                $contentResponse = Http::get($siteLink);
                if ($contentResponse->ok()) {
                    $content = $contentResponse->body();
                    $crawler = new Crawler($content);
                    $contentWrapper = $crawler->filterXPath('//div[contains(@class, "top-content-block")]')->first();
                    $categoriesNodes = $contentWrapper->filterXPath('//img[contains(@class, "img-responsive")]');
                    $categoriesData = $categoriesNodes->each(function (Crawler $node, $i) {
                        return [
                            'url'     => $node->parents()->attr('href'),
                            'img_src' => $node->attr('data-src'),
                            'name'    => $node->attr('alt'),
                        ];
                    });

                    $categories = [];
                    foreach ($categoriesData as $categoryData) {
                        $category = Category::where('name', $categoryData['name'])->first();
                        if ($category === null) {
                            /** @var Category $category */
                            $categoryChild = Category::create([
                                'piki_url'    => 'https://pikinail.ru' . $categoryData['url'],
                                'name'        => $categoryData['name'],
                                'description' => null,
                                'parent_id'   => $mainCategory->getKey(),
                                'img_url'     => 'https://pikinail.ru' . $categoryData['img_src'],
                            ]);
                            $categories[] = $categoryChild;
                        }
                    }
                }

            }
        }

        echo 'success';
    }
}
