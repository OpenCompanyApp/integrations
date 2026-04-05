# Splunk — Lua API Reference

## search

Run a Splunk search query (SPL). Creates an asynchronous search job and returns the search ID (SID).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The SPL search query (e.g., `"search index=main error"`). |
| `earliest_time` | string | no | Earliest time for the search (e.g., `"-24h"`, `"2025-01-01T00:00:00"`). |
| `latest_time` | string | no | Latest time for the search (e.g., `"now"`, `"2025-01-31T23:59:59"`). |

### Examples

```lua
-- Search for errors in the last 24 hours
local result = app.integrations.splunk.search({
  query = "search index=main error",
  earliest_time = "-24h",
  latest_time = "now"
})
-- result contains the SID (search job ID)

-- Search with absolute time range
local result = app.integrations.splunk.search({
  query = "search index=_internal sourcetype=splunkd",
  earliest_time = "2025-01-01T00:00:00",
  latest_time = "2025-01-31T23:59:59"
})
```

---

## get_search_results

Retrieve results from a completed Splunk search job by SID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sid` | string | yes | The search job ID (SID) returned by `search`. |
| `offset` | integer | no | Starting offset for pagination (0-based, default: 0). |
| `count` | integer | no | Number of results per page (default: 100). |

### Examples

```lua
-- Get first 100 results from a search job
local result = app.integrations.splunk.get_search_results({
  sid = "1234567890.123"
})

-- Paginate through results
local page2 = app.integrations.splunk.get_search_results({
  sid = "1234567890.123",
  offset = 100,
  count = 100
})
```

---

## list_indexes

List all Splunk indexes available to the authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splunk.list_indexes({})
```

---

## list_saved_searches

List all saved searches configured in Splunk.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splunk.list_saved_searches({})
```

---

## get_index

Get details for a specific Splunk index by name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The index name (e.g., `"main"`, `"_internal"`). |

### Examples

```lua
local result = app.integrations.splunk.get_index({
  name = "main"
})
```

---

## get_current_user

Get the current authenticated Splunk user context.

### Parameters

None.

### Examples

```lua
local result = app.integrations.splunk.get_current_user({})
```

---

## Common Workflows

### Search and retrieve results

```lua
-- Step 1: Create a search job
local search = app.integrations.splunk.search({
  query = "search index=main error | head 50",
  earliest_time = "-1h"
})

-- Step 2: Retrieve results using the SID
local results = app.integrations.splunk.get_search_results({
  sid = search.sid
})

-- Step 3: Process the results
for _, row in ipairs(results.results or {}) do
  print(row._raw or row._time or "no data")
end
```

### Discover available indexes then search

```lua
-- List available indexes
local indexes = app.integrations.splunk.list_indexes({})

-- Search a specific index
local search = app.integrations.splunk.search({
  query = "search index=main sourcetype=access_combined status>=500",
  earliest_time = "-7d"
})

local results = app.integrations.splunk.get_search_results({
  sid = search.sid
})
```

## Notes

- Search jobs are asynchronous — after calling `search`, the job may take time to complete. If results are empty, the job may still be running.
- The Splunk REST API uses Bearer token authentication. Generate a token in Splunk under Settings > Tokens.
- The base URL should point to the Splunk management port (default: 8089), e.g., `https://your-instance.splunkcloud.com:8089/services`.
- SPL queries must start with the `search` command (or be implied as the first command).
- Time modifiers use Splunk's relative time format: `-1h`, `-24h`, `-7d`, `-30d`, or absolute ISO 8601 timestamps.

---

## Multi-Account Usage

If you have multiple Splunk accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.splunk.search({query = "search index=main"})

-- Explicit default (portable across setups)
app.integrations.splunk.default.search({query = "search index=main"})

-- Named accounts
app.integrations.splunk.production.search({query = "search index=main"})
app.integrations.splunk.staging.search({query = "search index=main"})
```

All functions are identical across accounts — only the credentials differ.
