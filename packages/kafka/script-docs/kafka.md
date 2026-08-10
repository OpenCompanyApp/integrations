# Apache Kafka (Confluent Cloud) — JavaScript API Reference

## list_topics

List Kafka topics in a cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | no | Override the default Kafka cluster ID |

### Example

```js
var result = app.integrations.kafka.list_topics({})

for (const topic of (result.data || [])) {
  console.log(topic.topic_name + " (partitions: " + topic.partitions_count + ")")
}
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

```js
var result = app.integrations.kafka.get_topic({
  topic_name: "orders",
})

console.log("Topic: " + result.topic_name)
console.log("Partitions: " + result.partitions_count)
console.log("Replication: " + (result.replication_factor || "default"))
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

```js
var result = app.integrations.kafka.create_topic({
  topic_name: "events",
  partitions_count: 6,
  replication_factor: 3,
  configs: '{"retention.ms":"604800000","cleanup.policy":"delete"}',
})

console.log("Created topic: " + result.topic_name)
```
---

## list_clusters

List Kafka clusters in your Confluent Cloud environment.

### Parameters

None.

### Example

```js
var result = app.integrations.kafka.list_clusters({})

for (const cluster of (result.data || [])) {
  console.log(cluster.cluster_id + ": " + (cluster.display_name || "unnamed"))
}
```
---

## get_cluster

Get details of a specific Kafka cluster.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `cluster_id` | string | no | The cluster ID to retrieve (uses default if not specified) |

### Example

```js
var result = app.integrations.kafka.get_cluster({
  cluster_id: "lkc-abc123",
})

console.log("Cluster: " + (result.display_name || result.cluster_id))
console.log("Brokers: " + (result.broker_count || "unknown"))
console.log("Controller: " + (result.controller_id || "unknown"))
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

```js
var result = app.integrations.kafka.list_producers({
  topic_name: "orders",
})

for (const producer of (result.data || [])) {
  console.log("Producer: " + (producer.client_id || producer.producer_id))
}
```
---

## get_current_user

Get the currently authenticated Confluent Cloud user.

### Parameters

None.

### Example

```js
var result = app.integrations.kafka.get_current_user({})

console.log("User: " + (result.handle || "unknown"))
console.log("Name: " + (result.full_name || "unknown"))
console.log("Email: " + (result.email || "unknown"))
```
---

## Multi-Account Usage

If you have multiple Kafka accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations.kafka.list_topics({})

// Explicit default (portable across setups)
app.integrations.kafka.default.list_topics({})

// Named accounts
app.integrations.kafka.production.list_topics({})
app.integrations.kafka.staging.list_topics({})
```
All functions are identical across accounts — only the credentials differ.

---

## Common Patterns

### Create a topic with production settings

```js
var result = app.integrations.kafka.create_topic({
  topic_name: "user-events",
  partitions_count: 12,
  replication_factor: 3,
  configs: '{"retention.ms":"259200000","cleanup.policy":"compact,delete"}',
})

console.log("Created topic: " + result.topic_name)
```
### List all topics and their partition counts

```js
var result = app.integrations.kafka.list_topics({})

var topics = result.data || {}
console.log("Found " + topics.length + " topics:")

for (const topic of (topics)) {
  console.log("  - " + topic.topic_name + " (" + topic.partitions_count + " partitions)")
}
```
### Check cluster health and verify credentials

```js
// Verify credentials
var user = app.integrations.kafka.get_current_user({})
console.log("Connected as: " + (user.full_name || user.handle))

// Get cluster details
var cluster = app.integrations.kafka.get_cluster({})
console.log("Cluster: " + (cluster.display_name || cluster.cluster_id))
console.log("Status: " + (cluster.status || "unknown"))
```