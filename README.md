# Drupal JSON:API Perf Test

A benchmarking tool to compare JSON:API normalization strategies. This tool allows you to run performance tests against Drupal JSON:API endpoints to measure response times, payload sizes, and compare different configurations (e.g., with/without specific includes, sparse fieldsets, or custom normalization decorators).

## Features

- Benchmark multiple JSON:API endpoints.
- Compare response times across different normalization strategies.
- Measure payload size impact.
- Export results to JSON/CSV (planned).

## Installation

```bash
composer install
```

## Usage

```bash
./bin/benchmark run https://example.com/jsonapi/node/article
```

## Running Tests

```bash
composer test
```
