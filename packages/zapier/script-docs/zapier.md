# Client for the Zapier REST API — Ruby API Reference

## zapier_list_zaps

List zaps in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of zaps to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.zapier.list(limit: 50, page: 1)
```
## zapier_get_zap

Get detailed information about a Zapier zap.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The zap ID. |

### Example

```ruby
result = app.integrations.zapier.get(id: "")
```
## zapier_list_executions

List zap executions in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `zap_id` | string | no | Filter executions by zap ID. |
| `limit` | integer | no | Max number of executions to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.zapier.list_executions(zap_id: "", limit: 50, page: 1)
```
## zapier_get_execution

Get detailed information about a Zapier execution.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The execution ID. |

### Example

```ruby
result = app.integrations.zapier.get_execution(id: "")
```
## zapier_list_connections

List connections in Zapier with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of connections to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.zapier.list_connections(limit: 50, page: 1)
```
## zapier_get_connection

Get detailed information about a Zapier connection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The connection ID. |

### Example

```ruby
result = app.integrations.zapier.get_connection(id: "")
```
## zapier_get_current_user

Get the currently authenticated Zapier user.

### Example

```ruby
result = app.integrations.zapier.get_current_user()
```
---

## Multi-Account Usage

If you have multiple zapier accounts configured, use account-specific namespaces:

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
