# Webflow — JavaScript API Reference

## list_sites

List all Webflow sites the authenticated user has access to.

### Parameters

None.

### Example

```js
var result = app.integrations.webflow.list_sites({})

for (const site of (result.sites)) {
  console.log(site.name + " (" + site.id + ")")
}
```
---

## get_site

Get details for a specific Webflow site.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The unique identifier of the Webflow site |

### Example

```js
var result = app.integrations.webflow.get_site({
  id: "641d84b8f0bca14670785897",
})

console.log(result.name)
console.log(result.domain)
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

```js
var result = app.integrations.webflow.list_collections({
  site_id: "641d84b8f0bca14670785897",
})

for (const collection of (result.collections)) {
  console.log(collection.displayName + " (" + collection.slug + ")")
}
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

```js
var result = app.integrations.webflow.list_items({
  collection_id: "641d84b8f0bca14670785901",
  limit: 10,
})

for (const item of (result.items)) {
  console.log(item.fieldData.name)
}
```
### Paginated example

```js
var offset = 0
var limit = 50
var all_items = []

do {
  var result = app.integrations.webflow.list_items({
    collection_id: "641d84b8f0bca14670785901",
    limit: limit,
    offset: offset,
  })

  for (const item of (result.items)) {
    all_items.push(item)
  }

  offset = offset + limit
} while (!(result.items.length < limit));
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

```js
var result = app.integrations.webflow.get_item({
  collection_id: "641d84b8f0bca14670785901",
  id: "641d84b8f0bca14670785905",
})

console.log(result.fieldData.name)
console.log(result.fieldData.slug)
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

```js
var result = app.integrations.webflow.create_item({
  collection_id: "641d84b8f0bca14670785901",
  fields: {
    name: "My New Blog Post",
    slug: "my-new-blog-post",
    _draft: true,
  }
})

console.log("Created item: " + result.id)
```
#### Create and publish immediately

```js
var result = app.integrations.webflow.create_item({
  collection_id: "641d84b8f0bca14670785901",
  fields: {
    name: "Breaking News",
    slug: "breaking-news",
  },
  live: true,
})

console.log("Published item: " + result.id)
```
---

## get_current_user

Get the currently authenticated Webflow user.

### Parameters

None.

### Example

```js
var result = app.integrations.webflow.get_current_user({})

console.log(result.user.email)
console.log(result.user.firstName + " " + result.user.lastName)
```
---

## Multi-Account Usage

If you have multiple Webflow accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.webflow.list_sites({})

// Explicit default (portable across setups)
app.integrations.webflow.default.list_sites({})

// Named accounts
app.integrations.webflow.production.list_sites({})
app.integrations.webflow.staging.list_sites({})
```
All functions are identical across accounts — only the credentials differ.
