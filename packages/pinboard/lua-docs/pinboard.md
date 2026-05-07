# Pinboard

Namespace: `pinboard`

Use this integration to manage Pinboard bookmarks, tags, user feed credentials, API tokens, and notes. Pinboard v1 uses `auth_token` in the query string and supports JSON responses through `format=json`, which this integration adds automatically.

## Bookmarks

Add or update a bookmark:

```lua
pinboard_posts_add({
  url = "https://example.test/article",
  description = "Example Article",
  payload = {
    extended = "Short note",
    tags = "research examples",
    replace = "yes",
    shared = "no",
    toread = "yes"
  }
})
```

Read bookmarks:

```lua
pinboard_posts_recent({
  payload = {
    tag = "research",
    count = 25
  }
})

pinboard_posts_all({
  payload = {
    tag = "research",
    start = 0,
    results = 100,
    meta = "yes"
  }
})
```

Other bookmark tools:

- `pinboard_posts_update` returns the latest add/update/delete timestamp.
- `pinboard_posts_get` returns posts for a date or URL.
- `pinboard_posts_dates` returns bookmark counts by date.
- `pinboard_posts_suggest` returns popular and recommended tags for a URL.
- `pinboard_posts_delete` deletes a bookmark by URL.

## Tags

```lua
pinboard_tags_get({})

pinboard_tags_rename({
  old = "old-tag",
  new = "new-tag"
})

pinboard_tags_delete({ tag = "obsolete" })
```

## User And Notes

`pinboard_user_secret` returns the secret RSS key. `pinboard_user_api_token` returns the API token for API calls without a password.

```lua
pinboard_notes_list({})

pinboard_notes_get({ note_id = "note:2a8a2ec9f3a076a1" })
```

## Raw GET

`pinboard_api_get` calls a safe relative Pinboard v1 path and injects `auth_token` and `format=json`. It rejects absolute URLs.

```lua
pinboard_api_get({
  path = "/posts/recent",
  payload = {
    tag = "research",
    count = 10
  }
})
```
