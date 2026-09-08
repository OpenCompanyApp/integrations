# wallabag

Namespace: `wallabag`

Use this integration to create and manage saved articles in a hosted or self-hosted wallabag instance. The API uses OAuth2 bearer tokens. Configure an instance URL such as `https://app.wallabag.it` or your own wallabag root URL.

## OAuth Tokens

Exchange client/user credentials for a token:

```ruby
app.integrations.wallabag.password_token(client_id: "client-id", client_secret: "client-secret", username: "reader@example.test", password: "fake-password")
```
Refresh a token:

```ruby
app.integrations.wallabag.refresh_token(client_id: "client-id", client_secret: "client-secret", refresh_token: "refresh-token")
```
## Entries

```ruby
app.integrations.wallabag.create_entry(url: "https://example.test/article", payload: {title: "Example Article", tags: "research,examples"})
app.integrations.wallabag.list_entries(payload: {page: 1, perPage: 30, archive: 0, starred: 0})
```
Other entry tools include `wallabag_entries_exists`, `wallabag_entries_get`, `wallabag_entries_update`, `wallabag_entries_delete`, `wallabag_entries_reload`, and `wallabag_entries_export`. For export, pass `format` as `epub`, `mobi`, `pdf`, `txt`, `csv`, `json`, or `xml`.

## Tags And Annotations

```ruby
app.integrations.wallabag.list_tags()
app.integrations.wallabag.add_entry_tags(entry: "123", tags: "research,priority")
app.integrations.wallabag.list_annotations(entry: "123")
app.integrations.wallabag.create_annotation(entry: "123", text: "Important passage", ranges: [{start: "/p[0]", startOffset: 0, "end" => "/p[0]", endOffset: 18}])
```
`wallabag_entry_tag_delete`, `wallabag_annotations_update`, and `wallabag_annotations_delete` handle cleanup and edits.

## Raw API Calls

`wallabag_api_get`, `wallabag_api_post`, `wallabag_api_patch`, and `wallabag_api_delete` call safe relative paths with the configured bearer token. Absolute URLs are rejected.

```ruby
app.integrations.wallabag.api_get(path: "/api/entries.json", payload: {perPage: 10})
```