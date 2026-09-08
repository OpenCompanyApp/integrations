# Kintone — Ruby API Reference

## list_records

Retrieve records from a Kintone app with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `query` | string | no | Kintone query string to filter records |
| `fields` | array | no | List of field codes to include in the response |
| `limit` | integer | no | Maximum number of records to return (max 500, default 100) |
| `offset` | integer | no | Number of records to skip for pagination |

### Query Syntax

Kintone queries use a SQL-like syntax:

```
FieldCode operator "Value" [and|or FieldCode operator "Value"] order by FieldCode [asc|desc] limit N offset N
```

Operators: `=`, `!=`, `>`, `<`, `>=`, `<=`, `in`, `not in`, `like`, `not like`

## Examples

### List all records from an app

```ruby
result = app.integrations.kintone.list_records(app: 1)
result.records.each do |record|
  puts((record.Record_number.value).to_s + ": " + (record.Title.value).to_s)
end
```
### Filter records with a query

```ruby
result = app.integrations.kintone.list_records(app: 1, query: "Status = \"Open\" order by Record_number asc limit 20")
```
### Select specific fields

```ruby
result = app.integrations.kintone.list_records(app: 1, fields: ["Record_number", "Title", "Status"], limit: 50)
```
### Paginate through records

```ruby
result = app.integrations.kintone.list_records(app: 1, limit: 100, offset: 200)
```
---

## get_record

Retrieve a single record by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `id` | integer | yes | The record ID |

### Example

```ruby
result = app.integrations.kintone.get_record(app: 1, id: 42)
puts(result.record.Title.value)
```
---

## create_record

Create a new record in a Kintone app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app` | integer | yes | The app ID |
| `record` | object | yes | Field values keyed by field code |

### Record Format

The `record` parameter is an object where each key is a field code mapping to `{value: ...}`:

```ruby
example = {FieldCode: {value: "some value"}, NumberField: {value: 42}}
```
### Example

```ruby
result = app.integrations.kintone.create_record(app: 1, record: {Title: {value: "New Task"}, Status: {value: "Open"}, Priority: {value: "High"}, DueDate: {value: "2026-04-30"}})
puts("Created record ID: " + (result.id).to_s)
```
---

## list_apps

List available Kintone apps.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of apps to return (default 100, max 500) |
| `offset` | integer | no | Number of apps to skip for pagination |

### Example

```ruby
result = app.integrations.kintone.list_apps(limit: 50)
result.apps.each do |app|
  puts((app.appId).to_s + ": " + (app.name).to_s)
end
```
---

## get_app

Get details of a specific Kintone app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The app ID |

### Example

```ruby
result = app.integrations.kintone.get_app(id: 1)
puts("App: " + (result.name).to_s)
puts("Description: " + (result.description).to_s)
```
---

## list_spaces

List Kintone spaces.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of spaces to return (default 100, max 500) |
| `offset` | integer | no | Number of spaces to skip for pagination |

### Example

```ruby
result = app.integrations.kintone.list_spaces(limit: 50)
result.spaces.each do |space|
  puts((space.id).to_s + ": " + (space.name).to_s)
end
```
---

## get_current_user

Get the profile of the currently authenticated Kintone user.

### Parameters

None.

### Example

```ruby
result = app.integrations.kintone.get_current_user()
puts("Name: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Code: " + (result.code).to_s)
```
---

## Multi-Account Usage

If you have multiple Kintone accounts configured, use account-specific namespaces:

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
