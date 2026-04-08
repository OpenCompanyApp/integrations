# Ashby ATS — Lua API Reference

## list_applications

List job applications with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of applications to return (default: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `job_id` | string | no | Filter applications by job ID |
| `status` | string | no | Filter by application status (e.g., "hired", "rejected", "active") |

### Examples

```lua
-- List all applications
local result = app.integrations.ashby.list_applications({})

-- List applications for a specific job
local result = app.integrations.ashby.list_applications({
  job_id = "job_abc123"
})

-- Paginate through applications
local result = app.integrations.ashby.list_applications({
  limit = 50,
  offset = 100
})
```

---

## get_application

Get detailed information about a specific application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The application ID |

### Examples

```lua
local result = app.integrations.ashby.get_application({
  id = "app_xyz789"
})
```

---

## list_jobs

List job postings with optional status filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of jobs to return (default: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `status` | string | no | Filter by job status (e.g., "open", "closed", "draft") |

### Examples

```lua
-- List all jobs
local result = app.integrations.ashby.list_jobs({})

-- List only open positions
local result = app.integrations.ashby.list_jobs({
  status = "open"
})

-- Paginate
local result = app.integrations.ashby.list_jobs({
  limit = 50,
  offset = 50
})
```

---

## get_job

Get detailed information about a specific job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The job ID |

### Examples

```lua
local result = app.integrations.ashby.get_job({
  id = "job_abc123"
})
```

---

## list_interviews

List scheduled interviews with optional application filter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of interviews to return (default: 100) |
| `offset` | integer | no | Number of results to skip for pagination |
| `application_id` | string | no | Filter interviews by application ID |

### Examples

```lua
-- List all interviews
local result = app.integrations.ashby.list_interviews({})

-- List interviews for a specific application
local result = app.integrations.ashby.list_interviews({
  application_id = "app_xyz789"
})
```

---

## get_interview

Get detailed information about a specific interview.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The interview ID |

### Examples

```lua
local result = app.integrations.ashby.get_interview({
  id = "interview_def456"
})
```

---

## get_current_user

Get the profile of the currently authenticated Ashby user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.ashby.get_current_user({})
print(result.email)
```

---

## Multi-Account Usage

If you have multiple Ashby accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ashby.list_jobs({})

-- Explicit default (portable across setups)
app.integrations.ashby.default.list_jobs({})

-- Named accounts
app.integrations.ashby.production.list_jobs({})
app.integrations.ashby.staging.list_jobs({})
```

All functions are identical across accounts — only the credentials differ.
