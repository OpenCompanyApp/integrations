# Firecrawl — Lua API Reference

Namespace: `app.integrations.firecrawl`

This integration targets Firecrawl v2 JSON endpoints under `https://api.firecrawl.dev/v2`.

Covered endpoints include scrape, crawl, map, search, batch scrape, extract status, agent jobs, browser sessions, team usage, queue status, and activity. File upload parsing is intentionally not exposed by this JSON-only package slice.

## Core Content Tools

```lua
local page = app.integrations.firecrawl.scrape({
  url = "https://example.test",
  formats = { "markdown", "links" },
  onlyMainContent = true
})

local results = app.integrations.firecrawl.search({
  query = "Firecrawl v2 batch scrape",
  limit = 5,
  scrapeOptions = { formats = { "markdown" } }
})

local links = app.integrations.firecrawl.map({
  url = "https://example.test",
  limit = 100
})
```

## Crawl Jobs

```lua
local crawl = app.integrations.firecrawl.crawl({
  url = "https://example.test/docs",
  limit = 50,
  formats = { "markdown" }
})

local status = app.integrations.firecrawl.get_crawl_status({ id = crawl.id })
local errors = app.integrations.firecrawl.get_crawl_errors({ id = crawl.id })
local active = app.integrations.firecrawl.get_active_crawls({})

app.integrations.firecrawl.cancel_crawl({ id = crawl.id })
```

Use `preview_crawl_params` to turn a plain-English crawl intent into a candidate crawl config before running an expensive crawl.

```lua
local preview = app.integrations.firecrawl.preview_crawl_params({
  url = "https://example.test",
  prompt = "Crawl only the developer docs and ignore changelog pages."
})
```

## Batch Scrape

```lua
local batch = app.integrations.firecrawl.batch_scrape({
  urls = {
    "https://example.test/a",
    "https://example.test/b"
  },
  formats = { "markdown" },
  ignoreInvalidURLs = true
})

local status = app.integrations.firecrawl.get_batch_scrape_status({ id = batch.id })
local errors = app.integrations.firecrawl.get_batch_scrape_errors({ id = batch.id })
app.integrations.firecrawl.cancel_batch_scrape({ id = batch.id })
```

## Extract And Agent Jobs

```lua
local extract = app.integrations.firecrawl.extract({
  urls = { "https://example.test/product/1" },
  prompt = "Extract product name, price, and availability."
})

local extract_status = app.integrations.firecrawl.get_extract_status({
  id = extract.id
})

local agent = app.integrations.firecrawl.agent({
  url = "https://example.test",
  prompt = "Find the pricing page and extract all plan names."
})

local agent_status = app.integrations.firecrawl.get_agent_status({
  job_id = agent.id
})

app.integrations.firecrawl.cancel_agent({ job_id = agent.id })
```

## Browser Sessions

```lua
local browser = app.integrations.firecrawl.create_browser({
  url = "https://example.test"
})

local result = app.integrations.firecrawl.execute_browser({
  session_id = browser.sessionId,
  prompt = "Click the pricing link and return the page title."
})

local sessions = app.integrations.firecrawl.list_browsers({})
app.integrations.firecrawl.delete_browser({ session_id = browser.sessionId })
```

## Team Usage And Activity

```lua
local credits = app.integrations.firecrawl.credit_usage({})
local credit_history = app.integrations.firecrawl.historical_credit_usage({})
local tokens = app.integrations.firecrawl.token_usage({})
local token_history = app.integrations.firecrawl.historical_token_usage({})
local queue = app.integrations.firecrawl.queue_status({})
local activity = app.integrations.firecrawl.activity({ limit = 20 })
```

## Multi-Account Usage

```lua
app.integrations.firecrawl.scrape({ url = "https://example.test" })
app.integrations.firecrawl.default.scrape({ url = "https://example.test" })
app.integrations.firecrawl.production.scrape({ url = "https://example.test" })
```
