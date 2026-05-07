# Integration: Firecrawl

Firecrawl v2 integration for OpenCompany agents: scrape, search, crawl, map, batch scrape, extract, agent jobs, browser sessions, and team usage APIs.

## Configuration

```php
return [
    'firecrawl' => [
        'api_key' => env('FIRECRAWL_API_KEY'),
        'url' => env('FIRECRAWL_URL', 'https://api.firecrawl.dev/v2'),
    ],
];
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `firecrawl_scrape` | read | Scrape a single URL |
| `firecrawl_search` | read | Search the web and optionally scrape results |
| `firecrawl_crawl` | read | Start a crawl job |
| `firecrawl_get_crawl_status` | read | Get crawl status and results |
| `firecrawl_cancel_crawl` | write | Cancel a crawl job |
| `firecrawl_get_crawl_errors` | read | List failed crawl pages |
| `firecrawl_get_active_crawls` | read | List active crawls |
| `firecrawl_preview_crawl_params` | read | Preview crawl params from a prompt |
| `firecrawl_map` | read | Discover site URLs |
| `firecrawl_batch_scrape` | read | Start a batch scrape job |
| `firecrawl_get_batch_scrape_status` | read | Get batch scrape status and results |
| `firecrawl_cancel_batch_scrape` | write | Cancel a batch scrape job |
| `firecrawl_get_batch_scrape_errors` | read | List failed batch scrape URLs |
| `firecrawl_extract` | read | Extract structured data from URLs |
| `firecrawl_get_extract_status` | read | Get extract job status |
| `firecrawl_agent` | read | Start an agentic extraction task |
| `firecrawl_get_agent_status` | read | Get agent job status |
| `firecrawl_cancel_agent` | write | Cancel an agent job |
| `firecrawl_create_browser` | write | Create a browser session |
| `firecrawl_list_browsers` | read | List browser sessions |
| `firecrawl_execute_browser` | write | Execute in a browser session |
| `firecrawl_delete_browser` | write | Delete a browser session |
| `firecrawl_credit_usage` | read | Get remaining credits |
| `firecrawl_historical_credit_usage` | read | Get historical credit usage |
| `firecrawl_token_usage` | read | Get remaining extract tokens |
| `firecrawl_historical_token_usage` | read | Get historical token usage |
| `firecrawl_queue_status` | read | Get scrape queue metrics |
| `firecrawl_activity` | read | List recent API activity |

## Service Usage

```php
use OpenCompany\Integrations\Firecrawl\FirecrawlService;

$service = app(FirecrawlService::class);

$page = $service->scrape('https://example.test', ['formats' => ['markdown']]);
$search = $service->search(['query' => 'Firecrawl v2 batch scrape', 'limit' => 5]);
$crawl = $service->crawl('https://example.test/docs', ['limit' => 25]);
$batch = $service->batchScrape(['https://example.test/a', 'https://example.test/b']);
$credits = $service->creditUsage();
```

## Endpoint Notes

The default base URL is `https://api.firecrawl.dev/v2`. The package covers JSON endpoints from the v2 OpenAPI spec. Multipart file parsing (`POST /parse`) is not exposed in this JSON-only slice.
