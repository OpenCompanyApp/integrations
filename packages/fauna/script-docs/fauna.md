# Fauna — Ruby API Reference

All tools are accessed via `app.integrations.fauna.{tool_key}({params})`.

---

## fauna_list_databases

List all databases in the current Fauna context. Returns database names and their metadata including creation time and references.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.fauna.list_databases()
result.data.each do |db|
  puts(db.name)
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

```ruby
db = app.integrations.fauna.get_database(name: "my_database")
puts(db.name)
puts(db.ts)
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

```ruby
result = app.integrations.fauna.create_database(name: "my_new_database")
puts("Created database: " + (result.name).to_s)
```
---

## fauna_query_fql

Execute a Fauna Query Language (FQL) expression. Provide the query as a JSON-encoded FQL expression. Supports all FQL operations including document reads, writes, indexes, and complex queries.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | JSON-encoded FQL query expression |

### Example

```ruby
result = app.integrations.fauna.query_fql(query: "{\"paginate\": {\"match\": {\"index\": \"all_users\"}}, \"size\": 10}")
result.data.each do |item|
  puts(item.id)
end
```
---

## fauna_list_collections

List all collections in the current Fauna database. Returns collection names and their metadata including references and creation time.

### Parameters

This tool takes no parameters.

### Example

```ruby
result = app.integrations.fauna.list_collections()
result.data.each do |coll|
  puts(coll.name)
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

```ruby
coll = app.integrations.fauna.get_collection(name: "users")
puts(coll.name)
puts(coll.ts)
```
---

## fauna_get_current_user

Get the current authenticated Fauna key identity. Verifies the configured bearer token and returns the associated key identity information.

### Parameters

This tool takes no parameters.

### Example

```ruby
user = app.integrations.fauna.get_current_user()
puts("Identity: " + ((user).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple Fauna accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
