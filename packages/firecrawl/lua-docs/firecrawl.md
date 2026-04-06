# Firecrawl — Lua API Reference

## scrape

Scrape a single URL and extract its content in the requested format.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | The URL to scrape (e.g., `"https://example.com"`) |
| `formats` | array | no | Output formats: `"markdown"`, `"html"`, `"rawHtml"`, `"content"`, `"links"`, `"screenshot"`. Default: `["markdown"]` |
| `onlyMainContent` | boolean | no | Extract only main content, remove nav/footers. Default: `true` |
| `includeTags` | array | no | CSS selectors to include |
| `excludeTags` | array | no | CSS selectors to exclude |
| `waitFor` | integer | no | Milliseconds to wait for dynamic content |
| `timeout` | integer | no | Timeout in ms (default: 30000) |
| `actions` | array | no | Actions before scraping (click, scroll, wait, screenshot) |

### Example

```lua
local result = app.integrations.firecrawl.scrape({
  url = "https://example.com",
  formats = {"markdown", "links"},
  onlyMainContent = true
})

print(result.data.markdown)
```

---

## crawl

Start an asynchronous crawl job to scrape all pages from a website. Returns a job ID for status checking.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | Root URL to crawl from |
| `limit` | integer | no | Max pages to crawl. Default: 10 |
| `maxDepth` | integer | no | Max depth from root URL |
| `formats` | array | no | Output formats per page. Default: `["markdown"]` |
| `excludePaths` | array | no | URL path patterns to exclude |
| `includePaths` | array | no | Only crawl URLs matching these patterns |
| `allowBackwardLinks` | boolean | no | Allow crawling parent page links. Default: `false` |
| `allowExternalLinks` | boolean | no | Allow crawling external domains. Default: `false` |
| `onlyMainContent` | boolean | no | Extract only main content per page. Default: `true` |

### Example

```lua
local job = app.integrations.firecrawl.crawl({
  url = "https://example.com",
  limit = 50,
  formats = {"markdown"}
})

print("Crawl started with ID: " .. job.id)

-- Poll for results
local status = app.integrations.firecrawl.get_crawl_status({
  id = job.id
})

if status.status == "completed" then
  for _, page in ipairs(status.data) do
    print(page.metadata.sourceURL .. ": " .. #page.markdown .. " chars")
  end
end
```

---

## get_crawl_status

Check the status and retrieve results of a crawl job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The crawl job ID returned by `crawl` |

### Status Values

`scraping`, `completed`, `failed`, `cancelled`

### Example

```lua
local result = app.integrations.firecrawl.get_crawl_status({
  id = "crawl_abc123"
})

print("Status: " .. result.status)
print("Pages scraped: " .. #result.data)
```

---

## map

Discover all URLs on a website without scraping content.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | Root URL to map |
| `limit` | integer | no | Max URLs to return |
| `includeSubdomains` | boolean | no | Include subdomain URLs. Default: `false` |
| `search` | string | no | Filter URLs matching this term |
| `ignoreSitemap` | boolean | no | Skip sitemap.xml. Default: `false` |
| `includePaths` | array | no | Only include URLs matching these patterns |
| `excludePaths` | array | no | Exclude URLs matching these patterns |

### Example

```lua
local result = app.integrations.firecrawl.map({
  url = "https://example.com",
  limit = 100,
  includePaths = {"/docs/*"}
})

for _, url in ipairs(result.links) do
  print(url)
end
```

---

## extract

Extract structured data from one or more URLs using AI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `urls` | array | yes | List of URLs to extract from |
| `prompt` | string | no | Natural language description of what to extract |
| `schema` | object | no | JSON schema for expected output structure |
| `systemPrompt` | string | no | System prompt to guide AI behavior |
| `allowExternalLinks` | boolean | no | Follow external domain links. Default: `false` |
| `enableWebSearch` | boolean | no | Supplement with web search. Default: `false` |
| `includeSubdomains` | boolean | no | Include subdomains. Default: `false` |

### Example

```lua
local result = app.integrations.firecrawl.extract({
  urls = {"https://example.com/product/1"},
  prompt = "Extract the product name, price, and description"
})

print(result.data.product_name)
print(result.data.price)
```

### With JSON schema

```lua
local result = app.integrations.firecrawl.extract({
  urls = {"https://example.com/product/1"},
  schema = {
    type = "object",
    properties = {
      name = {type = "string"},
      price = {type = "number"},
      description = {type = "string"},
      inStock = {type = "boolean"}
    }
  }
})
```

---

## get_current_user

Get the authenticated user's account information and usage stats.

### Parameters

None.

### Example

```lua
local user = app.integrations.firecrawl.get_current_user({})
print("Account: " .. user.email)
print("Plan: " .. user.plan)
```

---

## Multi-Account Usage

If you have multiple Firecrawl accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.firecrawl.scrape({url = "https://example.com"})

-- Explicit default (portable across setups)
app.integrations.firecrawl.default.scrape({url = "https://example.com"})

-- Named accounts
app.integrations.firecrawl.production.scrape({url = "https://example.com"})
app.integrations.firecrawl.staging.scrape({url = "https://staging.example.com"})
```

All functions are identical across accounts — only the credentials differ.
