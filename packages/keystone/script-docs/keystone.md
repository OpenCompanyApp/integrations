# KeystoneJS — Ruby API Reference

## list_lists

List all available lists (collections) in the KeystoneJS instance. Returns list keys, labels, and metadata.

### Parameters

None.

### Examples

```ruby
result = app.integrations.keystone.list_lists()
result.data.each do |list|
  puts((list.key).to_s + " — " + (list.label).to_s)
end
```
---

## get_list

Get metadata and field schema for a specific KeystoneJS list. Returns field definitions, access control, and display configuration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `list_key` | string | yes | The list key (e.g. `"posts"`, `"users"`, `"comments"`). |

### Examples

```ruby
result = app.integrations.keystone.get_list(list_key: "posts")
puts("List: " + (result.data.label).to_s)
result.data.fields.each do |field|
  puts("  " + (field.key).to_s + " (" + (field.type).to_s + ")")
end
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

```ruby
where = {status: {equals: "published"}, viewCount: {gte: 100}}
```
Common operators: `equals`, `not`, `gt`, `gte`, `lt`, `lte`, `contains`, `startsWith`, `endsWith`, `in`, `notIn`

### Examples

```ruby
# List recent posts
result = app.integrations.keystone.list_items(list_key: "posts", take: 10, sort: "-createdAt", fields: "id,title,slug,createdAt")
result.data.each do |item|
  puts(item.title)
end
```
```ruby
# With filter
result = app.integrations.keystone.list_items(list_key: "products", where: {category: {equals: "electronics"}, price: {lte: 100}}, sort: "price", take: 20)
```
```ruby
# Search across fields
result = app.integrations.keystone.list_items(list_key: "posts", search: "climate change", take: 5)
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

```ruby
item = app.integrations.keystone.get_item(list_key: "posts", id: "clxyz123456", fields: "id,title,content,author")
puts(item.data.title)
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

```ruby
item = app.integrations.keystone.create_item(list_key: "posts", data: {title: "My New Post", content: "Post content here...", status: "draft"})
puts("Created with ID: " + (item.data.id).to_s)
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

```ruby
# List all users
result = app.integrations.keystone.list_users(take: 20, fields: "id,name,email,role")
result.data.each do |user|
  puts((user.name).to_s + " <" + (user.email).to_s + "> — " + (user.role).to_s)
end
```
```ruby
# Search for a specific user
result = app.integrations.keystone.list_users(search: "john", take: 5)
```
---

## get_current_user

Get the profile of the currently authenticated KeystoneJS user. Useful for verifying the connection and understanding user permissions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `fields` | string | no | Comma-separated list of user fields to include (e.g. `"id,name,email,role"`). |

### Examples

```ruby
result = app.integrations.keystone.get_current_user()
puts("Logged in as: " + (result.data.name).to_s)
puts("Email: " + (result.data.email).to_s)
```
---

## Multi-Account Usage

If you have multiple KeystoneJS instances configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.keystone.list_items(list_key: "posts")
# Explicit default (portable across setups)
app.integrations.keystone.default.list_items(list_key: "posts")
# Named accounts
app.integrations.keystone.production.list_items(list_key: "posts")
app.integrations.keystone.staging.list_items(list_key: "posts")
```
All functions are identical across accounts — only the credentials differ.
