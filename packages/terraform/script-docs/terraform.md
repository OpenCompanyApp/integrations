# Terraform Cloud — Ruby API Reference

## list_workspaces

List workspaces in a Terraform Cloud organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `organization` | string | yes | The organization name to list workspaces for |
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 100 (default: 20) |

### Examples

```ruby
# List workspaces for an organization
result = app.integrations.terraform.list_workspaces(organization: "my-org")
result.data.each do |ws|
  puts((ws.attributes.name).to_s + " — " + (ws.attributes["terraform-version"]).to_s)
end
# Paginate through workspaces
result = app.integrations.terraform.list_workspaces(organization: "my-org", page_number: 2, page_size: 50)
```
---

## get_workspace

Get details of a specific Terraform Cloud workspace by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID (starts with "ws-") |

### Example

```ruby
result = app.integrations.terraform.get_workspace(workspace_id: "ws-abc123xyz456")
ws = result.data.attributes
puts("Workspace: " + (ws.name).to_s)
puts("Terraform version: " + (ws["terraform-version"]).to_s)
puts("Locked: " + ((ws.locked).to_s).to_s)
puts("Working directory: " + ((ws["working-directory"] || "default")).to_s)
```
---

## list_runs

List runs for a Terraform Cloud workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID to list runs for (starts with "ws-") |
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 100 (default: 20) |

### Example

```ruby
result = app.integrations.terraform.list_runs(workspace_id: "ws-abc123xyz456")
result.data.each do |run|
  puts((run.id).to_s + " — status: " + (run.attributes.status).to_s)
end
```
---

## get_run

Get details of a specific Terraform Cloud run by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `runId` | string | yes | The run ID (starts with "run-") |

### Example

```ruby
result = app.integrations.terraform.get_run(run_id: "run-abc123xyz456")
run = result.data.attributes
puts("Status: " + (run.status).to_s)
puts("Trigger: " + (run["trigger-reason"]).to_s)
puts("Created (Unix seconds): " + (run["created-at"]).to_s)
```
---

## list_variables

List variables for a Terraform Cloud workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `workspaceId` | string | yes | The workspace ID to list variables for (starts with "ws-") |

### Example

```ruby
result = app.integrations.terraform.list_variables(workspace_id: "ws-abc123xyz456")
result.data.each do |v|
  attrs = v.attributes
  puts((attrs.key).to_s + " = " + (((attrs.sensitive && "***") || (attrs.value).to_s)).to_s)
  puts("  category: " + (attrs.category).to_s + ", sensitive: " + ((attrs.sensitive).to_s).to_s)
end
```
---

## list_organizations

List Terraform Cloud organizations the authenticated user has access to.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pageNumber` | integer | no | Page number for pagination (default: 1) |
| `pageSize` | integer | no | Number of results per page, max 50 (default: 20) |

### Examples

```ruby
# List organizations
result = app.integrations.terraform.list_organizations()
result.data.each do |org|
  puts((org.attributes.name).to_s + " — " + ((org.attributes["external-id"] || "")).to_s)
end
# Paginate
result = app.integrations.terraform.list_organizations(page_number: 2, page_size: 10)
```
---

## get_current_user

Get the currently authenticated Terraform Cloud user. Useful for verifying authentication.

### Parameters

None.

### Example

```ruby
result = app.integrations.terraform.get_current_user()
puts("Username: " + (result.data.attributes.username).to_s)
puts("Email: " + ((result.data.attributes.email || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Terraform Cloud accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.terraform.list_organizations()
# Explicit default (portable across setups)
app.integrations.terraform.default.list_organizations()
# Named accounts
app.integrations.terraform.production.list_workspaces(organization: "prod-org")
app.integrations.terraform.staging.list_workspaces(organization: "staging-org")
```
All functions are identical across accounts — only the credentials differ.
