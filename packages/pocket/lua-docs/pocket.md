# Pocket

Namespace: `pocket`

Use this integration to connect a Pocket account, save URLs, retrieve saved items, archive or re-add items, favorite items, delete items, and manage tags.

## Authentication

Pocket v3 requests use a `consumer_key` and a user `access_token` in the JSON body. The access token is obtained through Pocket's request-token flow.

Start authorization:

```lua
pocket_request_token({
  redirect_uri = "https://example.test/oauth/pocket/callback",
  payload = {
    state = "session-123"
  }
})
```

Build the URL the user must open:

```lua
pocket_authorize_url({
  request_token = "dcba4321-dcba-4321-dcba-4321dc",
  redirect_uri = "https://example.test/oauth/pocket/callback"
})
```

After the user approves the request token, exchange it for an access token:

```lua
pocket_access_token({
  code = "dcba4321-dcba-4321-dcba-4321dc"
})
```

## Save And Retrieve

Save one URL:

```lua
pocket_add_item({
  url = "https://example.test/article",
  payload = {
    title = "Example Article",
    tags = "research,examples"
  }
})
```

Retrieve items:

```lua
pocket_retrieve_items({
  payload = {
    state = "unread",
    detailType = "complete",
    count = 30,
    offset = 0,
    total = 1
  }
})
```

Pocket's documented page size limit is 30. Use `count`, `offset`, and `total` to paginate.

## Modify Actions

Convenience tools map to Pocket `/v3/send` action names:

- `pocket_archive_item`
- `pocket_readd_item`
- `pocket_favorite_item`
- `pocket_unfavorite_item`
- `pocket_delete_item`
- `pocket_add_tags`
- `pocket_remove_tags`
- `pocket_replace_tags`
- `pocket_clear_tags`
- `pocket_rename_tag`
- `pocket_delete_tag`

Examples:

```lua
pocket_archive_item({ item_id = "229279689" })

pocket_add_tags({
  item_id = "229279689",
  tags = "research,read-later"
})

pocket_rename_tag({
  old_tag = "old-name",
  new_tag = "new-name"
})
```

For batch changes, use raw action objects:

```lua
pocket_send_actions({
  actions = {
    { action = "archive", item_id = "229279689" },
    { action = "favorite", item_id = "229279690" }
  }
})
```

## Raw POST

`pocket_api_post` calls a safe relative Pocket path and injects configured credentials. It rejects absolute URLs.

```lua
pocket_api_post({
  path = "/v3/get",
  payload = {
    count = 10,
    detailType = "simple"
  }
})
```
