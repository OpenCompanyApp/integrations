# Firecrawl — JavaScript API Reference

Namespace: `app.integrations.firecrawl`

This integration targets Firecrawl v2 JSON endpoints under `https://api.firecrawl.dev/v2`.

Covered endpoints include scrape, crawl, map, search, batch scrape, extract status, agent jobs, browser sessions, team usage, queue status, and activity. File upload parsing is intentionally not exposed by this JSON-only package slice.

## Core Content Tools

```js
var page = app.integrations.firecrawl.scrape({
  url: "https://example.test",
  formats: [ "markdown", "links" ],
  onlyMainContent: true,
})

var results = app.integrations.firecrawl.search({
  query: "Firecrawl v2 batch scrape",
  limit: 5,
  scrapeOptions: { formats: [ "markdown" ] },
})

var links = app.integrations.firecrawl.map({
  url: "https://example.test",
  limit: 100,
})
```
## Crawl Jobs

```js
var crawl = app.integrations.firecrawl.crawl({
  url: "https://example.test/docs",
  limit: 50,
  formats: [ "markdown" ],
})

var status = app.integrations.firecrawl.get_crawl_status({ id: crawl.id })
var errors = app.integrations.firecrawl.get_crawl_errors({ id: crawl.id })
var active = app.integrations.firecrawl.get_active_crawls({})

app.integrations.firecrawl.cancel_crawl({ id: crawl.id })
```
Use `preview_crawl_params` to turn a plain-English crawl intent into a candidate crawl config before running an expensive crawl.

```js
var preview = app.integrations.firecrawl.preview_crawl_params({
  url: "https://example.test",
  prompt: "Crawl only the developer docs && ignore changelog pages.",
})
```
## Batch Scrape

```js
var batch = app.integrations.firecrawl.batch_scrape({
  urls: [
    "https://example.test/a",
    "https://example.test/b"
  ],
  formats: [ "markdown" ],
  ignoreInvalidURLs: true,
})

var status = app.integrations.firecrawl.get_batch_scrape_status({ id: batch.id })
var errors = app.integrations.firecrawl.get_batch_scrape_errors({ id: batch.id })
app.integrations.firecrawl.cancel_batch_scrape({ id: batch.id })
```
## Extract And Agent Jobs

```js
var extract = app.integrations.firecrawl.extract({
  urls: [ "https://example.test/product/1" ],
  prompt: "Extract product name, price, && availability.",
})

var extract_status = app.integrations.firecrawl.get_extract_status({
  id: extract.id,
})

var agent = app.integrations.firecrawl.agent({
  url: "https://example.test",
  prompt: "Find the pricing page && extract all plan names.",
})

var agent_status = app.integrations.firecrawl.get_agent_status({
  job_id: agent.id,
})

app.integrations.firecrawl.cancel_agent({ job_id: agent.id })
```
## Browser Sessions

```js
var browser = app.integrations.firecrawl.create_browser({
  url: "https://example.test",
})

var result = app.integrations.firecrawl.execute_browser({
  session_id: browser.sessionId,
  prompt: "Click the pricing link && return the page title.",
})

var sessions = app.integrations.firecrawl.list_browsers({})
app.integrations.firecrawl.delete_browser({ session_id: browser.sessionId })
```
## Team Usage And Activity

```js
var credits = app.integrations.firecrawl.credit_usage({})
var credit_history = app.integrations.firecrawl.historical_credit_usage({})
var tokens = app.integrations.firecrawl.token_usage({})
var token_history = app.integrations.firecrawl.historical_token_usage({})
var queue = app.integrations.firecrawl.queue_status({})
var activity = app.integrations.firecrawl.activity({ limit: 20 })
```
## Multi-Account Usage

```js
app.integrations.firecrawl.scrape({ url: "https://example.test" })
app.integrations.firecrawl.default.scrape({ url: "https://example.test" })
app.integrations.firecrawl.production.scrape({ url: "https://example.test" })
```