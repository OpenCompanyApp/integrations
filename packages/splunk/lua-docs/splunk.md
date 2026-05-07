# Splunk Lua API Reference

Namespace: `app.integrations.splunk`

Configure `access_token` and a Splunk management API services URL, usually
`https://host:8089/services`. Splunk Cloud deployments may require REST API
access to be enabled for the management port.

## Search Jobs

Create an asynchronous job:

```lua
local job = app.integrations.splunk.search({
  query = "search index=main error | head 100",
  earliest_time = "-24h",
  latest_time = "now"
})
```

Inspect and retrieve job data:

```lua
local status = app.integrations.splunk.get_search_job({ sid = job.sid })

local results = app.integrations.splunk.get_search_results({
  sid = job.sid,
  offset = 0,
  count = 100
})

local events = app.integrations.splunk.get_search_events({
  sid = job.sid,
  count = 100
})

local log = app.integrations.splunk.get_search_log({ sid = job.sid })
```

List or cancel jobs:

```lua
local jobs = app.integrations.splunk.list_search_jobs({ count = 50 })
app.integrations.splunk.delete_search_job({ sid = job.sid })
```

Use `export_search` when you need Splunk's export endpoint instead of a stored
job lifecycle:

```lua
local exported = app.integrations.splunk.export_search({
  query = "search index=_internal | head 10",
  earliest_time = "-1h"
})
```

## Indexes

```lua
local indexes = app.integrations.splunk.list_indexes({ count = 100 })
local main = app.integrations.splunk.get_index({ name = "main" })

app.integrations.splunk.create_index({
  name = "example_test",
  options = { maxTotalDataSizeMB = 1024 }
})

app.integrations.splunk.update_index({
  name = "example_test",
  options = { frozenTimePeriodInSecs = 2592000 }
})

app.integrations.splunk.delete_index({ name = "example_test" })
```

## Saved Searches

```lua
local saved = app.integrations.splunk.list_saved_searches({
  search = "name=*error*"
})

local report = app.integrations.splunk.get_saved_search({
  name = "Daily errors"
})

app.integrations.splunk.create_saved_search({
  name = "Daily errors",
  query = "search index=main error | stats count by host",
  options = {
    is_scheduled = 1,
    cron_schedule = "0 8 * * *"
  }
})

app.integrations.splunk.update_saved_search({
  name = "Daily errors",
  options = { description = "Daily error summary" }
})

local dispatched = app.integrations.splunk.dispatch_saved_search({
  name = "Daily errors",
  options = { ["dispatch.earliest_time"] = "-24h" }
})

app.integrations.splunk.delete_saved_search({ name = "Daily errors" })
```

## Apps, Users, And Server Info

```lua
local apps = app.integrations.splunk.list_apps({})
local search_app = app.integrations.splunk.get_app({ name = "search" })

local users = app.integrations.splunk.list_users({})
local admin = app.integrations.splunk.get_user({ username = "admin" })

local current = app.integrations.splunk.get_current_user({})
local server = app.integrations.splunk.get_server_info({})
```

## Raw Services API Helpers

Use raw helpers only for documented Splunk services endpoints that do not yet
have a named tool. Paths must be relative to `/services`; full URLs and
parent-directory segments are rejected.

```lua
local raw = app.integrations.splunk.api_get({
  path = "/server/info",
  params = { output_mode = "json" }
})

local posted = app.integrations.splunk.api_post({
  path = "/saved/searches/Daily%20errors/dispatch",
  payload = { ["dispatch.earliest_time"] = "-24h" }
})
```

## Notes

- Prefer bounded searches with `earliest_time` and `latest_time`.
- Results, events, and logs require the job to exist and the token to have the
  relevant Splunk capabilities.
- Many endpoints return Splunk Atom-style envelopes when `output_mode=json` is
  not honored; this package returns decoded JSON when available or `{ raw = ... }`.
- Splunk Cloud API availability can vary by deployment and support settings.

## Multi-Account Usage

```lua
app.integrations.splunk.search({ query = "search index=main | head 10" })
app.integrations.splunk.production.search({ query = "search index=main | head 10" })
```
