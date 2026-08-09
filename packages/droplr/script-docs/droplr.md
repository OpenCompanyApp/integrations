# Droplr JavaScript API Reference

Namespace: `app.integrations.droplr`

Droplr tools use the configured bearer-token API base, defaulting to `https://api.droplr.com`. Public Droplr documentation also describes legacy signed endpoints; use the generic helpers for those paths only when the configured environment supports them.

## Drops

```js
var drops = app.integrations.droplr.list_drops({
  type: "LINK",
  sortBy: "CREATION",
  order: "DESC",
  limit: 25,
})

var drop = app.integrations.droplr.get_drop({
  id: "abc123",
})
```
`list_drops` accepts `page`, `limit`, `offset`, `amount`, `type`, `q`, `sortBy`, `order`, `since`, and `until`.

## Create Content

```js
var link = app.integrations.droplr.create_drop({
  link: "https://example.test/docs",
  title: "Documentation",
})

var note = app.integrations.droplr.create_note({
  content: "Release note text",
  title: "Release note",
  variant: "plain",
})

var raw = app.integrations.droplr.create_drop_raw({
  body: {
    type: "LINK",
    link: "https://example.test",
    privacy: "OBSCURE",
  }
})
```
`extra` on `create_drop` and `create_note` is merged into the request body for API-supported fields such as privacy or password.

## Update And Delete

```js
var updated = app.integrations.droplr.update_drop({
  id: "abc123",
  body: {
    title: "Updated title",
  }
})

app.integrations.droplr.delete_drop({
  id: "abc123",
})
```
## Boards And Account

```js
var boards = app.integrations.droplr.list_boards({
  limit: 10,
})

var user = app.integrations.droplr.get_current_user()

var updated_user = app.integrations.droplr.update_current_user({
  body: {
    theme: "dark",
  }
})
```
## Generic API Helpers

```js
var result = app.integrations.droplr.api_get({
  path: "/v2/drops",
  params: { limit: 10 },
})

var changed = app.integrations.droplr.api_put({
  path: "/v2/user",
  body: { theme: "dark" },
})
```
Available helpers:

| Function | Purpose |
|----------|---------|
| `api_get` | GET with optional query params |
| `api_post` | POST with JSON body |
| `api_put` | PUT with JSON body |
| `api_delete` | DELETE with optional JSON body |

Absolute URLs are rejected; pass a relative path such as `/v2/drops/abc123`.

## Multi-Account Usage

```js
app.integrations.droplr.list_drops({ limit: 10 })
app.integrations.droplr.default.list_drops({ limit: 10 })
app.integrations.droplr.work.list_drops({ limit: 10 })
```