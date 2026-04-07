# Redis Cloud — Lua API Reference

## get_current_account

Get the current Redis Cloud account information, including owner email, payment method, and plan details.

### Parameters

None.

### Examples

```lua
local account = app.integrations["redis-cloud"].get_current_account()

print("Owner: " .. (account.ownerEmail or "unknown"))
print("Plan: " .. (account.planDescription or "N/A"))
```

---

## list_subscriptions

List all subscriptions in the Redis Cloud account. Returns subscription IDs, names, regions, statuses, and database counts.

### Parameters

None.

### Examples

```lua
local result = app.integrations["redis-cloud"].list_subscriptions()

for _, sub in ipairs(result) do
  print("Subscription: " .. (sub.name or sub.id) .. " — " .. (sub.status or "?"))
end
```

---

## get_subscription

Get details for a specific Redis Cloud subscription by ID, including plan, region, memory, throughput, and database list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |

### Examples

```lua
local sub = app.integrations["redis-cloud"].get_subscription({
  subscription_id = 12345
})

print("Name: " .. (sub.name or "N/A"))
print("Region: " .. (sub.region or "N/A"))
print("Databases: " .. #(sub.databases or {}))
```

---

## list_databases

List all databases within a Redis Cloud subscription. Returns database IDs, names, endpoints, and statuses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |

### Examples

```lua
local result = app.integrations["redis-cloud"].list_databases({
  subscription_id = 12345
})

for _, db in ipairs(result) do
  print("Database: " .. (db.name or db.id) .. " — " .. (db.status or "?"))
end
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

```lua
local db = app.integrations["redis-cloud"].get_database({
  subscription_id = 12345,
  database_id = 1
})

print("Name: " .. (db.name or "N/A"))
print("Endpoint: " .. (db.publicEndpoint or "N/A"))
print("Memory: " .. tostring(db.datasetSizeInMb or 0) .. " MB")
```

---

## list_teams

List all teams (ACL roles) in the Redis Cloud account. Returns team IDs, names, and member counts.

### Parameters

None.

### Examples

```lua
local result = app.integrations["redis-cloud"].list_teams()

for _, team in ipairs(result) do
  print("Team: " .. (team.name or team.id))
end
```

---

## get_team

Get details for a specific Redis Cloud team (ACL role) by ID, including roles, permissions, and assigned databases.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | integer | yes | The Redis Cloud team ID. |

### Examples

```lua
local team = app.integrations["redis-cloud"].get_team({
  team_id = 42
})

print("Team: " .. (team.name or "N/A"))
```

---

## Common Workflows

### List all subscriptions and their databases

```lua
-- Step 1: List all subscriptions
local subs = app.integrations["redis-cloud"].list_subscriptions()

-- Step 2: For each subscription, list its databases
for _, sub in ipairs(subs) do
  local databases = app.integrations["redis-cloud"].list_databases({
    subscription_id = sub.subscriptionId
  })

  for _, db in ipairs(databases) do
    print(sub.name .. " / " .. db.name .. " — " .. (db.publicEndpoint or "no endpoint"))
  end
end
```

### Check account info and team access

```lua
-- Get account info
local account = app.integrations["redis-cloud"].get_current_account()
print("Account owner: " .. (account.ownerEmail or "unknown"))

-- List all teams
local teams = app.integrations["redis-cloud"].list_teams()
for _, team in ipairs(teams) do
  print("Team: " .. team.name)
end
```

## Notes

- Authentication uses an API key + secret key pair (HTTP Basic Auth). Generate keys in the Redis Cloud console under **Settings > API Keys**.
- The API base URL is `https://api.redislabs.com/v1`.
- Subscription and database IDs are integers (not UUIDs).
- Some endpoints may return paginated results for large accounts.

---

## Multi-Account Usage

If you have multiple Redis Cloud accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["redis-cloud"].list_subscriptions()

-- Explicit default (portable across setups)
app.integrations["redis-cloud"].default.list_subscriptions()

-- Named accounts
app.integrations["redis-cloud"].production.list_subscriptions()
app.integrations["redis-cloud"].staging.list_subscriptions()
```

All functions are identical across accounts — only the credentials differ.
