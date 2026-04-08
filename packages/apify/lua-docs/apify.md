# Apify — Lua API Reference

## run_actor

Run an Apify actor with input configuration. Returns the run details including run ID and status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `actorId` | string | yes | Actor ID (e.g. `"apify/web-scraper"`) or numeric ID |
| `input` | object | yes | Input configuration for the actor (structure depends on the actor) |
| `build` | string | no | Actor build tag (`"latest"`, `"beta"`, etc.) |
| `waitForFinish` | integer | no | Max seconds to wait for the run to finish (0–300, default: 0) |
| `timeout` | integer | no | Timeout for the actor run in seconds |
| `memory` | integer | no | Memory in MB (128, 256, 512, 1024, 2048, 4096, 8192) |

### Examples

```lua
-- Run a web scraper actor
local result = app.integrations.apify.run_actor({
  actorId = "apify/web-scraper",
  input = {
    startUrls = {
      { url = "https://example.com" }
    },
    linkSelector = "a[href]",
    globPatterns = { "https://example.com/*" },
    pageFunction = "async function pageFunction(context) { return { url: context.request.url, title: (await context.page.title()) }; }"
  },
  waitForFinish = 120
})

print("Run ID: " .. result.id)
print("Status: " .. result.status)
print("Dataset ID: " .. result.defaultDatasetId)
```

```lua
-- Run and check status later
local run = app.integrations.apify.run_actor({
  actorId = "apify/cheerio-scraper",
  input = {
    startUrls = { { url = "https://news.ycombinator.com" } },
    globs = { "https://news.ycombinator.com/*" }
  }
})

-- Poll for completion
local status = app.integrations.apify.get_run({ runId = run.id })
while status.status == "RUNNING" do
  os.execute("sleep 5")
  status = app.integrations.apify.get_run({ runId = run.id })
end

print("Run finished with status: " .. status.status)
```

---

## get_run

Get details and status of an actor run.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `runId` | string | yes | The actor run ID |

### Run Statuses

| Status | Description |
|--------|-------------|
| `READY` | Run is queued but not started |
| `RUNNING` | Run is currently executing |
| `SUCCEEDED` | Run completed successfully |
| `FAILED` | Run ended with an error |
| `ABORTED` | Run was manually aborted |
| `TIMING-OUT` | Run is about to time out |
| `TIMED-OUT` | Run exceeded its timeout |

### Example

```lua
local run = app.integrations.apify.get_run({ runId = "abc123XYZ" })
print("Status: " .. run.status)
print("Dataset: " .. (run.defaultDatasetId or "none"))
print("Duration: " .. (run.durationMillis or 0) .. "ms")
```

---

## list_actors

List actors available to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offset` | integer | no | Number of actors to skip (default: 0) |
| `limit` | integer | no | Maximum actors to return (default: 20, max: 1000) |

### Example

```lua
local result = app.integrations.apify.list_actors({ limit = 10 })

for _, actor in ipairs(result.actors) do
  print(actor.fullName .. ": " .. (actor.description or "no description"))
end
```

---

## get_actor

Get details of a specific actor, including its input schema.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `actorId` | string | yes | Actor ID (e.g. `"apify/web-scraper"`) |

### Example

```lua
local actor = app.integrations.apify.get_actor({ actorId = "apify/web-scraper" })
print("Name: " .. actor.fullName)
print("Description: " .. (actor.description or ""))

-- Check input schema to understand required parameters
if actor.inputSchema then
  for key, schema in pairs(actor.inputSchema.properties or {}) do
    print("  Input: " .. key .. " (" .. (schema.type or "?") .. ")")
  end
end
```

---

## list_datasets

List datasets accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offset` | integer | no | Number of datasets to skip (default: 0) |
| `limit` | integer | no | Maximum datasets to return (default: 20, max: 1000) |

### Example

```lua
local result = app.integrations.apify.list_datasets({ limit = 10 })

for _, ds in ipairs(result.datasets) do
  print(ds.id .. " (" .. (ds.name or "unnamed") .. "): " .. ds.itemCount .. " items")
end
```

---

## get_dataset

Get details of a specific dataset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `datasetId` | string | yes | The dataset ID |

### Example

```lua
local ds = app.integrations.apify.get_dataset({ datasetId = "abc123XYZ" })
print("Items: " .. ds.itemCount)
print("Name: " .. (ds.name or "unnamed"))
```

---

## get_dataset_items

Retrieve items from a dataset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `datasetId` | string | yes | The dataset ID |
| `format` | string | no | Response format: `"json"` (default), `"csv"`, `"xml"`, `"html"`, `"xlsx"`, `"rss"`, `"jsonl"` |
| `limit` | integer | no | Max items to return (default: 100) |
| `offset` | integer | no | Number of items to skip (default: 0) |

### Example

```lua
-- Get first 50 items from a dataset
local result = app.integrations.apify.get_dataset_items({
  datasetId = "abc123XYZ",
  limit = 50
})

for _, item in ipairs(result.items) do
  print(item.url .. ": " .. (item.title or ""))
end
```

```lua
-- Export as CSV
local result = app.integrations.apify.get_dataset_items({
  datasetId = "abc123XYZ",
  format = "csv"
})
-- result.data contains the raw CSV string
```

---

## list_key_value_stores

List key-value stores accessible to the authenticated user.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `offset` | integer | no | Number of stores to skip (default: 0) |
| `limit` | integer | no | Maximum stores to return (default: 20, max: 1000) |

### Example

```lua
local result = app.integrations.apify.list_key_value_stores({ limit = 10 })

for _, store in ipairs(result.stores) do
  print(store.id .. " (" .. (store.name or "unnamed") .. ")")
end
```

---

## get_record

Get a record from a key-value store by its key.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `storeId` | string | yes | The key-value store ID |
| `key` | string | yes | Record key (e.g. `"OUTPUT"`, `"SCREENSHOT"`) |

### Common Record Keys

| Key | Description |
|-----|-------------|
| `OUTPUT` | Actor's main output result |
| `SCREENSHOT` | Page screenshot (PNG/JPEG) |
| `PAGE_CONTENT` | Raw page HTML content |

### Example

```lua
-- Get actor output
local record = app.integrations.apify.get_record({
  storeId = "store123ABC",
  key = "OUTPUT"
})

if record.type == "json" then
  for k, v in pairs(record.data) do
    print(k .. ": " .. tostring(v))
  end
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.apify.get_current_user({})
print("User: " .. user.username)
print("Plan: " .. (user.plan or "free"))
print("Monthly usage: $" .. (user.monthlyUsageUsd or 0))
```

---

## Multi-Account Usage

If you have multiple Apify accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.apify.run_actor({...})

-- Explicit default (portable across setups)
app.integrations.apify.default.run_actor({...})

-- Named accounts
app.integrations.apify.production.run_actor({...})
app.integrations.apify.staging.run_actor({...})
```

All functions are identical across accounts — only the credentials differ.
