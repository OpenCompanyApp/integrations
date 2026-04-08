# Fauna — Lua API Reference

All tools are accessed via `app.integrations.fauna.{tool_key}({params})`.

---

## fauna_list_databases

List all databases in the current Fauna context. Returns database names and their metadata including creation time and references.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.fauna.fauna_list_databases()

for _, db in ipairs(result.data) do
  print(db.name)
end
```

---

## fauna_get_database

Get details of a specific Fauna database by name. Returns database metadata including name, reference, creation time, and configured options.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Database name |

### Example

```lua
local db = app.integrations.fauna.fauna_get_database({
  name = "my_database"
})

print(db.name)
print(db.ts)
```

---

## fauna_create_database

Create a new Fauna database. Provide a database name and optional configuration. Requires a server or admin key. Returns the created database metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Database name |
| `data_col` | string | no | Region group for the database (e.g., `"us-east-1"`) |
| `typecheck` | boolean | no | Enable typechecking for the database |

### Example

```lua
local result = app.integrations.fauna.fauna_create_database({
  name = "my_new_database"
})

print("Created database: " .. result.name)
```

---

## fauna_query_fql

Execute a Fauna Query Language (FQL) expression. Provide the query as a JSON-encoded FQL expression. Supports all FQL operations including document reads, writes, indexes, and complex queries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | JSON-encoded FQL query expression |

### Example

```lua
local result = app.integrations.fauna.fauna_query_fql({
  query = '{"paginate": {"match": {"index": "all_users"}}, "size": 10}'
})

for _, item in ipairs(result.data) do
  print(item.id)
end
```

---

## fauna_list_collections

List all collections in the current Fauna database. Returns collection names and their metadata including references and creation time.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.fauna.fauna_list_collections()

for _, coll in ipairs(result.data) do
  print(coll.name)
end
```

---

## fauna_get_collection

Get details of a specific Fauna collection by name. Returns collection metadata including name, reference, creation time, and configured options.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Collection name |

### Example

```lua
local coll = app.integrations.fauna.fauna_get_collection({
  name = "users"
})

print(coll.name)
print(coll.ts)
```

---

## fauna_get_current_user

Get the current authenticated Fauna key identity. Verifies the configured bearer token and returns the associated key identity information.

### Parameters

This tool takes no parameters.

### Example

```lua
local user = app.integrations.fauna.fauna_get_current_user()

print("Identity: " .. tostring(user))
```

---

## Multi-Account Usage

If you have multiple Fauna accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.fauna.function_name({...})

-- Explicit default (portable across setups)
app.integrations.fauna.default.function_name({...})

-- Named accounts
app.integrations.fauna.production.function_name({...})
app.integrations.fauna.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
