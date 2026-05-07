# MongoDB Atlas Data API Lua Reference

Namespace: `mongodb`

This integration targets the deprecated MongoDB Atlas Data API v1 compatibility surface. It covers the official document action endpoints: find, findOne, insertOne, insertMany, updateOne, updateMany, deleteOne, deleteMany, and aggregate.

The configured endpoint URL must end in `/endpoint/data/v1`. The package adds `dataSource` from integration credentials, defaulting to `mongodb-atlas`.

## Tools

### `mongodb.find`

Query documents in a collection.

```lua
local result = app.integrations.mongodb.find({
  database = "app",
  collection = "customers",
  filter = { status = "active" },
  projection = { email = 1, status = 1, _id = 0 },
  sort = { createdAt = -1 },
  limit = 25
})
```

Returns the Data API response, usually `{ documents = { ... } }`.

### `mongodb.find_one`

Return the first document matching a filter.

```lua
local result = app.integrations.mongodb.find_one({
  database = "app",
  collection = "customers",
  filter = { email = "person@example.test" }
})
```

### `mongodb.insert_one`

Insert one document.

```lua
local result = app.integrations.mongodb.insert_one({
  database = "app",
  collection = "customers",
  document = { email = "person@example.test", status = "active" }
})
```

Returns the Data API inserted id response.

### `mongodb.insert_many`

Insert multiple documents.

```lua
local result = app.integrations.mongodb.insert_many({
  database = "app",
  collection = "events",
  documents = {
    { type = "signup", user = "user-1" },
    { type = "login", user = "user-1" }
  }
})
```

### `mongodb.update_one`

Update one matching document.

```lua
local result = app.integrations.mongodb.update_one({
  database = "app",
  collection = "customers",
  filter = { email = "person@example.test" },
  update = { ["$set"] = { status = "paused" } }
})
```

### `mongodb.update_many`

Update every matching document. Use a precise filter for broad writes.

```lua
local result = app.integrations.mongodb.update_many({
  database = "app",
  collection = "customers",
  filter = { status = "trial" },
  update = { ["$set"] = { status = "active" } }
})
```

### `mongodb.delete_one`

Delete one matching document.

```lua
local result = app.integrations.mongodb.delete_one({
  database = "app",
  collection = "customers",
  filter = { email = "person@example.test" }
})
```

### `mongodb.delete_many`

Delete every matching document. An empty filter can delete an entire collection, so agents should require explicit user intent before using it.

```lua
local result = app.integrations.mongodb.delete_many({
  database = "app",
  collection = "sessions",
  filter = { expired = true }
})
```

### `mongodb.aggregate`

Run a MongoDB aggregation pipeline.

```lua
local result = app.integrations.mongodb.aggregate({
  database = "app",
  collection = "events",
  pipeline = {
    { ["$match"] = { type = "signup" } },
    { ["$group"] = { _id = "$campaign", count = { ["$sum"] = 1 } } }
  }
})
```

Returns the Data API aggregation response, usually `{ documents = { ... } }`.

## Notes

MongoDB marks the Atlas Data API v1 as deprecated. New integrations that need Atlas project administration should use MongoDB's Atlas Administration API instead; it has different authentication and is not covered by this package.
