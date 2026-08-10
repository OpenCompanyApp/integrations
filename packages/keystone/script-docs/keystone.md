# KeystoneJS — JavaScript API Reference

## list_lists

List all available lists (collections) in the KeystoneJS instance. Returns list keys, labels, and metadata.

### Parameters

None.

### Examples

```js
var result = app.integrations.keystone.list_lists()

for (const list of (result.data)) {
  console.log(list.key + " — " + list.label)
}
```
---

## get_list

Get metadata and field schema for a specific KeystoneJS list. Returns field definitions, access control, and display configuration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_key` | string | yes | The list key (e.g. `"posts"`, `"users"`, `"comments"`). |

### Examples

```js
var result = app.integrations.keystone.get_list({
  list_key: "posts",
})

console.log("List: " + result.data.label)
for (const field of (result.data.fields)) {
  console.log("  " + field.key + " (" + field.type + ")")
}
```
---

## list_items

List items in a KeystoneJS list with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_key` | string | yes | The list key to query (e.g. `"posts"`, `"users"`, `"products"`). |
| `take` | integer | no | Maximum number of items to return (default: 50). |
| `skip` | integer | no | Number of items to skip for pagination. |
| `sort` | string | no | Sort field(s). Prefix with `"-"` for descending (e.g. `"-createdAt"`). |
| `where` | object | no | Filter object for querying. E.g. `{status = {equals = "published"}}`. |
| `search` | string | no | Search query to filter items across searchable fields. |
| `fields` | string | no | Comma-separated list of fields to include in the response. |

### Filter Syntax

KeystoneJS filters use an object notation with operators:

```js
where = {
  status: { equals: "published" },
  viewCount: { gte: 100 },
}
```
Common operators: `equals`, `not`, `gt`, `gte`, `lt`, `lte`, `contains`, `startsWith`, `endsWith`, `in`, `notIn`

### Examples

```js
// List recent posts
var result = app.integrations.keystone.list_items({
  list_key: "posts",
  take: 10,
  sort: "-createdAt",
  fields: "id,title,slug,createdAt",
})

for (const item of (result.data)) {
  console.log(item.title)
}
```
```js
// With filter
var result = app.integrations.keystone.list_items({
  list_key: "products",
  where: {
    category: { equals: "electronics" },
    price: { lte: 100 },
  },
  sort: "price",
  take: 20,
})
```
```js
// Search across fields
var result = app.integrations.keystone.list_items({
  list_key: "posts",
  search: "climate change",
  take: 5,
})
```
---

## get_item

Retrieve a single item from a KeystoneJS list by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_key` | string | yes | The list key (e.g. `"posts"`, `"users"`, `"products"`). |
| `id` | string | yes | The ID of the item to retrieve. |
| `fields` | string | no | Comma-separated list of fields to include in the response. |

### Examples

```js
var item = app.integrations.keystone.get_item({
  list_key: "posts",
  id: "clxyz123456",
  fields: "id,title,content,author",
})

console.log(item.data.title)
```
---

## create_item

Create a new item in a KeystoneJS list with the provided field values.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_key` | string | yes | The list key (e.g. `"posts"`, `"users"`, `"products"`). |
| `data` | object | yes | Object containing the field values for the new item. Keys are field names, values are the field data. |

### Examples

```js
var item = app.integrations.keystone.create_item({
  list_key: "posts",
  data: {
    title: "My New Post",
    content: "Post content here...",
    status: "draft",
  }
})

console.log("Created with ID: " + item.data.id)
```
---

## list_users

List users in the KeystoneJS instance with optional filtering, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `take` | integer | no | Maximum number of users to return (default: 50). |
| `skip` | integer | no | Number of users to skip for pagination. |
| `sort` | string | no | Sort field(s). Prefix with `"-"` for descending. |
| `where` | object | no | Filter object. E.g. `{role = {equals = "admin"}}`. |
| `search` | string | no | Search query to filter users by name or email. |
| `fields` | string | no | Comma-separated list of fields to include. |

### Examples

```js
// List all users
var result = app.integrations.keystone.list_users({
  take: 20,
  fields: "id,name,email,role",
})

for (const user of (result.data)) {
  console.log(user.name + " <" + user.email + "> — " + user.role)
}
```
```js
// Search for a specific user
var result = app.integrations.keystone.list_users({
  search: "john",
  take: 5,
})
```
---

## get_current_user

Get the profile of the currently authenticated KeystoneJS user. Useful for verifying the connection and understanding user permissions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated list of user fields to include (e.g. `"id,name,email,role"`). |

### Examples

```js
var result = app.integrations.keystone.get_current_user()

console.log("Logged in as: " + result.data.name)
console.log("Email: " + result.data.email)
```
---

## Multi-Account Usage

If you have multiple KeystoneJS instances configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.keystone.list_items({list_key: "posts"})

// Explicit default (portable across setups)
app.integrations.keystone.default.list_items({list_key: "posts"})

// Named accounts
app.integrations.keystone.production.list_items({list_key: "posts"})
app.integrations.keystone.staging.list_items({list_key: "posts"})
```
All functions are identical across accounts — only the credentials differ.
