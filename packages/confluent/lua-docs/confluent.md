# Confluent Cloud Kafka — Lua API Reference

## list_topics

List Kafka topics in a Confluent cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Example

```lua
local result = app.integrations.confluent.list_topics({})

for _, topic in ipairs(result.data or {}) do
  print(topic.topic_name .. " (partitions: " .. topic.partitions_count .. ")")
end
```

---

## get_topic

Get full details of a specific Kafka topic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_name` | string | yes | The name of the topic to retrieve |
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Example

```lua
local result = app.integrations.confluent.get_topic({
  topic_name = "orders"
})

print("Topic: " .. result.topic_name)
print("Partitions: " .. result.partitions_count)
print("Replication: " .. (result.replication_factor or "default"))
```

---

## create_topic

Create a new Kafka topic in a Confluent cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_name` | string | yes | The name for the new topic |
| `partitions_count` | integer | yes | Number of partitions (e.g., 6) |
| `replication_factor` | integer | no | Replication factor (e.g., 3 for production) |
| `configs` | object | no | JSON-encoded topic configs: retention.ms, cleanup.policy, etc. |
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Topic Config Options

Common configuration options:

```json
{
  "retention.ms": "604800000",
  "cleanup.policy": "delete",
  "max.message.bytes": "1048576"
}
```

### Example

```lua
local result = app.integrations.confluent.create_topic({
  topic_name = "events",
  partitions_count = 6,
  replication_factor = 3,
  configs = '{"retention.ms":"604800000","cleanup.policy":"delete"}'
})

print("Created topic: " .. result.topic_name)
```

---

## list_clusters

List Kafka clusters in your Confluent Cloud environment.

### Parameters

None.

### Example

```lua
local result = app.integrations.confluent.list_clusters({})

for _, cluster in ipairs(result.data or {}) do
  print(cluster.cluster_id .. ": " .. (cluster.display_name or "unnamed"))
end
```

---

## get_cluster

Get details of a specific Kafka cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | no | The cluster ID to retrieve (uses default if not specified) |

### Example

```lua
local result = app.integrations.confluent.get_cluster({
  cluster_id = "lkc-abc123"
})

print("Cluster: " .. (result.display_name or result.cluster_id))
print("Brokers: " .. (result.broker_count or "unknown"))
print("Controller: " .. (result.controller_id or "unknown"))
```

---

## list_environments

List Confluent Cloud environments.

### Parameters

None.

### Example

```lua
local result = app.integrations.confluent.list_environments({})

for _, env in ipairs(result.data or {}) do
  print(env.id .. ": " .. (env.display_name or "unnamed"))
end
```

---

## get_current_user

Get the currently authenticated Confluent Cloud user.

### Parameters

None.

### Example

```lua
local result = app.integrations.confluent.get_current_user({})

print("User: " .. (result.handle or "unknown"))
print("Name: " .. (result.full_name or "unknown"))
print("Email: " .. (result.email or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Confluent accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.confluent.list_topics({})

-- Explicit default (portable across setups)
app.integrations.confluent.default.list_topics({})

-- Named accounts
app.integrations.confluent.production.list_topics({})
app.integrations.confluent.staging.list_topics({})
```

All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Create a topic with production settings

```lua
local result = app.integrations.confluent.create_topic({
  topic_name = "user-events",
  partitions_count = 12,
  replication_factor = 3,
  configs = '{"retention.ms":"259200000","cleanup.policy":"compact,delete"}'
})

print("Created topic: " .. result.topic_name)
```

### List all topics and their partition counts

```lua
local result = app.integrations.confluent.list_topics({})

local topics = result.data or {}
print("Found " .. #topics .. " topics:")

for _, topic in ipairs(topics) do
  print("  - " .. topic.topic_name .. " (" .. topic.partitions_count .. " partitions)")
end
```

### Check cluster health and verify credentials

```lua
-- Verify credentials
local user = app.integrations.confluent.get_current_user({})
print("Connected as: " .. (user.full_name or user.handle))

-- Get cluster details
local cluster = app.integrations.confluent.get_cluster({})
print("Cluster: " .. (cluster.display_name or cluster.cluster_id))
print("Status: " .. (cluster.status or "unknown"))
```
