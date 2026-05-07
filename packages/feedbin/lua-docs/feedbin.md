# Feedbin

Namespace: `feedbin`

Feedbin API V2 uses HTTP Basic authentication. Configure `username` and `password`; requests default to `https://api.feedbin.com/v2`.

## Subscriptions And Entries

```lua
feedbin_subscriptions_create({
  feed_url = "https://example.test/feed.xml"
})

feedbin_entries_list({
  payload = {
    page = 1,
    per_page = 50,
    read = false,
    starred = true,
    mode = "extended"
  }
})

feedbin_feed_entries_list({
  feed_id = "203",
  payload = { page = 2 }
})
```

Subscription tools cover list/get/create/update/delete, including the POST update fallback. Entry tools cover all entries, feed entries, and single entry lookup.

## State, Tags, And Searches

```lua
feedbin_unread_entries_create({ unread_entries = { 1, 2, 3 } })
feedbin_unread_entries_delete({ unread_entries = { 1, 2, 3 } })

feedbin_starred_entries_create({ starred_entries = { 1 } })
feedbin_taggings_create({ feed_id = 47, name = "Research" })

feedbin_saved_searches_create({
  name = "Unread security",
  query = "is:unread security"
})
```

The API also exposes recently read entries, updated entries, icons, OPML imports, and saved pages.

## Imports And Raw Calls

`feedbin_imports_create` expects `opml` with XML text and sends it as `text/xml`.

Raw helpers reject absolute URLs:

```lua
feedbin_api_get({
  path = "/entries.json",
  payload = { ids = "1,2,3" }
})
```
