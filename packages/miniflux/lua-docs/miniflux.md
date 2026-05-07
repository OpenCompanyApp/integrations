# Miniflux

Namespace: `miniflux`

Use Miniflux tools to manage RSS feeds, categories, entries, bookmarks, users,
API keys, OPML import/export, and instance health probes. Configure the root
instance URL without `/v1`; the integration adds documented API paths itself.

Authentication prefers an API key sent as `X-Auth-Token`. Username/password
Basic auth is supported as a fallback for older or manually configured hosts.

## Common Workflows

- `miniflux_feeds_list` lists feeds.
- `miniflux_feeds_create` subscribes to a feed URL. Pass `feed_url` and, for
  older Miniflux versions, `category_id`.
- `miniflux_entries_list` lists entries with filters such as `status`, `limit`,
  `offset`, `order`, `direction`, `starred`, `search`, and timestamp filters in
  `payload`.
- `miniflux_entries_update_status` marks entry IDs as `read`, `unread`, or
  `removed`.
- `miniflux_entries_toggle_bookmark` toggles an entry bookmark.
- `miniflux_opml_export` returns OPML XML in `value`.
- `miniflux_opml_import` sends the `opml` string as an XML request body.
- `miniflux_healthcheck`, `miniflux_liveness`, and `miniflux_readiness` return
  probe text in `value` when the instance responds with plain text.

## Response Shape

JSON responses are returned as:

```lua
{
  status = 200,
  data = { ... }
}
```

Empty successful responses return:

```lua
{
  status = 204,
  success = true
}
```

Plain text and XML responses return:

```lua
{
  status = 200,
  value = "OK"
}
```

## Raw API Tools

Use `miniflux_api_get`, `miniflux_api_post`, `miniflux_api_put`,
`miniflux_api_patch`, and `miniflux_api_delete` only for supported Miniflux
paths not yet represented by a named tool. Raw paths must be relative, for
example `/v1/feeds/counters`; absolute URLs are rejected.

All examples should use fake public data in tests and docs.
