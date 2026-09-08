# Firecrawl — Ruby API Reference

Namespace: `app.integrations.firecrawl`

This integration targets Firecrawl v2 JSON endpoints under `https://api.firecrawl.dev/v2`.

Covered endpoints include scrape, crawl, map, search, batch scrape, extract status, agent jobs, browser sessions, team usage, queue status, and activity. File upload parsing is intentionally not exposed by this JSON-only package slice.

## Core Content Tools

```ruby
page = app.integrations.firecrawl.scrape_url(url: "https://example.test", formats: ["markdown", "links"], only_main_content: true)
results = app.integrations.firecrawl.search(query: "Firecrawl v2 batch scrape", limit: 5, scrape_options: {formats: ["markdown"]})
links = app.integrations.firecrawl.map_urls(url: "https://example.test", limit: 100)
```
## Crawl Jobs

```ruby
crawl = app.integrations.firecrawl.website(url: "https://example.test/docs", limit: 50, formats: ["markdown"])
status = app.integrations.firecrawl.status(id: crawl.id)
errors = app.integrations.firecrawl.errors(id: crawl.id)
active = app.integrations.firecrawl.active()
app.integrations.firecrawl.cancel(id: crawl.id)
```
Use `preview_crawl_params` to turn a plain-English crawl intent into a candidate crawl config before running an expensive crawl.

```ruby
preview = app.integrations.firecrawl.preview_params(url: "https://example.test", prompt: "Crawl only the developer docs && ignore changelog pages.")
```
## Batch Scrape

```ruby
batch = app.integrations.firecrawl.batch_scrape(urls: ["https://example.test/a", "https://example.test/b"], formats: ["markdown"], ignore_invalid_urls: true)
status = app.integrations.firecrawl.batch_scrape_status(id: batch.id)
errors = app.integrations.firecrawl.batch_scrape_errors(id: batch.id)
app.integrations.firecrawl.cancel_batch_scrape(id: batch.id)
```
## Extract And Agent Jobs

```ruby
extract = app.integrations.firecrawl.extract_data(urls: ["https://example.test/product/1"], prompt: "Extract product name, price, && availability.")
extract_status = app.integrations.firecrawl.extract_status(id: extract.id)
agent = app.integrations.firecrawl.agent_task(url: "https://example.test", prompt: "Find the pricing page && extract all plan names.")
agent_status = app.integrations.firecrawl.agent_status(job_id: agent.id)
app.integrations.firecrawl.cancel_agent(job_id: agent.id)
```
## Browser Sessions

```ruby
browser = app.integrations.firecrawl.create_browser(url: "https://example.test")
result = app.integrations.firecrawl.execute_browser(session_id: browser.sessionId, prompt: "Click the pricing link && return the page title.")
sessions = app.integrations.firecrawl.list_browsers()
app.integrations.firecrawl.delete_browser(session_id: browser.sessionId)
```
## Team Usage And Activity

```ruby
credits = app.integrations.firecrawl.credit_usage()
credit_history = app.integrations.firecrawl.historical_credit_usage()
tokens = app.integrations.firecrawl.token_usage()
token_history = app.integrations.firecrawl.historical_token_usage()
queue = app.integrations.firecrawl.queue_status()
activity = app.integrations.firecrawl.activity(limit: 20)
```
## Multi-Account Usage

```ruby
app.integrations.firecrawl.scrape_url(url: "https://example.test")
app.integrations.firecrawl.default.scrape_url(url: "https://example.test")
app.integrations.firecrawl.production.scrape_url(url: "https://example.test")
```