# KeystoneJS — Lua API Reference

## list_lists

List all available lists (collections) in the KeystoneJS instance. Returns list keys, labels, and metadata.

### Parameters

None.

### Examples

```lua
local result = app.integrations.keystone.list_lists()

for _, list in ipairs(result.data) do
  print(list.key .. " — " .. list.label)
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

```lua
local result = app.integrations.keystone.get_list({
  list_key = "posts"
})

print("List: " .. result.data.label)
for _, field in ipairs(result.data.fields) do
  print("  " .. field.key .. " (" .. field.type .. ")")
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

```lua
where = {
  status = { equals = "published" },
  viewCount = { gte = 100 }
}
```

Common operators: `equals`, `not`, `gt`, `gte`, `lt`, `lte`, `contains`, `startsWith`, `endsWith`, `in`, `notIn`

### Examples

```lua
-- List recent posts
local result = app.integrations.keystone.list_items({
  list_key = "posts",
  take = 10,
  sort = "-createdAt",
  fields = "id,title,slug,createdAt"
})

for _, item in ipairs(result.data) do
  print(item.title)
end
```

```lua
-- With filter
local result = app.integrations.keystone.list_items({
  list_key = "products",
  where = {
    category = { equals = "electronics" },
    price = { lte = 100 }
  },
  sort = "price",
  take = 20
})
```

```lua
-- Search across fields
local result = app.integrations.keystone.list_items({
  list_key = "posts",
  search = "climate change",
  take = 5
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

```lua
local item = app.integrations.keystone.get_item({
  list_key = "posts",
  id = "clxyz123456",
  fields = "id,title,content,author"
})

print(item.data.title)
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

```lua
local item = app.integrations.keystone.create_item({
  list_key = "posts",
  data = {
    title = "My New Post",
    content = "Post content here...",
    status = "draft"
  }
})

print("Created with ID: " .. item.data.id)
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

```lua
-- List all users
local result = app.integrations.keystone.list_users({
  take = 20,
  fields = "id,name,email,role"
})

for _, user in ipairs(result.data) do
  print(user.name .. " <" .. user.email .. "> — " .. user.role)
end
```

```lua
-- Search for a specific user
local result = app.integrations.keystone.list_users({
  search = "john",
  take = 5
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

```lua
local result = app.integrations.keystone.get_current_user()

print("Logged in as: " .. result.data.name)
print("Email: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple KeystoneJS instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.keystone.list_items({list_key = "posts"})

-- Explicit default (portable across setups)
app.integrations.keystone.default.list_items({list_key = "posts"})

-- Named accounts
app.integrations.keystone.production.list_items({list_key = "posts"})
app.integrations.keystone.staging.list_items({list_key = "posts"})
```

All functions are identical across accounts — only the credentials differ.
