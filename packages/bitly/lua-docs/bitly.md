# Bitly Lua Reference

Namespace: `bitly`

Bitly tools target API v4 and use bearer access tokens.

## Links

```lua
local short = app.integrations.bitly.shorten_link({
  long_url = "https://example.test/campaign",
})

local created = app.integrations.bitly.create_bitlink({
  long_url = "https://example.test/landing-page",
  title = "Campaign",
  tags = {"campaign"},
})

local link = app.integrations.bitly.get_link({ bitlink = "bit.ly/abc123" })
local expanded = app.integrations.bitly.expand_bitlink({ bitlink = "bit.ly/abc123" })

local updated = app.integrations.bitly.update_link({
  bitlink = "bit.ly/abc123",
  title = "Updated campaign",
  archived = false,
})
```

Custom Bitlinks require a custom domain:

```lua
local custom = app.integrations.bitly.add_custom_bitlink({
  custom_bitlink = "links.example.test/campaign",
  bitlink_id = "links.example.test/abc123",
})
```

## Analytics

```lua
local clicks = app.integrations.bitly.get_clicks({
  bitlink = "bit.ly/abc123",
  unit = "day",
  units = 30,
})

local summary = app.integrations.bitly.get_click_summary({
  bitlink = "bit.ly/abc123",
  params = { unit = "day", units = 30 },
})

local countries = app.integrations.bitly.get_click_countries({
  bitlink = "bit.ly/abc123",
  params = { unit = "day", units = 30, size = 10 },
})
```

## Groups, QR Codes, And Webhooks

```lua
local groups = app.integrations.bitly.list_groups({})
local group_links = app.integrations.bitly.list_group_bitlinks({
  group_guid = "group_guid",
  params = { size = 25 },
})

local qr = app.integrations.bitly.create_qr_code({
  body = {
    title = "Campaign QR",
    destination = { bitlink_id = "bit.ly/abc123" },
  },
})

local webhooks = app.integrations.bitly.list_organization_webhooks({
  organization_guid = "org_guid",
})
```

## Generic API

```lua
local result = app.integrations.bitly.api_get({
  path = "/groups",
})
```

Generic write tools:

- `api_post({ path, body })`
- `api_patch({ path, body })`
- `api_delete({ path, body })`
