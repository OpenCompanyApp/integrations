# Jenkins — Lua API Reference

## Overview

The Jenkins integration provides access to CI/CD jobs, builds, nodes (agents), and user information. All 7 tools are available under the `app.integrations.jenkins` namespace.

Every tool call accepts a single Lua table with named parameters and returns a Lua table with the API response data.

## Authentication

The Jenkins integration authenticates via a **Bearer token** (API token). The token is sent as an Authorization header on every request.

To create an API token: **Jenkins → User → Configure → API Token**

```lua
-- All calls use the same namespace — no per-call auth needed
local jobs = app.integrations.jenkins.list_jobs({})
```

## Jobs

### `app.integrations.jenkins.list_jobs({})`

List all Jenkins jobs.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local jobs = app.integrations.jenkins.list_jobs({})

for _, job in ipairs(jobs) do
  print(job.name .. " — " .. (job.color or "unknown"))
end
```

### `app.integrations.jenkins.get_job({ job_name })`

Get details for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |

```lua
local job = app.integrations.jenkins.get_job({
  job_name = "my-project-build",
})

print(job.displayName)
print("Description: " .. (job.description or "none"))
print("Last build: " .. (job.lastBuild and job.lastBuild.number or "none"))
print("Health: " .. (job.healthReport and job.healthReport[1] and job.healthReport[1].score or "N/A"))
```

### `app.integrations.jenkins.create_job({ name, mode, description, config })`

Create a new Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name for the new job |
| `mode` | string | no | Job type: `freestyle`, `pipeline`, `maven`, `matrix`, or `multibranch` (default: `freestyle`) |
| `description` | string | no | A description for the job |
| `config` | table | no | Job configuration as a structured object |

```lua
local job = app.integrations.jenkins.create_job({
  name = "my-new-pipeline",
  mode = "pipeline",
  description = "Build and test the main branch",
  config = {
    scm = {
      git = {
        url = "https://github.com/example/repo.git",
        branch = "main",
      },
    },
    triggers = { scm = { cron = "H/5 * * * *" } },
  },
})

print("Created job: " .. job.name)
print("URL: " .. job.url)
```

## Builds

### `app.integrations.jenkins.list_builds({ job_name, status })`

List builds for a specific Jenkins job.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `status` | string | no | Filter by status: `SUCCESS`, `FAILURE`, `UNSTABLE`, `ABORTED`, `IN_PROGRESS` |
| `per_page` | integer | no | Number of builds to return (default: 20) |

```lua
local builds = app.integrations.jenkins.list_builds({
  job_name = "my-project-build",
})

for _, build in ipairs(builds) do
  print("#" .. build.number .. " — " .. build.result .. " (" .. build.duration .. "ms)")
end
```

Filter by failed builds:

```lua
local failures = app.integrations.jenkins.list_builds({
  job_name = "my-project-build",
  status = "FAILURE",
})

