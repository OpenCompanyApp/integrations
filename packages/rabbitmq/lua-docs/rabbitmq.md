# RabbitMQ — Lua API Reference

## list_queues

List all RabbitMQ queues across all virtual hosts.

### Parameters

None.

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `queues` | array | List of queue objects |
| `total` | integer | Total number of queues |

Each queue object contains:

| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Queue name |
| `vhost` | string | Virtual host (default: `"/"`) |
| `type` | string | Queue type (`"classic"`, `"quorum"`) |
| `state` | string | Queue state (`"running"`, `"idle"`, etc.) |
| `messages` | integer | Total message count |
| `messages_ready` | integer | Messages available for delivery |
| `messages_unacknowledged` | integer | Messages delivered but not yet acknowledged |
| `consumers` | integer | Number of active consumers |
| `durable` | boolean | Whether the queue survives broker restart |
| `auto_delete` | boolean | Whether the queue is auto-deleted |

### Example

```lua
local result = app.integrations.rabbitmq.list_queues()

for _, q in ipairs(result.queues) do
  print(q.name .. " [" .. q.vhost .. "]: " .. q.messages .. " messages, " .. q.consumers .. " consumers")
end

print("Total queues: " .. result.total)
```

---

## get_queue

Get detailed information about a specific RabbitMQ queue.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `vhost` | string | yes | Virtual host containing the queue (e.g., `"/"`) |
| `name` | string | yes | Queue name |

### Example

```lua
local result = app.integrations.rabbitmq.get_queue({
  vhost = "/",
  name = "order.process"
})

print("Queue: " .. result.name)
print("Messages: " .. result.messages)
print("Consumers: " .. result.consumers)
print("State: " .. result.state)
print("Durable: " .. tostring(result.durable))

-- Check bindings
for _, binding in ipairs(result.bindings or {}) do
  print("  Binding from " .. (binding.source or "direct") .. " with key: " .. (binding.routing_key or ""))
end
```

---

## list_exchanges

List all RabbitMQ exchanges across all virtual hosts.

### Parameters

None.

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `exchanges` | array | List of exchange objects |
| `total` | integer | Total number of exchanges |

Each exchange object contains:

| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Exchange name |
| `vhost` | string | Virtual host |
| `type` | string | Exchange type (`"direct"`, `"fanout"`, `"topic"`, `"headers"`) |
| `durable` | boolean | Whether the exchange survives broker restart |
| `auto_delete` | boolean | Whether the exchange is auto-deleted |
| `internal` | boolean | Whether the exchange is internal (used by RabbitMQ itself) |

### Example

```lua
local result = app.integrations.rabbitmq.list_exchanges()

for _, ex in ipairs(result.exchanges) do
  print(ex.name .. " [" .. ex.type .. "] vhost=" .. ex.vhost)
end

print("Total exchanges: " .. result.total)
```

---

## list_connections

List all active AMQP connections to the RabbitMQ broker.

### Parameters

None.

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `connections` | array | List of connection objects |
| `total` | integer | Total number of connections |

Each connection object contains:

| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Connection name (internal ID) |
| `user` | string | Authenticated username |
| `vhost` | string | Virtual host |
| `state` | string | Connection state (`"running"`, `"idle"`) |
| `channels` | integer | Number of open channels |
| `protocol` | string | Protocol (e.g., `"AMQP 0-9-1"`) |
| `peer_host` | string | Client IP address |
| `peer_port` | integer | Client source port |
| `client_properties` | object | Client-reported properties |

### Example

```lua
local result = app.integrations.rabbitmq.list_connections()

for _, conn in ipairs(result.connections) do
  print(conn.user .. " @ " .. conn.peer_host .. " — " .. conn.channels .. " channels (" .. conn.state .. ")")
end

print("Total connections: " .. result.total)
```

---

## list_vhosts

List all RabbitMQ virtual hosts.

### Parameters

None.

### Response

Returns a table with:

| Field | Type | Description |
|-------|------|-------------|
| `vhosts` | array | List of vhost objects |
| `total` | integer | Total number of virtual hosts |

Each vhost object contains:

| Field | Type | Description |
|-------|------|-------------|
| `name` | string | Virtual host name |
| `tracing` | boolean | Whether tracing is enabled |
| `messages` | integer | Total message count across all queues in the vhost |
| `messages_ready` | integer | Messages ready for delivery |
| `messages_unacknowledged` | integer | Messages delivered but not acknowledged |

### Example

```lua
local result = app.integrations.rabbitmq.list_vhosts()

for _, vhost in ipairs(result.vhosts) do
  print(vhost.name .. ": " .. vhost.messages .. " messages")
end

print("Total vhosts: " .. result.total)
```

---

## get_overview

Get RabbitMQ cluster overview — node info, message rates, queue totals, and listener ports.

### Parameters

None.

### Response

| Field | Type | Description |
|-------|------|-------------|
| `node` | string | Primary node name |
| `cluster_name` | string | Cluster name |
| `rabbitmq_version` | string | RabbitMQ server version |
| `erlang_version` | string | Erlang/OTP version |
| `queue_totals` | object | Aggregate queue message counts |
| `message_stats` | object | Cluster-wide message rate statistics |
| `listeners` | array | Network listener ports and protocols |

### Example

```lua
local result = app.integrations.rabbitmq.get_overview()

print("Node: " .. result.node)
print("Cluster: " .. result.cluster_name)
print("RabbitMQ version: " .. result.rabbitmq_version)
print("Erlang version: " .. result.erlang_version)

-- Queue totals
local qt = result.queue_totals or {}
print("Total messages: " .. (qt.messages or 0))
print("Ready: " .. (qt.messages_ready or 0))
print("Unacknowledged: " .. (qt.messages_unacknowledged or 0))

-- Message rates
local ms = result.message_stats or {}
print("Publish rate: " .. (ms.publish or 0))
print("Deliver rate: " .. (ms.deliver or 0))
print("Ack rate: " .. (ms.ack or 0))

-- Listeners
for _, listener in ipairs(result.listeners or {}) do
  print("Listener: " .. listener.protocol .. " on " .. listener.ip_address .. ":" .. listener.port)
end
```

---

## Multi-Account Usage

If you have multiple RabbitMQ clusters configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.rabbitmq.list_queues()

-- Explicit default (portable across setups)
app.integrations.rabbitmq.default.list_queues()

-- Named accounts
app.integrations.rabbitmq.production.list_queues()
app.integrations.rabbitmq.staging.list_queues()
```

All functions are identical across accounts — only the credentials differ.
