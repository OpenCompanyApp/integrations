# Instapaper

Namespace: `instapaper`

Use this integration to save URLs, inspect reading queues, organize folders, update read progress, retrieve article text, and manage bookmark highlights. The Full API uses OAuth 1.0a headers; OAuth parameters are signed by the integration and are not sent in the request body.

## Authentication

Full API tools require `consumer_key`, `consumer_secret`, `oauth_token`, and `oauth_token_secret`.

`instapaper_get_access_token` exchanges xAuth username/password for `oauth_token` and `oauth_token_secret`. It requires only the consumer key and consumer secret from configuration plus safe runtime arguments:

```lua
instapaper_get_access_token({
  x_auth_username = "reader@example.test",
  x_auth_password = "fake-password"
})
```

Simple API tools may use configured `simple_username` and `simple_password`, or explicit runtime `username` and `password` arguments. Do not store or log real passwords in agent-visible output.

## Bookmarks

Save and inspect bookmarks:

```lua
instapaper_add_bookmark({
  url = "https://example.test/article",
  payload = {
    title = "Example Article",
    selection = "Short note",
    folder_id = "12345"
  }
})

instapaper_list_bookmarks({
  payload = {
    folder_id = "unread",
    limit = 25
  }
})
```

Bookmark mutation tools take `bookmark_id`: `instapaper_delete_bookmark`, `instapaper_star_bookmark`, `instapaper_unstar_bookmark`, `instapaper_archive_bookmark`, and `instapaper_unarchive_bookmark`.

`instapaper_move_bookmark` takes `bookmark_id` and `folder_id`. `instapaper_update_read_progress` takes `bookmark_id`, `progress`, and optional timestamp fields in `payload`.

`instapaper_get_bookmark_text` returns readable article HTML as `value` when the API responds with text instead of JSON.

## Folders

Use `instapaper_list_folders`, `instapaper_add_folder`, `instapaper_delete_folder`, and `instapaper_set_folder_order`.

```lua
instapaper_add_folder({ title = "Research" })

instapaper_set_folder_order({
  folder_ids = "12345,67890"
})
```

## Highlights

Highlights use the newer `/api/1.1` paths. The integration interpolates bookmark and highlight ids into the URL.

```lua
instapaper_list_highlights({ bookmark_id = "111" })

instapaper_create_highlight({
  bookmark_id = "111",
  text = "Important passage",
  payload = {
    note = "Use in brief"
  }
})

instapaper_delete_highlight({ highlight_id = "222" })
```

## Simple API

The Simple API is useful for quick credential checks or simple URL saves without the Full API token pair.

```lua
instapaper_simple_authenticate({
  username = "reader@example.test",
  password = "fake-password"
})

instapaper_simple_add_url({
  username = "reader@example.test",
  password = "fake-password",
  url = "https://example.test/post",
  payload = {
    title = "Example Post",
    selection = "Save for later"
  }
})
```

Simple API responses include `status` and either `success`, `value`, or parsed response fields depending on the upstream body.

## Raw Full API POST

`instapaper_api_post` calls a safe relative Full API path with OAuth signing. It rejects absolute URLs.

```lua
instapaper_api_post({
  path = "/api/1/bookmarks/list",
  payload = { limit = 10 }
})
```
