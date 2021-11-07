<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ParsePikinailProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pikinail:parse-products';

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

    public function handle()
    {
        $categories = Category::get();
        foreach ($categories as $category) {
            /** @var Category $category */
            $siteLink = $category->getPikiUrl() . '?SHOWALL_1=1';
            $contentResponse = Http::get($siteLink);
            if ($contentResponse->ok()) {
                $content = $contentResponse->body();
                $crawler = new Crawler($content);
                $contentWrapper = $crawler->filterXPath('//div[contains(@class, "items_wrapper")]')->first();
                $productsNodesData = $contentWrapper->filterXPath('//div[contains(@class, "catalog-block-view__item")]')
                    ->each(function (Crawler $node, $i) {
                        $imgNode = $node->filterXPath('//img[contains(@class, "img-responsive")]')->first();
                        $priceNode = $node->filterXPath('//span[contains(@class, "price_value")]')->first();
                        $urlNode = $node->filterXPath('//a[contains(@class, "thumb")]')->first();

                        try {
                            $result = [
                                'url'     => $urlNode->attr('href'),
                                'img_src' => $imgNode->attr('data-src'),
                                'name'    => $imgNode->attr('alt'),
                                'price'   => (int)$priceNode->html(),
                            ];

                        }catch (\Exception $exception){
                            dd($i);
                        }

                        return $result;
                    });


                $products = [];
                foreach ($productsNodesData as $productData) {
                    $category = Product::where('name', $productData['name'])->first();
                    if ($category === null) {
                        /** @var Product $product */
                        $product = Product::create([
                            'piki_url'    => 'https://pikinail.ru' . $productData['url'],
                            'name'        => $productData['name'],
                            'description' => null,
                            'price'       => $productData['price'],
                            'img_url'     => 'https://pikinail.ru' . $productData['img_src'],
                        ]);
                        $products[] = $product;
                    }
                }
            }

        }

    }
}
