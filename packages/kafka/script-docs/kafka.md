# Apache Kafka (Confluent Cloud) — Ruby API Reference

## list_topics

List Kafka topics in a cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Example

```ruby
result = app.integrations.kafka.list_topics()
(result.data || []).each do |topic|
  puts((topic.topic_name).to_s + " (partitions: " + (topic.partitions_count).to_s + ")")
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

```ruby
result = app.integrations.kafka.get_topic(topic_name: "orders")
puts("Topic: " + (result.topic_name).to_s)
puts("Partitions: " + (result.partitions_count).to_s)
puts("Replication: " + ((result.replication_factor || "default")).to_s)
```
---

## create_topic

Create a new Kafka topic in a cluster.

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

```ruby
result = app.integrations.kafka.create_topic(topic_name: "events", partitions_count: 6, replication_factor: 3, configs: "{\"retention.ms\":\"604800000\",\"cleanup.policy\":\"delete\"}")
puts("Created topic: " + (result.topic_name).to_s)
```
---

## list_clusters

List Kafka clusters in your Confluent Cloud environment.

### Parameters

None.

### Example

```ruby
result = app.integrations.kafka.list_clusters()
(result.data || []).each do |cluster|
  puts((cluster.cluster_id).to_s + ": " + ((cluster.display_name || "unnamed")).to_s)
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

```ruby
result = app.integrations.kafka.get_cluster(cluster_id: "lkc-abc123")
puts("Cluster: " + ((result.display_name || result.cluster_id)).to_s)
puts("Brokers: " + ((result.broker_count || "unknown")).to_s)
puts("Controller: " + ((result.controller_id || "unknown")).to_s)
```
---

## list_producers

List producers for a specific Kafka topic.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `topic_name` | string | yes | The topic name to list producers for |
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Example

```ruby
result = app.integrations.kafka.list_producers(topic_name: "orders")
(result.data || []).each do |producer|
  puts("Producer: " + ((producer.client_id || producer.producer_id)).to_s)
end
```
---

## get_current_user

Get the currently authenticated Confluent Cloud user.

### Parameters

None.

### Example

```ruby
result = app.integrations.kafka.get_current_user()
puts("User: " + ((result.handle || "unknown")).to_s)
puts("Name: " + ((result.full_name || "unknown")).to_s)
puts("Email: " + ((result.email || "unknown")).to_s)
```
---

## Multi-Account Usage

If you have multiple Kafka accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.kafka.list_topics()
# Explicit default (portable across setups)
app.integrations.kafka.default.list_topics()
# Named accounts
app.integrations.kafka.production.list_topics()
app.integrations.kafka.staging.list_topics()
```
All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Create a topic with production settings

```ruby
result = app.integrations.kafka.create_topic(topic_name: "user-events", partitions_count: 12, replication_factor: 3, configs: "{\"retention.ms\":\"259200000\",\"cleanup.policy\":\"compact,delete\"}")
puts("Created topic: " + (result.topic_name).to_s)
```
### List all topics and their partition counts

```ruby
result = app.integrations.kafka.list_topics()
topics = (result.data || {})
puts("Found " + (topics.length).to_s + " topics:")
topics.each do |topic|
  puts("  - " + (topic.topic_name).to_s + " (" + (topic.partitions_count).to_s + " partitions)")
end
```
### Check cluster health and verify credentials

```ruby
# Verify credentials
user = app.integrations.kafka.get_current_user()
puts("Connected as: " + ((user.full_name || user.handle)).to_s)
# Get cluster details
cluster = app.integrations.kafka.get_cluster()
puts("Cluster: " + ((cluster.display_name || cluster.cluster_id)).to_s)
puts("Status: " + ((cluster.status || "unknown")).to_s)
```