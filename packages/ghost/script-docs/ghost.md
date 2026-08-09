# Ghost CMS JavaScript API Reference

Namespace: `app.integrations.ghost`

Ghost tools use the Ghost Admin API with an Admin API key in `id:secret` format. Update calls usually require the current `updated_at` value from Ghost to avoid overwriting stale content.

## Content

```js
var posts = app.integrations.ghost.list_posts({
  params: { limit: 10, include: "tags,authors" },
})

var post = app.integrations.ghost.get_post({
  id: "post-id",
  params: { formats: "html,lexical", include: "tags,authors" },
})

app.integrations.ghost.create_post({
  post: {
    title: "Launch notes",
    html: "<p>Hello</p>",
    status: "draft",
  }
})
```
Pages use the same pattern with `list_pages`, `get_page`, `create_page`, `update_page`, and `delete_page`.

## Taxonomy And Authors

```js
var tags = app.integrations.ghost.list_tags({ params: { limit: 100 } })
var authors = app.integrations.ghost.list_authors({})
```
Tag mutation tools accept a `tag` object and wrap it in Ghost's native `tags` payload.

## Members And Monetization

```js
var members = app.integrations.ghost.list_members({
  params: { filter: "status:free" },
})

var tiers = app.integrations.ghost.list_tiers({})
var offers = app.integrations.ghost.list_offers({})
var newsletters = app.integrations.ghost.list_newsletters({})
```
Use member, tier, and offer create/update tools only when the connected Admin API key has the matching Ghost permissions.

## Webhooks And Site

```js
var webhooks = app.integrations.ghost.list_webhooks({})
var site = app.integrations.ghost.get_site({})
```
## Raw API Helpers

Use `api_get`, `api_post`, `api_put`, and `api_delete` for safe relative Admin API paths. Full URLs and parent-directory paths are rejected.

```js
var response = app.integrations.ghost.api_get({
  path: "/posts",
  query: { limit: 5 },
})
```