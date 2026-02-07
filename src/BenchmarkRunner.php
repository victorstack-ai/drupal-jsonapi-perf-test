<?php

namespace DrupalJsonApiPerf;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class BenchmarkRunner
{
    private Client $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    public function runBenchmark(string $url, int $iterations = 5): array
    {
        $results = [
            'url' => $url,
            'iterations' => $iterations,
            'times' => [],
            'sizes' => [],
            'errors' => 0,
        ];

        for ($i = 0; $i < $iterations; $i++) {
            $start = microtime(true);
            try {
                $response = $this->client->get($url);
                $end = microtime(true);
                $results['times'][] = ($end - $start) * 1000; // ms
                $results['sizes'][] = strlen($response->getBody()->getContents());
            } catch (GuzzleException $e) {
                $results['errors']++;
            }
        }

        if (count($results['times']) > 0) {
            $results['avg_time'] = array_sum($results['times']) / count($results['times']);
            $results['avg_size'] = array_sum($results['sizes']) / count($results['sizes']);
        }

        return $results;
    }
}
