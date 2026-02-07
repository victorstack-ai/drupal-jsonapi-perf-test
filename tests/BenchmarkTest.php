<?php

namespace DrupalJsonApiPerf\Tests;

use PHPUnit\Framework\TestCase;
use DrupalJsonApiPerf\BenchmarkRunner;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class BenchmarkTest extends TestCase
{
    public function testBenchmarkRunner()
    {
        $mock = new MockHandler([
            new Response(200, [], '{"data": []}'),
            new Response(200, [], '{"data": []}'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $runner = new BenchmarkRunner(['handler' => $handlerStack]);

        $results = $runner->runBenchmark('http://localhost', 2);

        $this->assertEquals(2, count($results['times']));
        $this->assertEquals(2, count($results['sizes']));
        $this->assertArrayHasKey('avg_time', $results);
        $this->assertArrayHasKey('avg_size', $results);
        $this->assertEquals(0, $results['errors']);
    }
}
