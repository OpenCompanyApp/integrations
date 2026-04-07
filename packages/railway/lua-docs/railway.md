# Railway — Lua API Reference

## list_projects

List all Railway projects the authenticated user has access to.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.railway.list_projects({})

for _, project in ipairs(result.projects) do
  print(project.id .. ": " .. project.name)
  if project.description then
    print("  Description: " .. project.description)
  end
  if project.team then
    print("  Team: " .. project.team)
  end
  print("  Public: " .. tostring(project.is_public))
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

```lua
local result = app.integrations.railway.get_project({
  project_id = "clx123abc456"
})

print("Project: " .. result.name)
print("Description: " .. (result.description or "N/A"))
print("Environments: " .. result.environment_count)

for _, env in ipairs(result.environments) do
  print("  " .. env.name .. " (ephemeral: " .. tostring(env.is_ephemeral) .. ")")
end

print("Plugins: " .. result.plugin_count)
for _, plugin in ipairs(result.plugins) do
  print("  " .. plugin.name)
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

```lua
-- Create a project with a name only
local result = app.integrations.railway.create_project({
  name = "My New App"
})
print(result.message)
print("Project ID: " .. result.id)

-- Create a project with a description
local result = app.integrations.railway.create_project({
  name = "My Backend Service",
  description = "Production backend API deployed on Railway"
})
print(result.message)
```

---

## list_services

List all services in a Railway project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The Railway project ID |

### Examples

```lua
local result = app.integrations.railway.list_services({
  project_id = "clx123abc456"
})

print("Services: " .. result.count)
for _, service in ipairs(result.services) do
  print("  " .. service.id .. ": " .. service.name)
  if service.repo_name then
    print("    Repo: " .. service.repo_name)
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

```lua
local result = app.integrations.railway.get_service({
  service_id = "clx789xyz012"
})

print("Service: " .. result.name)
print("Forked: " .. tostring(result.is_forked))

if result.repo.full_name then
  print("Repo: " .. result.repo.full_name)
  print("Branch: " .. (result.repo.branch or "default"))
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

```lua
-- List recent deployments for a service
local result = app.integrations.railway.list_deployments({
  service_id = "clx789xyz012"
})

for _, dep in ipairs(result.deployments) do
  print(dep.id .. " [" .. dep.status .. "]")
  print("  Environment: " .. (dep.environment or "N/A"))
  print("  Created: " .. dep.created_at)
  if dep.creator then
    print("  By: " .. dep.creator)
  end
end

-- Filter by environment
local result = app.integrations.railway.list_deployments({
  service_id = "clx789xyz012",
  environment_id = "clxenv123",
  limit = 5
})
```

---

## get_current_user

Get the currently authenticated Railway user.

### Parameters

This tool takes no parameters.

### Examples

```lua
local result = app.integrations.railway.get_current_user({})

print("User: " .. result.name)
print("Email: " .. result.email)
print("Verified: " .. tostring(result.is_verified))
```

---

## Multi-Account Usage

If you have multiple Railway accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.railway.function_name({...})

-- Explicit default (portable across setups)
app.integrations.railway.default.function_name({...})

-- Named accounts
app.integrations.railway.work.function_name({...})
app.integrations.railway.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
