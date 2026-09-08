# Bitly Ruby Reference

Namespace: `bitly`

Bitly tools target API v4 and use bearer access tokens.

## Links

```ruby
short = app.integrations.bitly.shorten_link(long_url: "https://example.test/campaign")
created = app.integrations.bitly.create_bitlink(long_url: "https://example.test/landing-page", title: "Campaign", tags: ["campaign"])
link = app.integrations.bitly.get_link(bitlink: "bit.ly/abc123")
expanded = app.integrations.bitly.expand_bitlink(bitlink: "bit.ly/abc123")
updated = app.integrations.bitly.update_link(bitlink: "bit.ly/abc123", title: "Updated campaign", archived: false)
```
Custom Bitlinks require a custom domain:

```ruby
custom = app.integrations.bitly.add_custom_bitlink(custom_bitlink: "links.example.test/campaign", bitlink_id: "links.example.test/abc123")
```
## Analytics

```ruby
clicks = app.integrations.bitly.get_clicks(bitlink: "bit.ly/abc123", unit: "day", units: 30)
summary = app.integrations.bitly.get_click_summary(bitlink: "bit.ly/abc123", params: {unit: "day", units: 30})
countries = app.integrations.bitly.get_click_countries(bitlink: "bit.ly/abc123", params: {unit: "day", units: 30, size: 10})
```
## Groups, QR Codes, And Webhooks

```ruby
groups = app.integrations.bitly.list_groups()
group_links = app.integrations.bitly.list_group_bitlinks(group_guid: "group_guid", params: {size: 25})
qr = app.integrations.bitly.create_qr_code(body: {title: "Campaign QR", destination: {bitlink_id: "bit.ly/abc123"}})
webhooks = app.integrations.bitly.list_organization_webhooks(organization_guid: "org_guid")
```
## Generic API

```ruby
result = app.integrations.bitly.api_get(path: "/groups")
```
Generic write tools:

- `api_post({ path, body })`
- `api_patch({ path, body })`
- `api_delete({ path, body })`
