# Redis Cloud — Ruby API Reference

## get_current_account

Get the current Redis Cloud account information, including owner email, payment method, and plan details.

### Parameters

None.

### Examples

```ruby
account = app.call("integrations.redis-cloud.get_current_account")
puts("Owner: " + ((account.ownerEmail || "unknown")).to_s)
puts("Plan: " + ((account.planDescription || "N/A")).to_s)
```
---

## list_subscriptions

List all subscriptions in the Redis Cloud account. Returns subscription IDs, names, regions, statuses, and database counts.

### Parameters

None.

### Examples

```ruby
result = app.call("integrations.redis-cloud.list_subscriptions")
result.each do |sub|
  puts("Subscription: " + ((sub.name || sub.id)).to_s + " — " + ((sub.status || "?")).to_s)
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

```ruby
sub = app.call("integrations.redis-cloud.get_subscription", subscription_id: 12345)
puts("Name: " + ((sub.name || "N/A")).to_s)
puts("Region: " + ((sub.region || "N/A")).to_s)
puts("Databases: " + ((sub.databases || {}).length).to_s)
```
---

## list_databases

List all databases within a Redis Cloud subscription. Returns database IDs, names, endpoints, and statuses.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | integer | yes | The Redis Cloud subscription ID. |

### Examples

```ruby
result = app.call("integrations.redis-cloud.list_databases", subscription_id: 12345)
result.each do |db|
  puts("Database: " + ((db.name || db.id)).to_s + " — " + ((db.status || "?")).to_s)
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

```ruby
db = app.call("integrations.redis-cloud.get_database", subscription_id: 12345, database_id: 1)
puts("Name: " + ((db.name || "N/A")).to_s)
puts("Endpoint: " + ((db.publicEndpoint || "N/A")).to_s)
puts("Memory: " + (((db.datasetSizeInMb || 0)).to_s).to_s + " MB")
```
---

## list_teams

List all teams (ACL roles) in the Redis Cloud account. Returns team IDs, names, and member counts.

### Parameters

None.

### Examples

```ruby
result = app.call("integrations.redis-cloud.list_teams")
result.each do |team|
  puts("Team: " + ((team.name || team.id)).to_s)
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

```ruby
team = app.call("integrations.redis-cloud.get_team", team_id: 42)
puts("Team: " + ((team.name || "N/A")).to_s)
```
---

## Common Workflows

### List all subscriptions and their databases

```ruby
# Step 1: List all subscriptions
subs = app.call("integrations.redis-cloud.list_subscriptions")
# Step 2: For each subscription, list its databases
subs.each do |sub|
  databases = app.call("integrations.redis-cloud.list_databases", subscription_id: sub.subscriptionId)
  databases.each do |db|
    puts((sub.name).to_s + " / " + (db.name).to_s + " — " + ((db.publicEndpoint || "no endpoint")).to_s)
  end
end
```
### Check account info and team access

```ruby
# Get account info
account = app.call("integrations.redis-cloud.get_current_account")
puts("Account owner: " + ((account.ownerEmail || "unknown")).to_s)
# List all teams
teams = app.call("integrations.redis-cloud.list_teams")
teams.each do |team|
  puts("Team: " + (team.name).to_s)
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

```ruby
# Default account (always works)
app.call("integrations.redis-cloud.list_subscriptions")
# Explicit default (portable across setups)
app.call("integrations.redis-cloud.default.list_subscriptions")
# Named accounts
app.call("integrations.redis-cloud.production.list_subscriptions")
app.call("integrations.redis-cloud.staging.list_subscriptions")
```
All functions are identical across accounts — only the credentials differ.
