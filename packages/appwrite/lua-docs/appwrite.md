# Appwrite — Lua API Reference

## list_databases

List all databases in the Appwrite project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of databases to return (default: 25) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `search` | string | no | Search term to filter databases by name |

### Example

```lua
local result = app.integrations.appwrite.list_databases({
  limit = 50
})

for _, db in ipairs(result.databases) do
  print(db["$id"] .. ": " .. db.name)
end
```

---

## get_database

Get details of a specific database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The database ID |

### Example

```lua
local result = app.integrations.appwrite.get_database({
  id = "my_database_id"
})

print("Database: " .. result.name)
```

---

## list_collections

List all collections in a database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The database ID |
| `limit` | integer | no | Maximum number of collections to return (default: 25) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.appwrite.list_collections({
  database_id = "my_database_id",
  limit = 50
})

for _, col in ipairs(result.collections) do
  print(col["$id"] .. ": " .. col.name)
end
```

---

## list_documents

List documents in a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The database ID |
| `collection_id` | string | yes | The collection ID |
| `limit` | integer | no | Maximum number of documents to return (default: 25) |
| `offset` | integer | no | Offset for pagination (default: 0) |

### Example

```lua
local result = app.integrations.appwrite.list_documents({
  database_id = "my_database_id",
  collection_id = "my_collection_id",
  limit = 10
})

for _, doc in ipairs(result.documents) do
  print(doc["$id"] .. ": " .. (doc.name or "unnamed"))
end
```

---

## get_document

Get a single document by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The database ID |
| `collection_id` | string | yes | The collection ID |
| `doc_id` | string | yes | The document ID |

### Example

```lua
local result = app.integrations.appwrite.get_document({
  database_id = "my_database_id",
  collection_id = "my_collection_id",
  doc_id = "my_document_id"
})

print("Document: " .. result["$id"])
for key, value in pairs(result) do
  print("  " .. key .. " = " .. tostring(value))
end
```

---

## create_document

Create a new document in a collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database_id` | string | yes | The database ID |
| `collection_id` | string | yes | The collection ID |
| `document_id` | string | yes | Unique ID for the document (use `"unique()"` to auto-generate) |
| `data` | object | yes | Document data as key-value pairs matching collection attributes |

### Example

```lua
local result = app.integrations.appwrite.create_document({
  database_id = "my_database_id",
  collection_id = "my_collection_id",
  document_id = "unique()",
  data = {
    title = "My Document",
    content = "Hello, world!",
    status = "active"
  }
})

print("Created document: " .. result["$id"])
```

---

## get_current_user

Get the currently authenticated Appwrite user account.

### Parameters

None.

### Example

```lua
local result = app.integrations.appwrite.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Appwrite accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.appwrite.list_databases({...})

-- Explicit default (portable across setups)
app.integrations.appwrite.default.list_databases({...})

-- Named accounts
app.integrations.appwrite.production.list_databases({...})
app.integrations.appwrite.staging.list_databases({...})
```

All functions are identical across accounts — only the credentials differ.
