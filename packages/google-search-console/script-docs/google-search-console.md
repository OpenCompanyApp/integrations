# Google Search Console

Google Search Console tools are exposed under `app.integrations.google_search_console`. This package is generated from Google's official Search Console API v1 Discovery document and exposes 11 REST methods.

## Coverage

- Source: `https://searchconsole.googleapis.com/$discovery/rest?version=v1`
- Read tools: 4
- Write tools: 7
- Base URL: `https://searchconsole.googleapis.com`

## Usage Notes

Pass `siteUrl` and `feedpath` exactly as Search Console expects them; the integration URL-encodes path values such as `https://example.com/`. Query parameters can be passed as top-level shortcuts or inside `query`. Search analytics, URL inspection, and mobile friendly test methods accept the official JSON request object inside `body`.

## Tools

- `google_search_console_sitemaps_list` - GET /webmasters/v3/sites/{siteUrl}/sitemaps
- `google_search_console_sitemaps_submit` - PUT /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
- `google_search_console_sitemaps_delete` - DELETE /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
- `google_search_console_sitemaps_get` - GET /webmasters/v3/sites/{siteUrl}/sitemaps/{feedpath}
- `google_search_console_url_inspection_index_inspect` - POST /v1/urlInspection/index:inspect
- `google_search_console_sites_list` - GET /webmasters/v3/sites
- `google_search_console_sites_add` - PUT /webmasters/v3/sites/{siteUrl}
- `google_search_console_sites_get` - GET /webmasters/v3/sites/{siteUrl}
- `google_search_console_sites_delete` - DELETE /webmasters/v3/sites/{siteUrl}
- `google_search_console_url_testing_tools_mobile_friendly_test_run` - POST /v1/urlTestingTools/mobileFriendlyTest:run
- `google_search_console_searchanalytics_query` - POST /webmasters/v3/sites/{siteUrl}/searchAnalytics/query

## Examples

```js
var sites = app.integrations.google_search_console.google_search_console_sites_list({})

var rows = app.integrations.google_search_console.google_search_console_searchanalytics_query({
  siteUrl: "https://example.com/",
  body: { startDate: "2026-05-01", endDate: "2026-05-06", dimensions: [ "query" ] },
})
```
Responses are decoded Google Search Console JSON responses, or `{ success = true, status = ... }` for successful empty responses.
