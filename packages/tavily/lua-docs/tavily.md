# Tavily — Lua API Reference

The `tavily` integration exposes Tavily's AI-oriented search, extraction, crawl, map, research, and usage APIs.

Use it when an agent needs current web information, clean source content, a site map, documentation crawl material, or a longer asynchronous research report.

All calls require a Tavily API key. If a `project_id` is configured, the integration sends it as `X-Project-ID` so usage can be tracked per project.

## search

Execute a web search and return Tavily's JSON response. Results are kept in Tavily's native shape: top-level `query`, optional `answer`, optional `images`, `results`, `response_time`, optional `usage`, and `request_id`.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | Search query. |
| `search_depth` | string | no | `basic`, `advanced`, `fast`, or `ultra-fast`. |
| `chunks_per_source` | integer | no | Chunks per source for advanced search, 1-3. |
| `max_results` | integer | no | Maximum results, 0-20. |
| `topic` | string | no | `general`, `news`, or `finance`. |
| `time_range` | string | no | `day`, `week`, `month`, `year`, or shorthand `d`, `w`, `m`, `y`. |
| `start_date` | string | no | Start date in `YYYY-MM-DD` format. |
| `end_date` | string | no | End date in `YYYY-MM-DD` format. |
| `include_answer` | boolean|string | no | `true`, `basic`, or `advanced` to include an answer. |
| `include_raw_content` | boolean|string | no | `true`, `markdown`, or `text` to include page content. |
| `include_images` | boolean | no | Include query and per-result images. |
| `include_image_descriptions` | boolean | no | Include image descriptions when images are enabled. |
| `include_favicon` | boolean | no | Include result favicons. |
| `include_domains` | string[] | no | Only include these domains. |
| `exclude_domains` | string[] | no | Exclude these domains. |
| `country` | string | no | Boost results from a Tavily-supported country value. |
| `auto_parameters` | boolean | no | Let Tavily pick some search parameters. |
| `exact_match` | boolean | no | Require exact quoted phrases in results. |
| `include_usage` | boolean | no | Include credit usage details. |
| `safe_search` | boolean | no | Enterprise-only unsafe-content filtering. |

### Example

```lua
local result = app.integrations.tavily.search({
  query = "latest Laravel release notes",
  search_depth = "advanced",
  include_answer = "basic",
  include_raw_content = "markdown",
  include_favicon = true,
  max_results = 5
})

for _, item in ipairs(result.results or {}) do
  print(item.title .. " " .. item.url)
end
```

## extract

Extract clean content from one or more URLs. The output keeps Tavily's native `results`, `failed_results`, `response_time`, optional `usage`, and `request_id` fields.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `urls` | string|string[] | yes | URL or URLs to extract. |
| `query` | string | no | Intent used to rerank extracted chunks. |
| `chunks_per_source` | integer | no | Chunks per source when `query` is supplied, 1-5. |
| `extract_depth` | string | no | `basic` or `advanced`. |
| `include_images` | boolean | no | Include extracted images. |
| `include_favicon` | boolean | no | Include favicon URL for each result. |
| `format` | string | no | `markdown` or `text`. |
| `timeout` | number | no | Timeout in seconds, 1-60. |
| `include_usage` | boolean | no | Include credit usage details. |

### Example

```lua
local extracted = app.integrations.tavily.extract({
  urls = {
    "https://example.test/docs/getting-started",
    "https://example.test/docs/api"
  },
  extract_depth = "advanced",
  format = "markdown"
})
```

## crawl

Crawl a site and extract content from discovered pages. Use this for RAG ingestion or documentation snapshots when full content is needed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | Root URL. |
| `instructions` | string | no | Natural language crawl instructions. |
| `chunks_per_source` | integer | no | Chunks per source when instructions are supplied, 1-5. |
| `max_depth` | integer | no | Crawl depth, 1-5. |
| `max_breadth` | integer | no | Links followed per level, 1-500. |
| `limit` | integer | no | Total links to process. |
| `select_paths` | string[] | no | Regex path patterns to include. |
| `select_domains` | string[] | no | Regex domain patterns to include. |
| `exclude_paths` | string[] | no | Regex path patterns to exclude. |
| `exclude_domains` | string[] | no | Regex domain patterns to exclude. |
| `allow_external` | boolean | no | Whether external links may be included. |
| `include_images` | boolean | no | Include images in results. |
| `extract_depth` | string | no | `basic` or `advanced`. |
| `format` | string | no | `markdown` or `text`. |
| `include_favicon` | boolean | no | Include favicon URL for each result. |
| `timeout` | number | no | Timeout in seconds, 10-150. |
| `include_usage` | boolean | no | Include credit usage details. |

### Example

```lua
local crawl = app.integrations.tavily.crawl({
  url = "https://example.test/docs",
  instructions = "Find API reference pages",
  select_paths = {"/docs/.*"},
  max_depth = 2,
  limit = 25,
  format = "markdown"
})
```

## map

Map a website and return discovered URLs only. Use this before `extract` or `crawl` when the agent needs to decide which URLs matter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `url` | string | yes | Root URL. |
| `instructions` | string | no | Natural language mapping instructions. |
| `max_depth` | integer | no | Mapping depth, 1-5. |
| `max_breadth` | integer | no | Links followed per level, 1-500. |
| `limit` | integer | no | Total links to process. |
| `select_paths` | string[] | no | Regex path patterns to include. |
| `select_domains` | string[] | no | Regex domain patterns to include. |
| `exclude_paths` | string[] | no | Regex path patterns to exclude. |
| `exclude_domains` | string[] | no | Regex domain patterns to exclude. |
| `allow_external` | boolean | no | Whether external links may be included. |
| `timeout` | number | no | Timeout in seconds, 10-150. |
| `include_usage` | boolean | no | Include credit usage details. |

### Example

```lua
local mapped = app.integrations.tavily.map({
  url = "https://example.test/docs",
  select_paths = {"/docs/.*"},
  limit = 100
})
```

## create_research_task

Queue an asynchronous Tavily Research task. The result includes `request_id`, which can be passed to `get_research_task`.

Streaming is not supported by this integration tool because Tavily streaming returns Server-Sent Events rather than a JSON tool result.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `input` | string | yes | Research task or question. |
| `model` | string | no | `mini`, `pro`, or `auto`. |
| `output_schema` | object | no | JSON Schema with `properties` and optional `required`. |
| `citation_format` | string | no | `numbered`, `mla`, `apa`, or `chicago`. |

### Example

```lua
local task = app.integrations.tavily.create_research_task({
  input = "Compare current EU AI Act compliance guidance for SaaS vendors",
  model = "pro",
  citation_format = "numbered"
})

print(task.request_id)
```

## get_research_task

Retrieve status or completed content for a research task.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `request_id` | string | yes | Tavily research request ID. |

### Example

```lua
local report = app.integrations.tavily.get_research_task({
  request_id = "123e4567-e89b-12d3-a456-426614174111"
})

print(report.status)
print(report.content)
```

## get_usage

Retrieve API key and account usage. The response contains `key` and `account` usage objects when available.

### Parameters

None.

### Example

```lua
local usage = app.integrations.tavily.get_usage()
print(usage.key and usage.key.usage)
```

## Multi-Account Usage

If multiple Tavily accounts are configured, use account-specific namespaces:

```lua
app.integrations.tavily.search({ query = "default account search" })
app.integrations.tavily.default.search({ query = "explicit default account" })
app.integrations.tavily.research.search({ query = "named account search" })
```
