# Make.com — Ruby API Reference

Make.com is a visual automation platform that connects apps and services through scenarios. This integration lets you list and inspect scenarios, monitor executions, view connections, and manage teams — all from Ruby programs.

## Authentication

Uses an **API Token** configured in your integration settings. Generate a token at [https://www.make.com/en/user/api](https://www.make.com/en/user/api). The token authenticates via the Make.com REST API at `https://api.make.com/v1` using Bearer authentication. The token is scoped to the user who created it — the integration can only access organizations and resources that user has permission for.

---

## Overview

All tools are called via `app.integrations.make_com.<tool_name>({ ... })`. Every function takes a single Ruby object of named parameters and returns a result table.

```ruby
result = app.call("integrations.make-com.get_scenario", id: "12345")
```
Errors surface as `result.error` (string). Check for it before using the response.

```ruby
if result.error
  puts("Error: " + (result.error).to_s)
  nil
end
```
---

## Scenarios

### `app.integrations.make_com.list_scenarios(...)`

List Make.com scenarios the authenticated user has access to. Supports filtering by organization, team, or folder.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization_id` | string | no | Filter by organization ID. |
| `team_id` | string | no | Filter by team ID. |
| `folder_id` | string | no | Filter by folder ID. |
| `limit` | integer | no | Number of results per page. Default: 20. |
| `offset` | integer | no | Offset for pagination. |

Returns: `scenarios` (array), `total` (integer).

```ruby
# List all scenarios
result = app.call("integrations.make-com.list_scenarios")
# List scenarios in a specific team
result = app.call("integrations.make-com.list_scenarios", team_id: "team_abc", limit: 10)
```
---

### `app.integrations.make_com.get_scenario(...)`

Get detailed information about a Make.com scenario by ID, including its blueprint, scheduling, and status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Scenario ID. |

Returns: Full scenario object with blueprint, scheduling, and metadata.

```ruby
result = app.call("integrations.make-com.get_scenario", id: "12345")
puts("Scenario: " + (result.name).to_s)
puts("Status: " + ((result.isScheduling || "inactive")).to_s)
```
---

## Executions

### `app.integrations.make_com.list_executions(...)`

List Make.com scenario executions (runs) with optional filters. Useful for monitoring scenario health and debugging failed runs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `scenario_id` | string | no | Filter by scenario ID. |
| `status` | string | no | Filter by status (`"success"`, `"error"`, `"warning"`). |
| `limit` | integer | no | Number of results per page. Default: 20. |
| `offset` | integer | no | Offset for pagination. |

Returns: `executions` (array), `total` (integer).

```ruby
# List recent executions for a scenario
result = app.call("integrations.make-com.list_executions", scenario_id: "12345", limit: 5)
# List failed executions
result = app.call("integrations.make-com.list_executions", status: "error", limit: 10)
```
---

### `app.integrations.make_com.get_execution(...)`

Get detailed information about a Make.com scenario execution (run) by ID, including status, duration, input/output for each module, and any errors.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Execution (run) ID. |

Returns: Full execution object with module-level details.

```ruby
result = app.call("integrations.make-com.get_execution", id: "run_67890")
if (result.status == "error")
  puts("Execution failed at step: " + ((result.failedModule || "unknown")).to_s)
end
```
---

## Connections

### `app.integrations.make_com.list_connections(...)`

List Make.com connections the authenticated user has access to. Supports filtering by team.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `team_id` | string | no | Filter by team ID. |
| `limit` | integer | no | Number of results per page. Default: 20. |
| `offset` | integer | no | Offset for pagination. |

Returns: `connections` (array), `total` (integer).

```ruby
result = app.call("integrations.make-com.list_connections", team_id: "team_abc")
result.connections.each do |conn|
  puts("Connection: " + (conn.name).to_s + " (" + (conn.service).to_s + ")")
end
```
---

## Teams

### `app.integrations.make_com.list_teams(...)`

List Make.com teams (organizations) the authenticated user has access to. Use this to discover team IDs needed for filtering scenarios and connections.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of results per page. Default: 20. |
| `offset` | integer | no | Offset for pagination. |

Returns: `teams` (array), `total` (integer).

```ruby
result = app.call("integrations.make-com.list_teams")
result.teams.each do |team|
  puts("Team: " + (team.name).to_s + " (ID: " + (team.id).to_s + ")")
end
```
---

## User

### `app.integrations.make_com.get_current_user(...)`

Get the currently authenticated Make.com user's profile, including ID, name, email, and team memberships.

Takes no parameters.

Returns: User object with `id`, `name`, `email`, and other profile fields.

```ruby
result = app.call("integrations.make-com.get_current_user")
puts("Logged in as: " + (result.name).to_s + " <" + (result.email).to_s + ">")
```
---

## Error Handling

All tools return errors consistently. Always check for `result.error`:

```ruby
result = app.call("integrations.make-com.get_scenario", id: "invalid")
if result.error
  puts("API Error: " + (result.error).to_s)
  # Handle error: log, notify, retry, etc.
  nil
end
# Safe to use result
puts("Scenario name: " + (result.name).to_s)
```
Common error scenarios:
- **Not configured**: The Make.com API token is missing or invalid.
- **Not found**: The requested resource (scenario, execution) does not exist.
- **Permission denied**: The token does not have access to the requested organization or resource.
- **Rate limited**: Too many requests; wait and retry.
