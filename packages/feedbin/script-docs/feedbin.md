# Feedbin

Namespace: `feedbin`

Feedbin API V2 uses HTTP Basic authentication. Configure `username` and `password`; requests default to `https://api.feedbin.com/v2`.

## Subscriptions And Entries

```ruby
app.integrations.feedbin.create_subscription(feed_url: "https://example.test/feed.xml")
app.integrations.feedbin.feedbin_entries_list(payload: {page: 1, per_page: 50, read: false, starred: true, mode: "extended"})
app.integrations.feedbin.feedbin_feed_entries_list(feed_id: "203", payload: {page: 2})
```
Subscription tools cover list/get/create/update/delete, including the POST update fallback. Entry tools cover all entries, feed entries, and single entry lookup.

## State, Tags, And Searches

```ruby
app.integrations.feedbin.mark_unread(unread_entries: [1, 2, 3])
app.integrations.feedbin.mark_read(unread_entries: [1, 2, 3])
app.integrations.feedbin.star_entries(starred_entries: [1])
app.integrations.feedbin.create_tagging(feed_id: 47, name: "Research")
app.integrations.feedbin.create_saved_search(name: "Unread security", query: "is:unread security")
```
The API also exposes recently read entries, updated entries, icons, OPML imports, and saved pages.

## Imports And Raw Calls

`feedbin_imports_create` expects `opml` with XML text and sends it as `text/xml`.

Raw helpers reject absolute URLs:

```ruby
app.integrations.feedbin.api_get(path: "/entries.json", payload: {ids: "1,2,3"})
```