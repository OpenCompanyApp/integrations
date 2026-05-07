# Ghost CMS Lua API Reference

Namespace: `app.integrations.ghost`

Ghost tools use the Ghost Admin API with an Admin API key in `id:secret` format. Update calls usually require the current `updated_at` value from Ghost to avoid overwriting stale content.

## Content

```lua
local posts = app.integrations.ghost.list_posts({
  params = { limit = 10, include = "tags,authors" }
})

local post = app.integrations.ghost.get_post({
  id = "post-id",
  params = { formats = "html,lexical", include = "tags,authors" }
})

app.integrations.ghost.create_post({
  post = {
    title = "Launch notes",
    html = "<p>Hello</p>",
    status = "draft"
  }
})
```

Pages use the same pattern with `list_pages`, `get_page`, `create_page`, `update_page`, and `delete_page`.

## Taxonomy And Authors

```lua
local tags = app.integrations.ghost.list_tags({ params = { limit = 100 } })
local authors = app.integrations.ghost.list_authors({})
```

Tag mutation tools accept a `tag` object and wrap it in Ghost's native `tags` payload.

## Members And Monetization

```lua
local members = app.integrations.ghost.list_members({
  params = { filter = "status:free" }
})

local tiers = app.integrations.ghost.list_tiers({})
local offers = app.integrations.ghost.list_offers({})
local newsletters = app.integrations.ghost.list_newsletters({})
```

Use member, tier, and offer create/update tools only when the connected Admin API key has the matching Ghost permissions.

## Webhooks And Site

```lua
local webhooks = app.integrations.ghost.list_webhooks({})
local site = app.integrations.ghost.get_site({})
```

## Raw API Helpers

Use `api_get`, `api_post`, `api_put`, and `api_delete` for safe relative Admin API paths. Full URLs and parent-directory paths are rejected.

```lua
local response = app.integrations.ghost.api_get({
  path = "/posts",
  query = { limit = 5 }
})
```
