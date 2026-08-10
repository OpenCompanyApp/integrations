# Upstash Redis — JavaScript API Reference

## get_key

Retrieve the value stored at a Redis key. Returns null if the key does not exist.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to retrieve. |

### Examples

```js
var result = app.integrations.upstash.get_key({
  key: "user:1234:session",
})

if (result.value) {
  console.log("Value: " + result.value)
} else {
  console.log("Key !found")
}
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

```js
app.integrations.upstash.set_key({
  key: "config:theme",
  value: "dark",
})
```
```js
// With 60-second TTL
app.integrations.upstash.set_key({
  key: "cache:weather:amsterdam",
  value: '{"temp": 18, "condition": "cloudy"}',
  ex: 60,
})
```
---

## delete_key

Delete a key from Redis. Returns the number of keys that were removed.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `key` | string | yes | The Redis key to delete. |

### Examples

```js
var result = app.integrations.upstash.delete_key({
  key: "temp:data",
})

console.log("Deleted: " + String(result.deleted))
```
---

## list_keys

List Redis keys matching a glob-style pattern. Defaults to `"*"` to list all keys.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pattern` | string | no | Glob-style pattern to match keys against. Default: `"*"`. |

### Examples

```js
var result = app.integrations.upstash.list_keys({
  pattern: "user:*",
})

console.log("Found " + result.count + " keys")
for (const key of (result.keys)) {
  console.log("  " + key)
}
```
```js
// List all keys
var result = app.integrations.upstash.list_keys()
console.log("Total keys: " + result.count)
```
---

## list_databases

List all Redis databases in the Upstash account. Returns database IDs, names, regions, and endpoints.

### Parameters

None.

### Examples

```js
var databases = app.integrations.upstash.list_databases()

for (const db of (databases)) {
  console.log(db.database_name + " — " + db.region + " — " + db.endpoint)
}
```
---

## get_database

Get details for a specific Upstash Redis database by ID, including endpoint, region, and usage stats.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The Upstash database ID. |

### Examples

```js
var db = app.integrations.upstash.get_database({
  id: "abc12345-xxxx-yyyy-zzzz",
})

console.log("Name: " + db.database_name)
console.log("Region: " + db.region)
console.log("Endpoint: " + db.endpoint)
```
---

## get_current_user

Get current team information from Upstash, including team name, members, and plan details.

### Parameters

None.

### Examples

```js
var team = app.integrations.upstash.get_current_user()

console.log("Team: " + team.name)
console.log("Plan: " + (team.plan || "free"))
```
---

## Multi-Account Usage

If you have multiple upstash accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.upstash.function_name({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations.upstash.default.function_name({ /* parameters */ })

// Named accounts
app.integrations.upstash.production.function_name({ /* parameters */ })
app.integrations.upstash.staging.function_name({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
