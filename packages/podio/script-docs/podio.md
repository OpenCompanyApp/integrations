# Podio — Ruby API Reference

## list_spaces

List all workspaces (spaces) in a Podio organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `org_id` | integer | yes | The Podio organization ID |

### Example

```ruby
result = app.integrations.podio.list_spaces(org_id: 12345)
result.spaces.each do |space|
  puts((space.name).to_s + " (ID: " + (space.space_id).to_s + ")")
end
```
---

## get_space

Get detailed information about a specific Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```ruby
space = app.integrations.podio.get_space(space_id: 67890)
puts("Space: " + (space.name).to_s)
puts("URL: " + (space.url).to_s)
```
---

## list_apps

List all apps in a Podio workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `space_id` | integer | yes | The Podio space (workspace) ID |

### Example

```ruby
result = app.integrations.podio.list_apps(space_id: 67890)
result.apps.each do |app|
  puts((app.name).to_s + " (" + (app.item_count).to_s + " items)")
end
```
---

## get_app

Get detailed information about a specific Podio app, including field definitions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |

### Example

```ruby
app = app.integrations.podio.get_app(app_id: 11111)
puts("App: " + (app.name).to_s)
app.fields.each do |field|
  puts("  Field: " + (field.external_id).to_s + " (" + (field.type).to_s + ")")
end
```
---

## list_items

List and filter items in a Podio app with sorting and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | integer | yes | The Podio app ID |
| `limit` | integer | no | Max items to return (default: 20, max: 500) |
| `offset` | integer | no | Offset for pagination (default: 0) |
| `sort_by` | string | no | Field to sort by (e.g., `"created_on"`, `"title"`, or a field external ID) |
| `sort_desc` | boolean | no | Sort descending (default: true) |
| `filters` | string | no | JSON-encoded filter object (keys are field external IDs) |

### Example

```ruby
# List recent items
result = app.integrations.podio.list_items(app_id: 11111, limit: 10, sort_by: "created_on", sort_desc: true)
result.items.each do |item|
  puts((item.title).to_s + " (ID: " + (item.item_id).to_s + ")")
end
# Filter items by field value
result = app.integrations.podio.list_items(app_id: 11111, filters: "{\"status\":\"active\"}", limit: 50)
```
---

## get_item

Get detailed information about a specific Podio item, including all field values.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `item_id` | integer | yes | The Podio item ID |

### Example

```ruby
item = app.integrations.podio.get_item(item_id: 22222)
puts("Item: " + (item.title).to_s)
item.fields.each do |field|
  puts("  " + (field.external_id).to_s + ": " + (JSON.generate(field.values)).to_s)
end
```
---

## get_current_user

Get the status of the currently authenticated Podio user.

### Parameters

None.

### Example

```ruby
status = app.integrations.podio.get_current_user()
puts("Logged in as: " + (status.profile.name).to_s)
```
---

## Multi-Account Usage

If you have multiple Podio accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.podio.list_spaces(org_id: 12345)
# Explicit default (portable across setups)
app.integrations.podio.default.list_spaces(org_id: 12345)
# Named accounts
app.integrations.podio.work.list_spaces(org_id: 12345)
app.integrations.podio.personal.list_spaces(org_id: 67890)
```
All functions are identical across accounts — only the credentials differ.
