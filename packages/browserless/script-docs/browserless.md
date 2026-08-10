# Browserless Integration

Namespace: `browserless`

This integration exposes Browserless OpenAPI operations as endpoint-specific tools. It was generated from the official Browserless Redoc/OpenAPI page at `https://docs.browserless.io/open-api`. Browserless authenticates with a `token` query parameter; tools do not expose that token because the service injects it from host credentials.

JSON request bodies are passed through `body`. JavaScript function/download endpoints use a `code` string and send it as `application/javascript`. Wildcard routes expose `path_suffix` for the dynamic portion of the URL.

## Coverage

- Official paths: 67
- Official operations: 74
- Read operations: 33
- Write operations: 41

## Examples

```js
var version = browserless.browserless_get_json_version({})
var screenshot = browserless.browserless_post_screenshot({
  body: { url: "https://example.test" },
})
var fn = browserless.browserless_post_chrome_function({
  code: "module.exports = async ({ page }) => await page.title();",
})
```
## Common Tools

- `browserless_post_chrome_content` - POST /chrome/content
- `browserless_post_chrome_download` - POST /chrome/download
- `browserless_post_chrome_function` - POST /chrome/function
- `browserless_put_json_new` - PUT /json/new
- `browserless_get_json_protocol` - GET /json/protocol
- `browserless_get_json_version` - GET /json/version
- `browserless_post_chrome_pdf` - POST /chrome/pdf
- `browserless_post_chrome_performance` - POST /chrome/performance
- `browserless_post_chrome_scrape` - POST /chrome/scrape
- `browserless_post_chrome_screenshot` - POST /chrome/screenshot
- `browserless_post_chromium_content` - POST /chromium/content
- `browserless_post_chromium_download` - POST /chromium/download
- `browserless_post_chromium_function` - POST /chromium/function
- `browserless_post_chromium_performance` - POST /chromium/performance
- `browserless_post_chromium_scrape` - POST /chromium/scrape
- `browserless_post_edge_content` - POST /edge/content
- `browserless_post_edge_download` - POST /edge/download
- `browserless_post_edge_function` - POST /edge/function
- `browserless_post_edge_pdf` - POST /edge/pdf
- `browserless_post_edge_performance` - POST /edge/performance
- `browserless_post_edge_scrape` - POST /edge/scrape
- `browserless_post_edge_screenshot` - POST /edge/screenshot
- `browserless_get_active` - GET /active
- `browserless_get_kill_id` - GET /kill/+([0-9a-zA-Z-_])
- `browserless_get_meta` - GET /meta
- `browserless_get_root` - GET /
- `browserless_get_devtools_browser_wildcard` - GET /devtools/browser/*
- `browserless_get_chrome` - GET /chrome
- `browserless_get_function_connect_wildcard` - GET /function/connect/*
- `browserless_get_devtools_page_wildcard` - GET /devtools/page/*
- `browserless_get_chrome_playwright` - GET /chrome/playwright
- `browserless_get_chromium` - GET /chromium
- `browserless_get_chromium_playwright` - GET /chromium/playwright
- `browserless_get_edge` - GET /edge
- `browserless_get_edge_playwright` - GET /edge/playwright
- `browserless_get_firefox_playwright` - GET /firefox/playwright
- `browserless_get_webkit_playwright` - GET /webkit/playwright
- `browserless_delete_browser_wildcard` - DELETE /browser/*
- `browserless_post_chrome_export` - POST /chrome/export
- `browserless_post_chrome_unblock` - POST /chrome/unblock

All examples use fake URLs and safe placeholder values. Configure API tokens through the host credential resolver, not in JavaScript source.
