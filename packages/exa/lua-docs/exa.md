# Exa AI — Lua API Reference

Exa is an AI-powered search engine that uses neural embeddings to find relevant web content. Unlike keyword search, Exa understands the *meaning* of your query and returns semantically relevant results.

## search

Perform a neural search query across the web.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Natural language search query |
| `num_results` | integer | no | Number of results (default: 10, max: 100) |
| `use_autoprompt` | boolean | no | Let Exa optimize your query (default: true) |
| `type` | string | no | `"keyword"`, `"neural"`, or `"auto"` (default: `"auto"`) |
| `category` | string | no | Filter by content category (see below) |
| `start_published_date` | string | no | Only results after this date (ISO 8601) |

### Categories

`"company"`, `"research paper"`, `"news"`, `"github"`, `"tweet"`, `"movie"`, `"song"`, `"personal site"`, `"or pdf"`

### Examples

```lua
-- Basic neural search
local results = app.integrations.exa.search({
  query = "best practices for building REST APIs with Laravel"
})

-- Search for recent news articles
local news = app.integrations.exa.search({
  query = "Laravel 12 release announcement",
  category = "news",
  start_published_date = "2025-01-01T00:00:00Z",
  num_results = 5
})

-- Keyword search for exact matches
local exact = app.integrations.exa.search({
  query = "phpstan level 9 laravel",
  type = "keyword",
  num_results = 5
})
```

---

## find_similar

Find web pages similar to a given URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | URL to find similar pages for |
| `num_results` | integer | no | Number of results (default: 10, max: 100) |

### Examples

```lua
-- Find pages similar to Laravel docs
local similar = app.integrations.exa.find_similar({
  url = "https://laravel.com/docs/12.x",
  num_results = 5
})

-- Discover competitors
local competitors = app.integrations.exa.find_similar({
  url = "https://example.com",
  num_results = 10
})
```

---

## get_contents

Retrieve full page contents for a list of document IDs (obtained from search or findSimilar results).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ids` | array | yes | List of document IDs (URLs or Exa IDs) |
| `text` | boolean | no | Include full page text (default: true) |
| `highlights` | object | no | Highlight configuration (see below) |

### Highlights Object

| Key | Type | Description |
|-----|------|-------------|
| `query` | string | Query to generate highlights for |
| `num_sentences` | integer | Sentences per highlight (default: 3) |

### Examples

```lua
-- Get full text for search results
local search = app.integrations.exa.search({ query = "Laravel queues", num_results = 3 })
local ids = {}
for _, r in ipairs(search.results) do
  table.insert(ids, r.id)
end

local contents = app.integrations.exa.get_contents({
  ids = ids,
  text = true
})

-- Get contents with highlights
local contents = app.integrations.exa.get_contents({
  ids = { "https://example.com/article" },
  text = true,
  highlights = {
    query = "Laravel queues",
    num_sentences = 5
  }
})
```

---

## search_and_contents

Search and retrieve full contents in a single call. More efficient than calling search + get_contents separately.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Natural language search query |
| `num_results` | integer | no | Number of results (default: 10, max: 100) |
| `use_autoprompt` | boolean | no | Let Exa optimize your query (default: true) |
| `type` | string | no | `"keyword"`, `"neural"`, or `"auto"` |
| `category` | string | no | Filter by content category |
| `start_published_date` | string | no | Only results after this date (ISO 8601) |
| `text` | boolean | no | Include full page text (default: true) |
| `highlights` | object | no | Highlight configuration |

### Examples

```lua
-- Search and get full content in one call
local results = app.integrations.exa.search_and_contents({
  query = "how to implement OAuth2 in Laravel",
  num_results = 5,
  text = true,
  highlights = {
    query = "OAuth2 Laravel implementation",
    num_sentences = 3
  }
})

-- Search for recent research papers with content
local papers = app.integrations.exa.search_and_contents({
  query = "transformer architecture improvements 2024",
  category = "research paper",
  num_results = 5,
  text = true
})
```

---

## get_current_user

Get the authenticated user's profile and API usage information. Useful for verifying credentials.

### Parameters

None.

### Examples

```lua
-- Check user info and usage
local user = app.integrations.exa.get_current_user({})
print("Logged in as: " .. user.email)
```

---

## Common Workflows

### Search, then retrieve contents for top results

```lua
-- Step 1: Search
local results = app.integrations.exa.search({
  query = "Laravel 12 new features",
  num_results = 5
})

-- Step 2: Get full contents
local ids = {}
for _, r in ipairs(results.results) do
  table.insert(ids, r.id)
end

local contents = app.integrations.exa.get_contents({
  ids = ids,
  text = true
})

-- Step 3: Summarize
for _, page in ipairs(contents.results) do
  print(page.title)
  print(page.url)
  print(page.text:sub(1, 200) .. "...")
  print("---")
end
```

### Research a topic with content retrieval

```lua
local results = app.integrations.exa.search_and_contents({
  query = "best practices for API rate limiting",
  category = "news",
  num_results = 3,
  text = true,
  highlights = {
    query = "API rate limiting strategies",
    num_sentences = 3
  }
})
```

### Find alternatives to a tool or service

```lua
local similar = app.integrations.exa.find_similar({
  url = "https://github.com/some-tool",
  num_results = 10
})
```

## Notes

- Exa uses neural embeddings for search — describe *what you want* rather than using exact keywords
- `use_autoprompt` is enabled by default and often improves results significantly
- Document IDs from search results can be URLs or Exa-specific IDs — both work with `get_contents`
- Rate limits depend on your Exa plan — use `get_current_user` to check usage
- The `type` parameter controls search mode: `"neural"` for semantic, `"keyword"` for exact matches, `"auto"` for hybrid

---

## Multi-Account Usage

If you have multiple Exa accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.exa.search({ query = "hello world" })

-- Explicit default (portable across setups)
app.integrations.exa.default.search({ query = "hello world" })

-- Named accounts
app.integrations.exa.work.search({ query = "company research" })
app.integrations.exa.personal.search({ query = "hobby project" })
```

All functions are identical across accounts — only the credentials differ.
