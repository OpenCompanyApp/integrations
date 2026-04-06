# CircleCI — Lua API Reference

## list_pipelines

List recent CI/CD pipelines for an organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `orgSlug` | string | yes | Organization slug (e.g., `"gh/my-org"`) |
| `branch` | string | no | Filter by branch name |
| `limit` | integer | no | Max results (default: 20) |
| `page_token` | string | no | Pagination token from previous response |

### Examples

```lua
local result = app.integrations.circleci.list_pipelines({
  orgSlug = "gh/my-org",
  limit = 10
})

for _, pipeline in ipairs(result.items) do
  print(pipeline.id .. " - " .. pipeline.status .. " (" .. pipeline.branch .. ")")
end
```

Filter by branch:

```lua
local result = app.integrations.circleci.list_pipelines({
  orgSlug = "gh/my-org",
  branch = "main",
  limit = 5
})
```

---

## get_pipeline

Get detailed information about a specific pipeline.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Pipeline UUID |

### Example

```lua
local result = app.integrations.circleci.get_pipeline({
  id = "abc123-def456-..."
})

print("Status: " .. result.state)
print("Branch: " .. result.branch)
print("Revision: " .. result.vcs.revision)
```

---

## list_workflows

List all workflows for a pipeline.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pipeline_id` | string | yes | Pipeline UUID |

### Example

```lua
local result = app.integrations.circleci.list_workflows({
  pipeline_id = "abc123-def456-..."
})

for _, wf in ipairs(result.items) do
  print(wf.name .. " - " .. wf.status)
end
```

---

## get_workflow

Get detailed information about a specific workflow.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Workflow UUID |

### Example

```lua
local result = app.integrations.circleci.get_workflow({
  id = "wf123-def456-..."
})

print("Name: " .. result.name)
print("Status: " .. result.status)
print("Duration: " .. result.duration .. "s")
```

---

## list_projects

List all projects for an organization.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `orgSlug` | string | yes | Organization slug (e.g., `"gh/my-org"`) |
| `limit` | integer | no | Max results |

### Example

```lua
local result = app.integrations.circleci.list_projects({
  orgSlug = "gh/my-org"
})

for _, project in ipairs(result.items) do
  print(project.slug .. " - " .. project.vcs_url)
end
```

---

## trigger_pipeline

Trigger a new pipeline on a project.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `orgSlug` | string | yes | Organization slug (e.g., `"gh/my-org"`) |
| `projectSlug` | string | yes | Project slug / repo name (e.g., `"my-repo"`) |
| `branch` | string | no | Branch to run on (default: project default) |
| `parameters` | object | no | Pipeline parameters (for parameterized configs) |

### Examples

Trigger on default branch:

```lua
local result = app.integrations.circleci.trigger_pipeline({
  orgSlug = "gh/my-org",
  projectSlug = "my-repo"
})

print("Pipeline: " .. result.id .. " - " .. result.state)
```

Trigger on specific branch with parameters:

```lua
local result = app.integrations.circleci.trigger_pipeline({
  orgSlug = "gh/my-org",
  projectSlug = "my-repo",
  branch = "feature/login",
  parameters = {
    run_integration_tests = true,
    environment = "staging"
  }
})
```

---

## get_current_user

Get the authenticated user profile.

### Parameters

None.

### Example

```lua
local result = app.integrations.circleci.get_current_user({})

print("Logged in as: " .. result.login)
print("Name: " .. result.name)
```

---

## Multi-Account Usage

If you have multiple CircleCI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.circleci.list_pipelines({ orgSlug = "gh/my-org" })

-- Explicit default (portable across setups)
app.integrations.circleci.default.list_pipelines({ orgSlug = "gh/my-org" })

-- Named accounts
app.integrations.circleci.work.list_pipelines({ orgSlug = "gh/work-org" })
app.integrations.circleci.personal.list_pipelines({ orgSlug = "gh/personal-org" })
```

All functions are identical across accounts — only the credentials differ.
