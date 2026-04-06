# Vercel — Lua API Reference

## list_deployments

List deployments from Vercel. Optionally filter by project or state.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | no | Filter deployments to a specific project |
| `state` | string | no | Filter by state: QUEUED, BUILDING, READY, ERROR, CANCELED |
| `limit` | integer | no | Max results (default: 20, max: 100) |
| `from` | string | no | Pagination cursor from a previous response |

### Examples

```lua
-- List recent deployments
local result = app.integrations.vercel.list_deployments({
  limit = 10
})

for _, deploy in ipairs(result.deployments) do
  print(deploy.id .. " - " .. deploy.state .. " - " .. deploy.url)
end

-- Filter by project
local result = app.integrations.vercel.list_deployments({
  project_id = "my-project-id",
  limit = 5
})

-- Filter by state
local result = app.integrations.vercel.list_deployments({
  state = "ERROR",
  limit = 10
})
```

---

## get_deployment

Get detailed information about a specific deployment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The deployment ID (e.g., `"dpl_xxxxxxxxxxxxxxxxxxxx"`) |

### Examples

```lua
local result = app.integrations.vercel.get_deployment({
  id = "dpl_xxxxxxxxxxxxxxxxxxxx"
})

print("State: " .. result.state)
print("URL: " .. result.url)
print("Framework: " .. (result.framework or "none"))
```

---

## list_projects

List all Vercel projects.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 20, max: 100) |
| `from` | string | no | Pagination cursor from a previous response |

### Examples

```lua
local result = app.integrations.vercel.list_projects({
  limit = 50
})

for _, project in ipairs(result.projects) do
  print(project.id .. " - " .. project.name .. " (" .. (project.framework or "static") .. ")")
end
```

---

## get_project

Get detailed information about a specific Vercel project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The project ID or name |

### Examples

```lua
local result = app.integrations.vercel.get_project({
  id = "my-project-id"
})

print("Name: " .. result.name)
print("Framework: " .. (result.framework or "none"))
print("Link: " .. (result.link.repo or "none"))
```

---

## create_deployment

Create a new deployment on Vercel.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Project name (must match existing Vercel project) |
| `files` | array | no* | Array of file objects with `file` (path) and `content` (base64 or sha+size) |
| `git_source` | object | no* | Git source reference, e.g. `{type="github", ref="main", repoId=12345}` |
| `target` | string | no | `"production"` or `"preview"` (default: `"preview"`) |
| `framework` | string | no | Framework slug (e.g., `"nextjs"`, `"remix"`, `"nuxtjs"`) |
| `regions` | array | no | Region codes, e.g. `{"iad1", "sfo1"}` |
| `project_settings` | object | no | Override project settings (buildCommand, outputDirectory, etc.) |

*Either `files` or `git_source` should be provided.

### Examples

```lua
-- Deploy from Git
local result = app.integrations.vercel.create_deployment({
  name = "my-project",
  target = "production",
  git_source = {
    type = "github",
    ref = "main",
    repoId = 12345
  }
})

print("Deployment ID: " .. result.id)
print("URL: " .. result.url)

-- Deploy with direct files
local result = app.integrations.vercel.create_deployment({
  name = "my-static-site",
  target = "preview",
  files = {
    { file = "index.html", content = "<html><body>Hello</body></html>" }
  }
})
```

---

## list_domains

List all domains configured for a Vercel project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The project ID or name |

### Examples

```lua
local result = app.integrations.vercel.list_domains({
  project_id = "my-project-id"
})

for _, domain in ipairs(result.domains) do
  print(domain.name .. " - verified: " .. tostring(domain.verified))
end
```

---

## get_current_user

Get the profile of the currently authenticated Vercel user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.vercel.get_current_user({})

print("Username: " .. result.user.username)
print("Email: " .. result.user.email)
print("Name: " .. (result.user.name or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Vercel accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vercel.list_deployments({limit = 5})

-- Explicit default (portable across setups)
app.integrations.vercel.default.list_deployments({limit = 5})

-- Named accounts
app.integrations.vercel.work.list_deployments({limit = 5})
app.integrations.vercel.staging.list_deployments({limit = 5})
```

All functions are identical across accounts — only the credentials differ.
