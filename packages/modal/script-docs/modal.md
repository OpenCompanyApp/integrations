# Modal — Ruby API Reference

Modal is a serverless GPU platform for running AI and compute workloads in the cloud. This integration lets you list apps, get app details, browse functions and schedules, and manage volumes and secrets — all from Ruby programs.

## Authentication

Uses a **Modal API Key** (Bearer token). Configure it in your integration settings. The key authenticates via the Modal REST API at `https://api.modal.com/v1`. API keys are scoped to the user or workspace that created them — the integration can only access resources within that scope.

---

## Overview

All tools are called via `app.integrations.modal.<tool_name>({ ... })`. Every function takes a single Ruby object of named parameters and returns a result table.

```ruby
result = app.integrations.modal.get_app(app_id: "ap-abc123")
```
Errors surface as `result.error` (string). Check for it before using the response.

```ruby
if result.error
  puts("Error: " + (result.error).to_s)
  nil
end
```
---

## list_apps

List all Modal apps in the workspace. Returns app IDs, names, and status details.

### Parameters

None.

### Example

```ruby
result = app.integrations.modal.list_apps()
if result.error
  puts("Error: " + (result.error).to_s)
else
  result.each do |app|
    puts((app.name).to_s + " - " + (app.status).to_s + " (" + (app.app_id).to_s + ")")
  end
end
```
---

## get_app

Get details for a specific Modal app by ID, including status and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app. |

### Example

```ruby
result = app.integrations.modal.get_app(app_id: "ap-abc123")
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts((result.name).to_s + " - " + (result.status).to_s)
end
```
---

## list_functions

List all functions for a Modal app. Returns function IDs, names, and runtime details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list functions for. |

### Example

```ruby
result = app.integrations.modal.list_functions(app_id: "ap-abc123")
if result.error
  puts("Error: " + (result.error).to_s)
else
  result.each do |fn|
    puts((fn.name).to_s + " - " + ((fn.runtime || "unknown")).to_s)
  end
end
```
---

## list_schedules

List all scheduled functions for a Modal app. Returns schedule IDs, cron expressions, and associated function details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `app_id` | string | yes | The ID of the Modal app to list schedules for. |

### Example

```ruby
result = app.integrations.modal.list_schedules(app_id: "ap-abc123")
if result.error
  puts("Error: " + (result.error).to_s)
else
  result.each do |sched|
    puts((sched.function_name).to_s + " - cron: " + ((sched.cron || "N/A")).to_s)
  end
end
```
---

## list_volumes

List all Modal volumes. Returns volume IDs, names, and size details.

### Parameters

None.

### Example

```ruby
result = app.integrations.modal.list_volumes()
if result.error
  puts("Error: " + (result.error).to_s)
else
  result.each do |vol|
    puts((vol.name).to_s + " - " + ((vol.size_gb || "?")).to_s + " GB")
  end
end
```
---

## list_secrets

List all Modal secrets. Returns secret names and creation dates. Secret values are never exposed.

### Parameters

None.

### Example

```ruby
result = app.integrations.modal.list_secrets()
if result.error
  puts("Error: " + (result.error).to_s)
else
  result.each do |secret|
    puts((secret.name).to_s + " - created: " + ((secret.created_at || "unknown")).to_s)
  end
end
```
---

## get_current_user

Get the current authenticated Modal user information, including name, email, and account details.

### Parameters

None.

### Example

```ruby
result = app.integrations.modal.get_current_user()
if result.error
  puts("Error: " + (result.error).to_s)
else
  puts("User: " + (((result.name || result.email) || "unknown")).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Modal accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.modal.list_apps()
# Explicit default (portable across setups)
app.integrations.modal.default.list_apps()
# Named accounts
app.integrations.modal.production.list_apps()
app.integrations.modal.staging.list_apps()
```
All functions are identical across accounts — only the credentials differ.
