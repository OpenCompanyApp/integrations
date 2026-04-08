# Splunk Integration

Log analytics, search, and monitoring integration for OpenCompany. Provides tools for searching logs, managing indexes, and working with saved searches via the Splunk REST API.

## Installation

```json
{
    "require": {
        "opencompanyapp/integration-splunk": "@dev"
    }
}
```

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Splunk Bearer token for API authentication |
| `url` | url | no | Splunk REST API base URL (default: `https://localhost:8089/services`) |

### Splunk Cloud

```
url: https://your-instance.splunkcloud.com:8089/services
```

### Self-hosted

```
url: https://your-splunk-server:8089/services
```

## Available Tools

| Tool | Type | Description |
|------|------|-------------|
| `splunk_search` | write | Run a Splunk search query (SPL), returns a search job SID |
| `splunk_get_search_results` | read | Retrieve results from a completed search job by SID |
| `splunk_list_indexes` | read | List all available Splunk indexes |
| `splunk_list_saved_searches` | read | List all saved searches |
| `splunk_get_index` | read | Get details for a specific index |
| `splunk_get_current_user` | read | Get current authenticated user context |

## Usage

### Search logs

```php
use OpenCompany\Integrations\Splunk\Tools\SplunkSearch;

$tool = new SplunkSearch($service);
$result = $tool->execute([
    'query' => 'search index=main error | head 100',
    'earliest_time' => '-24h',
    'latest_time' => 'now',
]);

// $result->data contains the search job SID
```

### Get search results

```php
use OpenCompany\Integrations\Splunk\Tools\SplunkGetSearchResults;

$tool = new SplunkGetSearchResults($service);
$result = $tool->execute([
    'sid' => '1234567890.123',
    'offset' => 0,
    'count' => 100,
]);
```

## License

MIT
