# MongoDB Atlas — Lua API Reference

## find

Query documents from a MongoDB Atlas collection with optional filtering, projection, sorting, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `filter` | object | no | MongoDB query filter (e.g., `{status = "active"}`) |
| `projection` | object | no | Fields to include/exclude (e.g., `{name = 1, _id = 0}`) |
| `sort` | object | no | Sort specification (e.g., `{createdAt = -1}`) |
| `limit` | integer | no | Maximum number of documents to return |
| `skip` | integer | no | Number of documents to skip (for pagination) |

### Filter Syntax

Filters use standard MongoDB query operators:

```lua
-- Exact match
{status = "active"}

-- Comparison operators
{age = {["$gt"] = 18}}
{price = {["$lte"] = 100}}

-- Logical operators
{["$or"] = {{status = "active"}, {status = "pending"}}}

-- Element operators
{tags = {["$exists"] = true}}
```

### Examples

#### Find all documents

```lua
local result = app.integrations.mongodb.find({
  database = "myapp",
  collection = "users"
})

for _, doc in ipairs(result.documents) do
  print(doc.name)
end
```

#### Find with filter and sort

```lua
local result = app.integrations.mongodb.find({
  database = "myapp",
  collection = "users",
  filter = {status = "active"},
  sort = {createdAt = -1},
  limit = 10
})
```

#### Find with projection

```lua
local result = app.integrations.mongodb.find({
  database = "myapp",
  collection = "users",
  filter = {role = "admin"},
  projection = {name = 1, email = 1, _id = 0}
})
```

---

## find_one

Find a single document in a MongoDB Atlas collection. Returns the first matching document.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `filter` | object | no | MongoDB query filter |
| `projection` | object | no | Fields to include/exclude |

### Example

```lua
local result = app.integrations.mongodb.find_one({
  database = "myapp",
  collection = "users",
  filter = {email = "alice@example.com"}
})

if result.document then
  print("Found: " .. result.document.name)
end
```

---

## insert_one

Insert a single document into a MongoDB Atlas collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `document` | object | yes | The document to insert |

### Example

```lua
local result = app.integrations.mongodb.insert_one({
  database = "myapp",
  collection = "users",
  document = {
    name = "Alice",
    email = "alice@example.com",
    age = 30,
    status = "active"
  }
})

print("Inserted ID: " .. result.insertedId)
```

---

## insert_many

Insert multiple documents into a MongoDB Atlas collection in a single operation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `documents` | array | yes | Array of documents to insert |

### Example

```lua
local result = app.integrations.mongodb.insert_many({
  database = "myapp",
  collection = "users",
  documents = {
    {name = "Alice", email = "alice@example.com"},
    {name = "Bob", email = "bob@example.com"},
    {name = "Charlie", email = "charlie@example.com"}
  }
})

print("Inserted " .. #result.insertedIds .. " documents")
```

---

## update_one

Update a single document in a MongoDB Atlas collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `filter` | object | yes | MongoDB query filter to match the document |
| `update` | object | yes | Update operations using operators |

### Update Operators

| Operator | Description | Example |
|----------|-------------|---------|
| `$set` | Set field values | `{["$set"] = {status = "active"}}` |
| `$inc` | Increment a numeric field | `{["$inc"] = {count = 1}}` |
| `$push` | Append to an array | `{["$push"] = {tags = "new"}}` |
| `$pull` | Remove from an array | `{["$pull"] = {tags = "old"}}` |
| `$unset` | Remove a field | `{["$unset"] = {tempField = ""}}` |

### Example

```lua
local result = app.integrations.mongodb.update_one({
  database = "myapp",
  collection = "users",
  filter = {email = "alice@example.com"},
  update = {
    ["$set"] = {status = "inactive", updatedAt = "2026-04-05"},
    ["$inc"] = {loginCount = 1}
  }
})

print("Matched: " .. result.matchedCount .. ", Modified: " .. result.modifiedCount)
```

---

## delete_one

Delete a single document from a MongoDB Atlas collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `filter` | object | yes | MongoDB query filter to match the document |

### Example

```lua
local result = app.integrations.mongodb.delete_one({
  database = "myapp",
  collection = "users",
  filter = {email = "alice@example.com"}
})

print("Deleted: " .. result.deletedCount)
```

---

## aggregate

Run an aggregation pipeline on a MongoDB Atlas collection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |
| `collection` | string | yes | The collection name |
| `pipeline` | array | yes | Array of pipeline stages |

### Common Pipeline Stages

| Stage | Description |
|-------|-------------|
| `$match` | Filter documents |
| `$group` | Group and aggregate |
| `$sort` | Sort documents |
| `$limit` | Limit number of results |
| `$skip` | Skip documents |
| `$project` | Reshape documents |
| `$lookup` | Join with another collection |
| `$unwind` | Deconstruct arrays |
| `$count` | Count documents |

### Examples

#### Group by category and count

```lua
local result = app.integrations.mongodb.aggregate({
  database = "myapp",
  collection = "orders",
  pipeline = {
    {["$match"] = {status = "completed"}},
    {["$group"] = {["_id"] = "$category", count = {["$sum"] = 1}, revenue = {["$sum"] = "$amount"}}},
    {["$sort"] = {revenue = -1}},
    {["$limit"] = 10}
  }
})

for _, doc in ipairs(result.documents) do
  print(doc._id .. ": " .. doc.count .. " orders, $" .. doc.revenue)
end
```

#### Lookup (join) example

```lua
local result = app.integrations.mongodb.aggregate({
  database = "myapp",
  collection = "orders",
  pipeline = {
    {["$lookup"] = {
      from = "users",
      localField = "userId",
      foreignField = "_id",
      as = "user"
    }},
    {["$unwind"] = "$user"},
    {["$project"] = {orderTotal = 1, userName = "$user.name"}}
  }
})
```

---

## list_collections

List all collections in a MongoDB Atlas database.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `database` | string | yes | The database name |

### Example

```lua
local result = app.integrations.mongodb.list_collections({
  database = "myapp"
})

for _, coll in ipairs(result.collections) do
  print(coll.name)
end
```

---

## get_current_user

Verify connectivity to MongoDB Atlas and get session information. Useful for testing credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.mongodb.get_current_user({})

if result then
  print("Connected to MongoDB Atlas successfully")
end
```

---

## Multi-Account Usage

If you have multiple MongoDB Atlas accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mongodb.find({...})

-- Explicit default (portable across setups)
app.integrations.mongodb.default.find({...})

-- Named accounts
app.integrations.mongodb.production.find({...})
app.integrations.mongodb.staging.find({...})
```

All functions are identical across accounts — only the credentials differ.
