# RabbitMQ - Ruby API Reference

Namespace: `app.integrations.rabbitmq`

This integration wraps the RabbitMQ Management HTTP API. It uses HTTP Basic authentication and the configured Management plugin base URL, usually `http://host:15672`. Virtual host names are encoded by the integration, so pass `/` as the default vhost rather than `%2F`.

The API can mutate broker state. Tools named `delete_*`, `purge_queue`, `get_messages`, `publish_message`, `declare_*`, `create_*`, `set_permissions`, and `import_definitions` should only be used when that operational effect is intended.

## Cluster And Health

```ruby
overview = app.integrations.rabbitmq.get_overview()
nodes = app.integrations.rabbitmq.list_nodes()
node = app.integrations.rabbitmq.get_node(name: "rabbit@node1")
health = app.integrations.rabbitmq.health_check(check: "alarms")
listener = app.integrations.rabbitmq.health_check(check: "port-listener", params: {port: 5672})
alive = app.integrations.rabbitmq.aliveness_test(vhost: "/")
```
Health check names are RabbitMQ endpoint names such as `alarms`, `local-alarms`, `virtual-hosts`, `port-listener`, `protocol-listener`, `certificate-expiration`, `node-is-mirror-sync-critical`, and `node-is-quorum-critical`.

## Queues

```ruby
all = app.integrations.rabbitmq.list_queues()
vhost_queues = app.integrations.rabbitmq.list_queues(vhost: "/", params: {disable_stats: true, enable_queue_totals: true})
queue = app.integrations.rabbitmq.get_queue(vhost: "/", name: "orders.ready")
app.integrations.rabbitmq.declare_queue(vhost: "/", name: "orders.ready", definition: {durable: true, auto_delete: false, arguments: {"x-queue-type" => "quorum"}})
bindings = app.integrations.rabbitmq.get_queue_bindings(vhost: "/", name: "orders.ready")
```
Destructive or state-changing queue tools:

```ruby
app.integrations.rabbitmq.get_messages(vhost: "/", name: "orders.ready", options: {count: 5, ackmode: "ack_requeue_true", encoding: "auto", truncate: 50000})
app.integrations.rabbitmq.purge_queue(vhost: "/", name: "orders.ready")
app.integrations.rabbitmq.delete_queue(vhost: "/", name: "orders.ready", if_empty: true, if_unused: true)
```
`get_messages` defaults to `ack_requeue_true` so messages are requeued unless the caller explicitly changes `ackmode`.

## Exchanges And Bindings

```ruby
exchanges = app.integrations.rabbitmq.list_exchanges(vhost: "/")
exchange = app.integrations.rabbitmq.get_exchange(vhost: "/", name: "orders.events")
app.integrations.rabbitmq.declare_exchange(vhost: "/", name: "orders.events", definition: {type: "topic", durable: true, auto_delete: false, arguments: {}})
routed = app.integrations.rabbitmq.publish_message(vhost: "/", exchange: "orders.events", message: {properties: {}, routing_key: "order.created", payload: "{\"id\":\"ord_123\"}", payload_encoding: "string"})
```
Binding tools:

- `list_bindings({ vhost = "/" })`
- `list_exchange_source_bindings({ vhost = "/", name = "orders.events" })`
- `list_exchange_destination_bindings({ vhost = "/", name = "orders.archive" })`
- `create_binding({ vhost = "/", source = "orders.events", destination_type = "queue", destination = "orders.ready", routing_key = "order.*", arguments = {} })`
- `delete_binding({ vhost = "/", source = "orders.events", destination_type = "queue", destination = "orders.ready", properties_key = "order.*" })`
- `delete_exchange({ vhost = "/", name = "orders.events", if_unused = true })`

RabbitMQ uses destination type `queue` or `exchange`; the integration maps those to the HTTP API path segments `q` and `e`.

## Connections, Channels, And Consumers

```ruby
connections = app.integrations.rabbitmq.list_connections()
connection = app.integrations.rabbitmq.get_connection(name: "127.0.0.1:50000 -> 127.0.0.1:5672")
channels = app.integrations.rabbitmq.list_channels()
channel = app.integrations.rabbitmq.get_channel(name: "127.0.0.1:50000 -> 127.0.0.1:5672 (1)")
consumers = app.integrations.rabbitmq.list_consumers(vhost: "/")
```
`close_connection({ name = "...", reason = "maintenance" })` force-closes an AMQP connection.

## Virtual Hosts, Users, Permissions, And Policies

```ruby
vhosts = app.integrations.rabbitmq.list_vhosts()
vhost = app.integrations.rabbitmq.get_vhost(name: "/")
app.integrations.rabbitmq.create_vhost(name: "events", metadata: {description: "Event bus", tags: "production", default_queue_type: "quorum"})
users = app.integrations.rabbitmq.list_users()
user = app.integrations.rabbitmq.get_user(name: "agent-monitor")
permissions = app.integrations.rabbitmq.list_permissions()
vhost_permissions = app.integrations.rabbitmq.list_vhost_permissions(vhost: "/")
policies = app.integrations.rabbitmq.list_policies(vhost: "/")
```
Permission mutation tools:

```ruby
app.integrations.rabbitmq.set_permissions(vhost: "/", user: "agent-monitor", configure: "^$", write: "^$", read: ".*")
app.integrations.rabbitmq.delete_permissions(vhost: "/", user: "agent-monitor")
```
`delete_vhost({ name = "events" })` removes a virtual host when the broker permits deletion.

## Definitions

```ruby
definitions = app.integrations.rabbitmq.export_definitions()
app.integrations.rabbitmq.import_definitions(definitions: definitions)
```
Definitions can include users, vhosts, permissions, policies, queues, exchanges, and bindings. Treat imports as broker configuration changes.

## Multi-Account Usage

```ruby
app.integrations.rabbitmq.list_queues()
app.integrations.rabbitmq.default.list_queues()
app.integrations.rabbitmq.production.list_queues()
```
Named account namespaces use the same tools with different stored credentials.
