# urlscan.io Integration

Use the `urlscan` integration to submit URLs to the urlscan.io sandbox, search scan results, retrieve artifacts, and operate urlscan Pro resources such as live scans, saved searches, subscriptions, channels, incidents, and data dumps.

All tools are generated from the official urlscan.io OpenAPI bundle at `https://docs.urlscan.io/_bundle/apis/urlscan-openapi.json?download`. The API uses the `api-key` request header, so configure an API key before calling tools.

## Common Tools

- `urlscan_submit_scan` submits a URL scan. Pass a `body` object such as `{ url = "https://example.test", visibility = "unlisted" }`.
- `urlscan_search_datasource` searches urlscan data. Use `q` for the Elasticsearch query string and optional `datasource`, `size`, `search_after`, and `collapse` parameters.
- `urlscan_get_result`, `urlscan_get_screenshot`, and `urlscan_get_dom` retrieve scan artifacts by `scan_id`.
- `urlscan_get_quotas` checks the authenticated account's quotas.
- Pro-oriented tools cover live scanning, saved searches, subscriptions, channels, incidents, malicious observable lookup, brands, hostnames, and data dumps.

## Return Shape

JSON responses are returned as decoded arrays/objects from urlscan.io. Binary or text artifact endpoints, such as screenshots, DOM exports, response files, and downloads, return `{ body, status, content_type }` because those endpoints do not always return JSON.

## Examples

```lua
local submitted = app.integrations.urlscan.submit_scan({
  body = {
    url = "https://example.test",
    visibility = "unlisted",
    tags = { "triage" }
  }
})

local results = app.integrations.urlscan.search_datasource({
  q = "page.domain:example.test",
  datasource = "scans",
  size = 10
})

local quotas = app.integrations.urlscan.get_quotas({})
```

Use fake domains such as `example.test` in tests and examples. Some endpoints are only available to urlscan Pro accounts; if a host account lacks access, urlscan.io will return the upstream authorization or plan error.
