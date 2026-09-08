# Client for the IFTTT REST API — Ruby API Reference

## ifttt_list_services

List services in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of services to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.ifttt.list_services(limit: 50, page: 1)
```
## ifttt_get_service

Get detailed information about an IFTTT service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The service ID. |

### Example

```ruby
result = app.integrations.ifttt.get_service(id: "")
```
## ifttt_list_applets

List applets in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of applets to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.ifttt.list_applets(limit: 50, page: 1)
```
## ifttt_get_applet

Get detailed information about an IFTTT applet.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The applet ID. |

### Example

```ruby
result = app.integrations.ifttt.get_applet(id: "")
```
## ifttt_list_connections

List connections in IFTTT with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max number of connections to return. |
| `page` | integer | no | Page number for pagination. |

### Example

```ruby
result = app.integrations.ifttt.list_connections(limit: 50, page: 1)
```
## ifttt_get_connection

Get detailed information about an IFTTT connection.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The connection ID. |

### Example

```ruby
result = app.integrations.ifttt.get_connection(id: "")
```
## ifttt_get_current_user

Get the currently authenticated IFTTT user.

### Example

```ruby
result = app.integrations.ifttt.get_current_user()
```
---

## Multi-Account Usage

If you have multiple ifttt accounts configured, use account-specific namespaces:

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