print("Failed builds: " .. #failures)
```

### `app.integrations.jenkins.get_build({ job_name, build_number })`

Get details for a specific build.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_name` | string | yes | The name of the Jenkins job |
| `build_number` | integer | yes | The build number |

```lua
local build = app.integrations.jenkins.get_build({
  job_name = "my-project-build",
  build_number = 42,
})

print("Build #" .. build.number)
print("Result: " .. build.result)
print("Duration: " .. build.duration .. "ms")
print("Started: " .. build.timestamp)
print("URL: " .. build.url)

-- Artifacts
if build.artifacts then
  for _, artifact in ipairs(build.artifacts) do
    print("  Artifact: " .. artifact.fileName)
  end
end

-- Change sets
if build.changeSets then
  for _, cs in ipairs(build.changeSets) do
    for _, item in ipairs(cs.items or {}) do
      print("  Commit: " .. item.msg .. " by " .. item.author.fullName)
    end
  end
end
```

## Nodes

### `app.integrations.jenkins.list_nodes({})`

List all Jenkins nodes (agents).

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local nodes = app.integrations.jenkins.list_nodes({})

for _, node in ipairs(nodes) do
  local status = node.offline and "OFFLINE" or "ONLINE"
  print(node.displayName .. " — " .. status .. " (executors: " .. node.numExecutors .. ")")
end
```

## User

### `app.integrations.jenkins.get_current_user({})`

Get the authenticated Jenkins user's profile. Useful to verify credentials and discover the username.

| Name | Type | Required | Description |
|------|------|----------|-------------|
| *(none)* | — | — | Takes no parameters |

```lua
local user = app.integrations.jenkins.get_current_user({})

print("ID: " .. user.id)
print("Name: " .. (user.fullName or "N/A"))
print("Email: " .. (user.property and user.property.email or "N/A"))
```

## Common Workflows

### Check build status and diagnose failures

```lua
local job_name = "my-project-build"

-- 1. Get the job to find the last build number
local job = app.integrations.jenkins.get_job({ job_name = job_name })

if job.lastBuild then
  local build = app.integrations.jenkins.get_build({
    job_name = job_name,
    build_number = job.lastBuild.number,
  })

  print("Last build: #" .. build.number .. " — " .. build.result)

  if build.result == "FAILURE" then
    print("Build failed! Duration: " .. build.duration .. "ms")
    -- Inspect console output or artifacts for debugging
  end
else
  print("No builds found for this job.")
end
```

### Monitor all jobs and report health

```lua
local jobs = app.integrations.jenkins.list_jobs({})

for _, job in ipairs(jobs) do
  local detail = app.integrations.jenkins.get_job({ job_name = job.name })
  local health = detail.healthReport and detail.healthReport[1] or {}

  print(job.name)
  print("  Health: " .. (health.score or "N/A") .. "/100")
  print("  " .. (health.description or "No health report"))

  if detail.lastBuild then
    print("  Last build: #" .. detail.lastBuild.number)
  end
end
```

### Create a pipeline job and verify

```lua
-- 1. Create the job
local job = app.integrations.jenkins.create_job({
  name = "deploy-production",
  mode = "pipeline",
  description = "Deploy to production environment",
})

-- 2. Verify it was created
local detail = app.integrations.jenkins.get_job({ job_name = "deploy-production" })

print("Job created: " .. detail.displayName)
print("Description: " .. (detail.description or ""))
```

### Check node availability

```lua
local nodes = app.integrations.jenkins.list_nodes({})

local offline_count = 0
for _, node in ipairs(nodes) do
  if node.offline then
    offline_count = offline_count + 1
    print("⚠ " .. node.displayName .. " is OFFLINE")
    if node.offlineCauseReason then
      print("  Reason: " .. node.offlineCauseReason)
    end
  end
end

if offline_count == 0 then
  print("All " .. #nodes .. " nodes are online.")
else
  print(offline_count .. " of " .. #nodes .. " nodes are offline.")
end
```

## Notes

- **Bearer auth**: All requests use Bearer token authentication. Generate a token from your Jenkins user profile.
- **Build results**: Common build result values are `SUCCESS`, `FAILURE`, `UNSTABLE`, `ABORTED`, and `null` (still in progress).
- **Job colors**: The `color` field on jobs indicates status — `blue` for success, `red` for failure, `yellow` for unstable, `grey` for never built, and `disabled` for disabled jobs.
- **Rate limiting**: Jenkins may rate-limit aggressive API usage. Use pagination parameters where available.
- **Folder jobs**: If your Jenkins uses folders, job names may include the folder path (e.g. `my-folder/my-job`).

---

## Multi-Account Usage

If you have multiple Jenkins instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.jenkins.function_name({...})

-- Explicit default (portable across setups)
app.integrations.jenkins.default.function_name({...})

-- Named accounts
app.integrations.jenkins.production.function_name({...})
app.integrations.jenkins.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
