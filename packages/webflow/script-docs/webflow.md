# Webflow — Ruby API Reference

## list_sites

List all Webflow sites the authenticated user has access to.

### Parameters

None.

### Example

```ruby
result = app.integrations.webflow.list_sites()
result.sites.each do |site|
  puts((site.name).to_s + " (" + (site.id).to_s + ")")
end
```
---

## get_site

Get details for a specific Webflow site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the Webflow site |

### Example

```ruby
result = app.integrations.webflow.get_site(id: "641d84b8f0bca14670785897")
puts(result.name)
puts(result.domain)
```
---

## list_collections

List CMS collections for a Webflow site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `site_id` | string | yes | The unique identifier of the Webflow site |
| `limit` | integer | no | Maximum number of collections to return (default: 100) |
| `offset` | integer | no | Number of collections to skip for pagination (default: 0) |

### Example

```ruby
result = app.integrations.webflow.list_collections(site_id: "641d84b8f0bca14670785897")
result.collections.each do |collection|
  puts((collection.displayName).to_s + " (" + (collection.slug).to_s + ")")
end
```
---

## list_items

List items in a Webflow CMS collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `limit` | integer | no | Maximum number of items to return (default: 100) |
| `offset` | integer | no | Number of items to skip for pagination (default: 0) |

### Example

```ruby
result = app.integrations.webflow.list_items(collection_id: "641d84b8f0bca14670785901", limit: 10)
result.items.each do |item|
  puts(item.fieldData.name)
end
```
### Paginated example

```ruby
offset = 0
limit = 50
all_items = []
# Bound pagination; persist the next cursor if more pages remain.
10.times do
  result = app.integrations.webflow.list_items(collection_id: "641d84b8f0bca14670785901", limit: limit, offset: offset)
  result.items.each do |item|
    all_items.push(item)
  end
  offset = (offset + limit)
  break unless (!(result.items.length < limit))
end
```
---

## get_item

Get a single CMS item from a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `id` | string | yes | The unique identifier of the CMS item |

### Example

```ruby
result = app.integrations.webflow.get_item(collection_id: "641d84b8f0bca14670785901", id: "641d84b8f0bca14670785905")
puts(result.fieldData.name)
puts(result.fieldData.slug)
```
---

## create_item

Create a new item in a Webflow CMS collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `collection_id` | string | yes | The unique identifier of the CMS collection |
| `fields` | object | yes | Field data as key-value pairs matching the collection schema |
| `live` | boolean | no | Whether to publish the item immediately (default: false) |

### Common Fields

| Field | Description |
|-------|-------------|
| `name` | Item display name |
| `slug` | URL slug (auto-generated from name if omitted) |
| `_draft` | Whether the item is a draft |
| `_archived` | Whether the item is archived |

Field names vary by collection. Use `list_collections` to inspect schema fields.

### Examples

#### Create a draft item

```ruby
result = app.integrations.webflow.create_item(collection_id: "641d84b8f0bca14670785901", fields: {name: "My New Blog Post", slug: "my-new-blog-post", _draft: true})
puts("Created item: " + (result.id).to_s)
```
#### Create and publish immediately

```ruby
result = app.integrations.webflow.create_item(collection_id: "641d84b8f0bca14670785901", fields: {name: "Breaking News", slug: "breaking-news"}, live: true)
puts("Published item: " + (result.id).to_s)
```
---

## get_current_user

Get the currently authenticated Webflow user.

### Parameters

None.

### Example

```ruby
result = app.integrations.webflow.get_current_user()
puts(result.user.email)
puts((result.user.firstName).to_s + " " + (result.user.lastName).to_s)
```
---

## Multi-Account Usage

If you have multiple Webflow accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.webflow.list_sites()
# Explicit default (portable across setups)
app.integrations.webflow.default.list_sites()
# Named accounts
app.integrations.webflow.production.list_sites()
app.integrations.webflow.staging.list_sites()
```
All functions are identical across accounts — only the credentials differ.
