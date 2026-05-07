# Beamer Lua Reference

Namespace: `app.integrations.beamer`

The Beamer API uses the `Beamer-Api-Key` header. Tools return raw Beamer JSON.

## Core Tools

```lua
local posts = app.integrations.beamer.list_posts({
  limit = 10,
  page = 1,
  status = "published",
})

local post = app.integrations.beamer.get_post({ id = 123 })

local created = app.integrations.beamer.create_post({
  title = "New feature",
  content = "<p>We shipped it.</p>",
  category = 5,
})

local comments = app.integrations.beamer.list_comments({ post_id = 123 })
local categories = app.integrations.beamer.list_categories({})
local me = app.integrations.beamer.get_current_user({})
```

## Generic API

Use generic tools for Beamer endpoints that do not have dedicated wrappers.
Paths are relative to `https://api.getbeamer.com/v0`.

```lua
local unread = app.integrations.beamer.api_get({
  path = "/unread/count",
  params = {
    userId = "user_123",
    userEmail = "user@example.test",
  },
})

local comment = app.integrations.beamer.api_post({
  path = "/posts/123/comments",
  body = {
    userEmail = "user@example.test",
    comment = "Great update",
  },
})
```

Generic write tools:

- `api_post({ path, body })`
- `api_put({ path, body })`
- `api_delete({ path, body })`

## Multi-Account Usage

```lua
app.integrations.beamer.default.list_posts({})
app.integrations.beamer.production.api_get({ path = "/unread/count" })
```
