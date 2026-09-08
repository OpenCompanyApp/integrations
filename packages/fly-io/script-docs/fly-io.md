# Fly.io — Ruby API Reference

## list_apps

List all Fly.io apps in the organization.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.fly-io.list_apps")
result.each do |app|
  puts((app.name).to_s + " - " + (app.status).to_s + " (" + (app.organization).to_s + ")")
end
```
---

## get_app

Get details for a specific Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```ruby
result = app.call("integrations.fly-io.get_app", app_name: "my-app")
puts((result.name).to_s + " - " + (result.status).to_s)
```
---

## create_app

Create a new Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The desired name for the new app |
| `org_slug` | string | no | The organization slug (uses default org if omitted) |

### Example

```ruby
result = app.call("integrations.fly-io.create_app", app_name: "my-new-app", org_slug: "personal")
puts("Created app: " + (result.name).to_s)
```
---

## list_machines

List all machines for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```ruby
result = app.call("integrations.fly-io.list_machines", app_name: "my-app")
result.each do |machine|
  puts((machine.id).to_s + " - " + (machine.state).to_s + " - " + (machine.region).to_s)
end
```
---

## get_machine

Get details for a specific Fly.io machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |
| `machine_id` | string | yes | The machine ID |

### Example

```ruby
result = app.call("integrations.fly-io.get_machine", app_name: "my-app", machine_id: "73d8d46dbee589")
puts((result.id).to_s + " - state: " + (result.state).to_s + " - region: " + (result.region).to_s)
```
---

## list_volumes

List all persistent volumes for a Fly.io app.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_name` | string | yes | The name of the Fly.io app |

### Example

```ruby
result = app.call("integrations.fly-io.list_volumes", app_name: "my-app")
result.each do |vol|
  puts((vol.id).to_s + " - " + (vol.name).to_s + " - " + (vol.size_gb).to_s + "GB - " + (vol.region).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Fly.io accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.fly-io.list_apps")
# Explicit default (portable across setups)
app.call("integrations.fly-io.default.list_apps")
# Named accounts
app.call("integrations.fly-io.production.list_apps")
app.call("integrations.fly-io.staging.list_apps")
```
All functions are identical across accounts — only the credentials differ.
