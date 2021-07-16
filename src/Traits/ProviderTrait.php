<?php


namespace App\Traits;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait ProviderTrait
{

    /**
     * This function executes requests to external API and returns result
     * @param Client $client
     * @param string $keyword
     * @param string $path
     * @return int
     * @throws GuzzleException
     */
    public function getGuzzleResponse(Client $client, $path, string $keyword): int
    {

        $response = $client->request('GET', $path . $keyword,
            ['headers' =>
                 [
                     'Authorization' => 'Bearer ' . $_ENV['AUTH_TOKEN'],
                     'Content-Type'  => 'application/json',
                 ],
             'body'    => '',
            ]
        );

        $content = json_decode($response->getBody()->getContents());
        return $content->{'total_count'};

    }

    /**
     * This function calculates score based on relation count / totalCount
     * @param $rocksCount
     * @param $sucksCount
     * @return float
     */
    public function getRatingScore(int $rocksCount, int $sucksCount): float
    {

        $totalCount = $rocksCount + $sucksCount;
        return $totalCount > 0 ? round(($rocksCount / $totalCount) * 10, 2) : 0;


    }

}