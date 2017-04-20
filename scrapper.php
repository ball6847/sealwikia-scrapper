<?php

use GuzzleHttp\Client as HttpClient;
use Symfony\Component\DomCrawler\Crawler;

class Scrapper
{
    protected $baseUrl = 'http://sealonline.wikia.com/wiki/';

    public function getMonsterDetail($monsterUid)
    {
        $url = $this->baseUrl . $monsterUid;

        $client = new HttpClient();

        $response = $client->request('GET', $url);
       
        $responseBody = (string) $response->getBody();

        $crawler = new Crawler($responseBody);

        $monster = new stdClass;
        $monster->name = trim($crawler->filter('.header-column.header-title')->first()->text());

        $table = $crawler->filter('#mw-content-text table[border="1"]');

        $monster->level = trim($table->filter('tr:nth-child(3) td:nth-child(2)')->text());
        $monster->attribute = trim($table->filter('tr:nth-child(4) td:nth-child(2)')->text());
        $monster->hp = trim($table->filter('tr:nth-child(5) td:nth-child(2)')->text());
        $monster->atk = trim($table->filter('tr:nth-child(6) td:nth-child(2)')->text());
        $monster->def = trim($table->filter('tr:nth-child(7) td:nth-child(2)')->text());
        $monster->speed = trim($table->filter('tr:nth-child(8) td:nth-child(2)')->text());
        $monster->range = trim($table->filter('tr:nth-child(9) td:nth-child(2)')->text());

        var_dump($monster);
    }
}
