# Sanity — Lua API Reference

## sanity_query_documents

Query documents using GROQ (Graph-Relational Object Queries).

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | GROQ query string |
| `params` | object | no | Parameters referenced in the query as `$paramName` |

### GROQ Basics

GROQ is Sanity's query language. Common patterns:

- `*[_type == "post"]` — all documents of type "post"
- `*[_type == "post" && defined(slug)]` — with a slug field
- `*[_type == "post"] | order(publishedAt desc) [0..9]` — first 10, newest first
- `*[_type == "post"] {title, slug, publishedAt}` — pick specific fields
- `*[_type == "post" && slug.current == $slug][0]` — find by slug using params

### Examples

```lua
-- Get all posts
local result = app.integrations.sanity.query_documents({
  query = '*[_type == "post"] {title, slug, publishedAt}'
})

for _, doc in ipairs(result.result) do
  print(doc.title)
end
```

```lua
-- Get a post by slug using params
local result = app.integrations.sanity.query_documents({
  query = '*[_type == "post" && slug.current == $slug][0]',
  params = { slug = "hello-world" }
})

print(result.result.title)
```

---

## sanity_get_document

Retrieve a single document by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID (e.g., `"post-123"`) |

### Examples

```lua
local result = app.integrations.sanity.get_document({
  id = "post-123"
})

print(result.title)
```

---

## sanity_create_document

Create a new document in the dataset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `document` | object | yes | Document data with a required `_type` field |

### Examples

```lua
local result = app.integrations.sanity.create_document({
  document = {
    _type = "post",
    title = "My New Post",
    body = "Hello world!"
  }
})

print("Created document: " .. result.results[1].id)
```

---

## sanity_update_document

Update fields on an existing document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID to update |
| `set` | object | yes | Fields to update |

### Examples

```lua
local result = app.integrations.sanity.update_document({
  id = "post-123",
  set = {
    title = "Updated Title",
    published = true
  }
})
```

---

## sanity_delete_document

Delete a document by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The document ID to delete |

### Examples

```lua
local result = app.integrations.sanity.delete_document({
  id = "post-123"
})

print(result.message)
```

---

## sanity_list_projects

List all Sanity projects accessible to the authenticated user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.sanity.list_projects()

for _, project in ipairs(result) do
  print(project.displayName .. " (" .. project.id .. ")")
end
```

---

## sanity_get_current_user

Get the currently authenticated Sanity user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.sanity.get_current_user()

print("Logged in as: " .. result.name .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple Sanity accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.sanity.function_name({...})

-- Explicit default (portable across setups)
app.integrations.sanity.default.function_name({...})

-- Named accounts
app.integrations.sanity.production.function_name({...})
app.integrations.sanity.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
