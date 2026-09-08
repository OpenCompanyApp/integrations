# Paperspace — Ruby API Reference

## list_machines

List all GPU machines in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.list_machines()
result.each do |machine|
  puts((machine.name).to_s + " (" + (machine.state).to_s + ") - " + (machine.machineType).to_s)
end
```
---

## get_machine

Get details for a specific machine.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `machine_id` | string | yes | The machine ID |

### Example

```ruby
result = app.integrations.paperspace.get_machine(machine_id: "psabc123")
m = result
puts((m.name).to_s + " - " + (m.os).to_s + " - " + (m.publicIp).to_s)
```
---

## list_notebooks

List all Gradient notebooks in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.list_notebooks()
result.each do |notebook|
  puts((notebook.name).to_s + " (" + (notebook.state).to_s + ")")
end
```
---

## list_datasets

List all datasets in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.list_datasets()
result.each do |dataset|
  puts((dataset.name).to_s + " - " + ((dataset.size || "unknown size")).to_s)
end
```
---

## list_projects

List all Gradient projects in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.list_projects()
result.each do |project|
  puts((project.name).to_s + " - " + ((project.description || "no description")).to_s)
end
```
---

## list_ssh_keys

List all SSH keys in the account.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.list_ssh_keys()
result.each do |key|
  puts((key.name).to_s + " - " + (key.fingerprint).to_s)
end
```
---

## get_current_user

Get the current authenticated user information.

### Parameters

None.

### Example

```ruby
result = app.integrations.paperspace.get_current_user()
puts("User: " + (result.email).to_s + " (ID: " + (result.id).to_s + ")")
```
---

## Multi-Account Usage

If you have multiple Paperspace accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.paperspace.list_machines()
# Explicit default (portable across setups)
app.integrations.paperspace.default.list_machines()
# Named accounts
app.integrations.paperspace.production.list_machines()
app.integrations.paperspace.staging.list_machines()
```
All functions are identical across accounts — only the credentials differ.
