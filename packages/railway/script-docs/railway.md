# Railway — Ruby API Reference

Railway tools use the public GraphQL API with a stored account or workspace bearer token. The integration returns normalized project, service, deployment, and user fields instead of raw GraphQL envelopes.

## list_projects

List all Railway projects the authenticated user has access to.

### Parameters

This tool takes no parameters.

### Examples

```ruby
result = app.integrations.railway.list_projects()
result.projects.each do |project|
  puts((project.id).to_s + ": " + (project.name).to_s)
  if project.description
    puts("  Description: " + (project.description).to_s)
  end
  if project.team
    puts("  Team: " + (project.team).to_s)
  end
  puts("  Public: " + ((project.is_public).to_s).to_s)
end
```
---

## get_project

Get detailed information about a specific Railway project, including environments and plugins.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Railway project ID |

### Examples

```ruby
result = app.integrations.railway.get_project(project_id: "clx123abc456")
puts("Project: " + (result.name).to_s)
puts("Description: " + ((result.description || "N/A")).to_s)
puts("Environments: " + (result.environment_count).to_s)
result.environments.each do |env|
  puts("  " + (env.name).to_s + " (ephemeral: " + ((env.is_ephemeral).to_s).to_s + ")")
end
puts("Plugins: " + (result.plugin_count).to_s)
result.plugins.each do |plugin|
  puts("  " + (plugin.name).to_s)
end
```
---

## create_project

Create a new Railway project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new project |
| `description` | string | no | An optional description for the project |

### Examples

```ruby
# Create a project with a name only
result = app.integrations.railway.create_project(name: "My New App")
puts(result.message)
puts("Project ID: " + (result.id).to_s)
# Create a project with a description
result = app.integrations.railway.create_project(name: "My Backend Service", description: "Production backend API deployed on Railway")
puts(result.message)
```
---

## list_services

List all services in a Railway project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Railway project ID |

### Examples

```ruby
result = app.integrations.railway.list_services(project_id: "clx123abc456")
puts("Services: " + (result.count).to_s)
result.services.each do |service|
  puts("  " + (service.id).to_s + ": " + (service.name).to_s)
  if service.repo_name
    puts("    Repo: " + (service.repo_name).to_s)
  end
end
```
---

## get_service

Get detailed information about a specific Railway service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The Railway service ID |

### Examples

```ruby
result = app.integrations.railway.get_service(service_id: "clx789xyz012")
puts("Service: " + (result.name).to_s)
puts("Forked: " + ((result.is_forked).to_s).to_s)
if result.repo.full_name
  puts("Repo: " + (result.repo.full_name).to_s)
  puts("Branch: " + ((result.repo.branch || "default")).to_s)
end
```
---

## list_deployments

List deployments for a Railway service.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `service_id` | string | yes | The Railway service ID |
| `environment_id` | string | no | Filter deployments by environment ID |
| `limit` | integer | no | Max deployments to return (default: 20) |

### Examples

```ruby
# List recent deployments for a service
result = app.integrations.railway.list_deployments(service_id: "clx789xyz012")
result.deployments.each do |dep|
  puts((dep.id).to_s + " [" + (dep.status).to_s + "]")
  puts("  Environment: " + ((dep.environment || "N/A")).to_s)
  puts("  Created: " + (dep.created_at).to_s)
  if dep.creator
    puts("  By: " + (dep.creator).to_s)
  end
end
# Filter by environment
result = app.integrations.railway.list_deployments(service_id: "clx789xyz012", environment_id: "clxenv123", limit: 5)
```
---

## get_current_user

Get the currently authenticated Railway user.

### Parameters

This tool takes no parameters.

### Examples

```ruby
result = app.integrations.railway.get_current_user()
puts("User: " + (result.name).to_s)
puts("Email: " + (result.email).to_s)
puts("Verified: " + ((result.is_verified).to_s).to_s)
```
---

## Multi-Account Usage

If you have multiple Railway accounts configured, use account-specific namespaces:

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
