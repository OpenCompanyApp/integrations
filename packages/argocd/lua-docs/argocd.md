# Argo CD — Lua API Reference

## Overview

The Argo CD integration provides access to GitOps applications, projects, and repositories. All 7 tools are available under the `app.integrations.argocd` namespace.

Every tool call accepts a single Lua table with named parameters and returns a Lua table with the API response data.

## Authentication

The Argo CD integration authenticates via a **Bearer token**. Generate a token from the Argo CD UI (**User Settings → Generate New Token**) or via the CLI:

```bash
argocd account generate-token --account <username>
```

The token is sent as an `Authorization: Bearer <token>` header on every request. You can also configure a custom base URL if your Argo CD instance is hosted elsewhere.

```lua
-- All calls use the same namespace — no per-call auth needed
local apps = app.integrations.argocd.list_applications({})
```

## Applications

### `app.integrations.argocd.list_applications({})`

List all Argo CD applications. Optionally filter by project, label selector, or repository.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project` | string | no | Filter applications by project name |
| `selector` | string | no | Label selector to filter applications (e.g. `"env=production"`) |
| `repo` | string | no | Filter by source repository URL |

```lua
local result = app.integrations.argocd.list_applications({})

for _, app in ipairs(result.items or {}) do
  print(app.metadata.name .. " — " .. (app.status.health.status or "unknown"))
end
```

Filter by project:

```lua
local result = app.integrations.argocd.list_applications({
  project = "default",
})

for _, app in ipairs(result.items or {}) do
  print(app.metadata.name)
end
```

### `app.integrations.argocd.get_application({ name })`

Get details for a specific Argo CD application, including sync status, health, source, and destination.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the application |
| `project` | string | no | The project the application belongs to |
| `refresh` | string | no | Force a refresh (`"true"` or `"hard"`) |

```lua
local app = app.integrations.argocd.get_application({
  name = "my-app",
  refresh = "true",
})

print("Health: " .. app.status.health.status)
print("Sync:   " .. app.status.sync.status)
print("Source: " .. app.spec.source.repoURL)
print("Path:   " .. app.spec.source.path)
```

### `app.integrations.argocd.create_application({ name, project, repo_url, path, dest_namespace })`

Create a new Argo CD application.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Application name |
| `project` | string | yes | Argo CD project name |
| `repo_url` | string | yes | Git repository URL |
| `path` | string | yes | Path within the repository to Kubernetes manifests |
| `revision` | string | no | Git revision (branch, tag, or SHA). Defaults to HEAD |
| `dest_server` | string | no | Destination cluster API URL. Defaults to `https://kubernetes.default.svc` |
| `dest_namespace` | string | yes | Destination Kubernetes namespace |
| `sync_policy` | string | no | `"automated"` for auto-sync, `"manual"` or empty for manual |
| `sync_options` | string | no | Comma-separated sync options (e.g. `"CreateNamespace=true"`) |
| `labels` | object | no | Key-value labels (e.g. `{ env = "production" }`) |
| `description` | string | no | Human-readable description |

```lua
local app = app.integrations.argocd.create_application({
  name = "my-app",
  project = "default",
  repo_url = "https://github.com/my-org/my-manifests.git",
  path = "k8s/overlays/production",
  revision = "main",
  dest_namespace = "production",
  sync_policy = "automated",
  sync_options = "CreateNamespace=true",
  labels = { env = "production", team = "platform" },
  description = "Production deployment for my-app",
})

print("Created: " .. app.metadata.name)
```

## Projects

### `app.integrations.argocd.list_projects({})`

List all Argo CD projects.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local result = app.integrations.argocd.list_projects({})

for _, project in ipairs(result.items or {}) do
  print(project.metadata.name)
end
```

### `app.integrations.argocd.get_project({ name })`

Get details for a specific Argo CD project, including source/destination rules and cluster configurations.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the project |

```lua
local project = app.integrations.argocd.get_project({
  name = "default",
})

print("Project: " .. project.metadata.name)

-- List source repositories
for _, src in ipairs(project.spec.sourceRepos or {}) do
  print("Source repo: " .. src)
end

-- List destinations
for _, dest in ipairs(project.spec.destinations or {}) do
  print("Destination: " .. dest.namespace .. " on " .. dest.server)
end
```

## Repositories

### `app.integrations.argocd.list_repositories({})`

List all configured Git repositories in Argo CD, including connection status.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `repo` | string | no | Filter by repository URL |

```lua
local result = app.integrations.argocd.list_repositories({})

for _, repo in ipairs(result.items or result or {}) do
  print(repo.repo .. " — " .. (repo.connectionState.status or "unknown"))
end
```

Filter by repository URL:

```lua
local result = app.integrations.argocd.list_repositories({
  repo = "https://github.com/my-org",
})
```

## User

### `app.integrations.argocd.get_current_user({})`

Get the authenticated Argo CD user's profile information.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local user = app.integrations.argocd.get_current_user({})

print("Logged in as: " .. (user.username or "unknown"))
```

## Common Workflows

### Check Application Health Across a Project

```lua
local result = app.integrations.argocd.list_applications({
  project = "production",
})

for _, app in ipairs(result.items or {}) do
  local health = app.status.health.status
  local sync = app.status.sync.status

  if health ~= "Healthy" or sync ~= "Synced" then
    print("⚠ " .. app.metadata.name .. " — health: " .. health .. ", sync: " .. sync)
  else
    print("✓ " .. app.metadata.name .. " — OK")
  end
end
```

### Create and Monitor a New Application

```lua
-- 1. Create the application
local app = app.integrations.argocd.create_application({
  name = "new-service",
  project = "default",
  repo_url = "https://github.com/my-org/manifests.git",
  path = "services/new-service",
  dest_namespace = "staging",
  sync_policy = "automated",
})

print("Created application: " .. app.metadata.name)

-- 2. Check its status
local status = app.integrations.argocd.get_application({
  name = "new-service",
  refresh = "true",
})

print("Health: " .. status.status.health.status)
print("Sync:   " .. status.status.sync.status)
```

### Audit Repository Connections

```lua
local repos = app.integrations.argocd.list_repositories({})

for _, repo in ipairs(repos.items or repos or {}) do
  local state = repo.connectionState
  if state and state.status == "Failed" then
    print("❌ " .. repo.repo .. " — connection failed: " .. (state.message or ""))
  else
    print("✓ " .. repo.repo)
  end
end
```
