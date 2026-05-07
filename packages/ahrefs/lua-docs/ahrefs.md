# Ahrefs Lua Reference

Namespace: `ahrefs`

Ahrefs tools target API v3. Configure an Ahrefs API key; the integration sends
it as `Authorization: Bearer <api_key>`.

## Site Explorer

Use Site Explorer tools for backlink, organic, paid, and overview reports. Most
new tools accept a `params` object so agents can pass Ahrefs API fields such as
`target`, `date`, `mode`, `country`, `limit`, `offset`, `select`, and `where`
without the integration hiding upstream options.

```lua
local metrics = app.integrations.ahrefs.get_metrics({
  params = {
    target = "example.test",
    date = "2026-05-06",
    mode = "domain",
    country = "us",
  },
})

local dr = app.integrations.ahrefs.get_domain_rating({
  params = { target = "example.test", date = "2026-05-06" },
})

local backlinks = app.integrations.ahrefs.list_backlinks({
  target = "example.test",
  mode = "domain",
  limit = 25,
})

local broken = app.integrations.ahrefs.list_broken_backlinks({
  params = { target = "example.test", mode = "domain", limit = 25 },
})

local competitors = app.integrations.ahrefs.list_organic_competitors({
  params = { target = "example.test", mode = "domain", date = "2026-05-06", country = "us" },
})
```

Additional Site Explorer tools:

- `list_referring_domains({ target, limit?, offset?, mode? })`
- `list_organic_keywords({ target, limit?, offset?, mode? })`
- `list_pages({ target, limit?, offset?, mode? })`
- `list_paid_pages({ params })`
- `list_anchors({ target, limit?, offset? })`
- `list_linked_domains({ params })`
- `get_backlinks_stats({ params })`

## Subscription

```lua
local usage = app.integrations.ahrefs.get_limits_and_usage({})
```

This replaces the old current-user helper. Ahrefs API v3 documents subscription
limits and usage, not a `/users/me` profile endpoint.

## Generic API

Use `api_get` for Ahrefs API v3 endpoints without dedicated wrappers:

```lua
local result = app.integrations.ahrefs.api_get({
  path = "/v3/site-explorer/metrics-by-country",
  params = {
    target = "example.test",
    date = "2026-05-06",
    mode = "domain",
  },
})
```
