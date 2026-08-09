# Strapi — JavaScript API Reference

## strapi_list_entries

List entries for a content type in Strapi. Supports pagination, sorting, and population of relations.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type (e.g., `"article"`, `"page"`, `"product"`) |
| `page` | integer | no | Page number for pagination (default: 1) |
| `page_size` | integer | no | Number of entries per page (default: 25) |
| `sort` | string | no | Sort field and direction (e.g., `"createdAt:desc"`, `"title:asc"`) |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name (e.g., `"author"`, `"image"`) |

### Examples

```js
// List all articles
var result = app.integrations.strapi.list_entries({
  content_type: "article",
  page_size: 10,
  sort: "createdAt:desc",
  populate: "*",
})

for (const entry of (result.data)) {
  console.log(entry.id + ": " + entry.attributes.title)
}
```
```js
// List products with pagination
var result = app.integrations.strapi.list_entries({
  content_type: "product",
  page: 2,
  page_size: 50,
  populate: "image",
})
```
---

## strapi_get_entry

Get a single entry by content type and ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID |
| `populate` | string | no | Relations to populate: `"*"` for all, or a field name |

### Examples

```js
// Get a single article with all relations
var result = app.integrations.strapi.get_entry({
  content_type: "article",
  id: 42,
  populate: "*",
})

console.log(result.data.attributes.title)
```
---

## strapi_create_entry

Create a new entry for a content type. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `data` | object | yes | The entry data (fields depend on the content type) |

### Examples

```js
// Create a new article
var result = app.integrations.strapi.create_entry({
  content_type: "article",
  data: {
    title: "Hello World",
    body: "This is my first article.",
    publishedAt: null // set to null for draft,
  }
})

console.log("Created entry with ID: " + result.data.id)
```
---

## strapi_update_entry

Update an existing entry by content type and ID. The data is automatically wrapped in the required `"data"` envelope.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to update |
| `data` | object | yes | The fields to update |

### Examples

```js
// Update an article's title
var result = app.integrations.strapi.update_entry({
  content_type: "article",
  id: 42,
  data: {
    title: "Updated Title",
  }
})
```
---

## strapi_delete_entry

Delete an entry by content type and ID. This action is permanent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `content_type` | string | yes | The API ID of the content type |
| `id` | integer | yes | The entry ID to delete |

### Examples

```js
var result = app.integrations.strapi.delete_entry({
  content_type: "article",
  id: 42,
})

console.log(result.message)
```
---

## strapi_list_content_types

List all content types defined in the Strapi Content-Type Builder. Returns API IDs, display names, and schema information.

### Parameters

None.

### Examples

```js
var result = app.integrations.strapi.list_content_types()

for (const ct of (result.data)) {
  console.log(ct.uid + " — " + ct.schema.displayName)
}
```
---

## strapi_get_current_user

Get the currently authenticated Strapi user. Useful for verifying the API token and checking permissions.

### Parameters

None.

### Examples

```js
var result = app.integrations.strapi.get_current_user()

console.log("Connected as: " + result.username + " (" + result.email + ")")
```
---

## Multi-Account Usage

If you have multiple Strapi instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.strapi.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.strapi.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.strapi.production.function_name({ /* parameters */ })
app.integrations.strapi.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
