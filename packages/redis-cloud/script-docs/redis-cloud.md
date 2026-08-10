# Redis Cloud — JavaScript API Reference

## get_current_account

Get the current Redis Cloud account information, including owner email, payment method, and plan details.

### Parameters

None.

### Examples

```js
var account = app.integrations["redis-cloud"].get_current_account()

console.log("Owner: " + (account.ownerEmail || "unknown"))
console.log("Plan: " + (account.planDescription || "N/A"))
```
---

## list_subscriptions

List all subscriptions in the Redis Cloud account. Returns subscription IDs, names, regions, statuses, and database counts.

### Parameters

None.

### Examples

```js
var result = app.integrations["redis-cloud"].list_subscriptions()

for (const sub of (result)) {
  console.log("Subscription: " + (sub.name || sub.id) + " — " + (sub.status || "?"))
}
```
---

## get_subscription

Get details for a specific Redis Cloud subscription by ID, including plan, region, memory, throughput, and database list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |

### Examples

```js
var sub = app.integrations["redis-cloud"].get_subscription({
  subscription_id: 12345,
})

console.log("Name: " + (sub.name || "N/A"))
console.log("Region: " + (sub.region || "N/A"))
console.log("Databases: " + (sub.databases || {}).length)
```
---

## list_databases

List all databases within a Redis Cloud subscription. Returns database IDs, names, endpoints, and statuses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |

### Examples

```js
var result = app.integrations["redis-cloud"].list_databases({
  subscription_id: 12345,
})

for (const db of (result)) {
  console.log("Database: " + (db.name || db.id) + " — " + (db.status || "?"))
}
```
---

## get_database

Get details for a specific Redis Cloud database by subscription and database ID, including endpoint, memory usage, throughput, and replication status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |
| `database_id` | integer | yes | The database ID within the subscription. |

### Examples

```js
var db = app.integrations["redis-cloud"].get_database({
  subscription_id: 12345,
  database_id: 1,
})

console.log("Name: " + (db.name || "N/A"))
console.log("Endpoint: " + (db.publicEndpoint || "N/A"))
console.log("Memory: " + String(db.datasetSizeInMb || 0) + " MB")
```
---

## list_teams

List all teams (ACL roles) in the Redis Cloud account. Returns team IDs, names, and member counts.

### Parameters

None.

### Examples

```js
var result = app.integrations["redis-cloud"].list_teams()

for (const team of (result)) {
  console.log("Team: " + (team.name || team.id))
}
```
---

## get_team

Get details for a specific Redis Cloud team (ACL role) by ID, including roles, permissions, and assigned databases.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | integer | yes | The Redis Cloud team ID. |

### Examples

```js
var team = app.integrations["redis-cloud"].get_team({
  team_id: 42,
})

console.log("Team: " + (team.name || "N/A"))
```
---

## Common Workflows

### List all subscriptions and their databases

```js
// Step 1: List all subscriptions
var subs = app.integrations["redis-cloud"].list_subscriptions()

// Step 2: For each subscription, list its databases
for (const sub of (subs)) {
  var databases = app.integrations["redis-cloud"].list_databases({
    subscription_id: sub.subscriptionId,
  })

  for (const db of (databases)) {
    console.log(sub.name + " / " + db.name + " — " + (db.publicEndpoint || "no endpoint"))
  }
}
```
### Check account info and team access

```js
// Get account info
var account = app.integrations["redis-cloud"].get_current_account()
console.log("Account owner: " + (account.ownerEmail || "unknown"))

// List all teams
var teams = app.integrations["redis-cloud"].list_teams()
for (const team of (teams)) {
  console.log("Team: " + team.name)
}
```
## Notes

- Authentication uses an API key + secret key pair (HTTP Basic Auth). Generate keys in the Redis Cloud console under **Settings > API Keys**.
- The API base URL is `https://api.redislabs.com/v1`.
- Subscription and database IDs are integers (not UUIDs).
- Some endpoints may return paginated results for large accounts.

---

## Multi-Account Usage

If you have multiple Redis Cloud accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["redis-cloud"].list_subscriptions()

// Explicit default (portable across setups)
app.integrations["redis-cloud"].default.list_subscriptions()

// Named accounts
app.integrations["redis-cloud"].production.list_subscriptions()
app.integrations["redis-cloud"].staging.list_subscriptions()
```
All functions are identical across accounts — only the credentials differ.
