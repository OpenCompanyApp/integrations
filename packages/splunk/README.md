# Splunk Integration

Splunk REST API integration for OpenCompany agents. It covers search jobs,
export, results, events, indexes, saved searches, apps, users, current context,
server info, and safe raw relative services calls.

## Configuration

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| `access_token` | secret | yes | Splunk bearer token for API authentication |
| `url` | url | no | Splunk REST services URL, default `https://localhost:8089/services` |

Splunk Cloud deployments may require REST API access to be enabled for the
management port.

## Tool Areas

| Area | Tools |
|------|-------|
| Search jobs | `search`, `export_search`, `list_search_jobs`, `get_search_job`, `delete_search_job`, `get_search_results`, `get_search_events`, `get_search_log` |
| Indexes | `list_indexes`, `get_index`, `create_index`, `update_index`, `delete_index` |
| Saved searches | `list_saved_searches`, `get_saved_search`, `create_saved_search`, `update_saved_search`, `delete_saved_search`, `dispatch_saved_search` |
| Administration | `list_apps`, `get_app`, `list_users`, `get_user`, `get_current_user`, `get_server_info` |
| Raw services API | `api_get`, `api_post`, `api_delete` |

## Usage

```php
use OpenCompany\Integrations\Splunk\SplunkService;

$service = app(SplunkService::class);

$job = $service->search(
    query: 'search index=main error | head 100',
    earliestTime: '-24h',
    latestTime: 'now',
);

$results = $service->getSearchResults($job['sid']);
$indexes = $service->listIndexes();
$saved = $service->listSavedSearches(search: 'name=*error*');
```

## Notes

Raw helpers reject full URLs and parent-directory path segments. Pass paths
relative to `/services`, such as `/server/info` or `/search/jobs`.

## License

MIT
