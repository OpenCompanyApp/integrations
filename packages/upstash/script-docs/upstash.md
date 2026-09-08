# Upstash Redis — Ruby API Reference

## get_key

Retrieve the value stored at a Redis key. Returns null if the key does not exist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to retrieve. |

### Examples

```ruby
result = app.integrations.upstash.get_key(key: "user:1234:session")
if result.value
  puts("Value: " + (result.value).to_s)
else
  puts("Key !found")
end
```
---

## set_key

Store a key-value pair in Redis. Optionally set a TTL (time-to-live) in seconds so the key expires automatically.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to set. |
| `value` | string | yes | The value to store. |
| `ex` | integer | no | Time-to-live in seconds. Key will be deleted automatically after this duration. |

### Examples

```ruby
app.integrations.upstash.set_key(key: "config:theme", value: "dark")
```
```ruby
# With 60-second TTL
app.integrations.upstash.set_key(key: "cache:weather:amsterdam", value: "{\"temp\": 18, \"condition\": \"cloudy\"}", ex: 60)
```
---

## delete_key

Delete a key from Redis. Returns the number of keys that were removed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to delete. |

### Examples

```ruby
result = app.integrations.upstash.delete_key(key: "temp:data")
puts("Deleted: " + ((result.deleted).to_s).to_s)
```
---

## list_keys

List Redis keys matching a glob-style pattern. Defaults to `"*"` to list all keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pattern` | string | no | Glob-style pattern to match keys against. Default: `"*"`. |

### Examples

```ruby
result = app.integrations.upstash.list_keys(pattern: "user:*")
puts("Found " + (result.count).to_s + " keys")
result.keys.each do |key|
  puts("  " + (key).to_s)
end
```
```ruby
# List all keys
result = app.integrations.upstash.list_keys()
puts("Total keys: " + (result.count).to_s)
```
---

## list_databases

List all Redis databases in the Upstash account. Returns database IDs, names, regions, and endpoints.

### Parameters

None.

### Examples

```ruby
databases = app.integrations.upstash.list_databases()
databases.each do |db|
  puts((db.database_name).to_s + " — " + (db.region).to_s + " — " + (db.endpoint).to_s)
end
```
---

## get_database

Get details for a specific Upstash Redis database by ID, including endpoint, region, and usage stats.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Upstash database ID. |

### Examples

```ruby
db = app.integrations.upstash.get_database(id: "abc12345-xxxx-yyyy-zzzz")
puts("Name: " + (db.database_name).to_s)
puts("Region: " + (db.region).to_s)
puts("Endpoint: " + (db.endpoint).to_s)
```
---

## get_current_user

Get current team information from Upstash, including team name, members, and plan details.

### Parameters

None.

### Examples

```ruby
team = app.integrations.upstash.get_current_user()
puts("Team: " + (team.name).to_s)
puts("Plan: " + ((team.plan || "free")).to_s)
```
---

## Multi-Account Usage

If you have multiple upstash accounts configured, use account-specific namespaces:

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
