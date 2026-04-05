# Ashby — Lua API Reference

## list_jobs

List job postings from Ashby.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `status` | string | no | Filter by status: `"open"`, `"closed"`, `"draft"`, `"archived"` |
| `department_id` | string | no | Filter by department ID |
| `limit` | integer | no | Max results per page (default: 50, max: 200) |
| `offset` | integer | no | Number of results to skip for pagination |

### Example

```lua
local result = app.integrations.ashby.list_jobs({
  status = "open",
  limit = 20
})

for _, job in ipairs(result.results) do
  print(job.title .. " — " .. job.status)
end
```

---

## get_job

Get detailed information about a specific job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_id` | string | yes | The Ashby job ID |

### Example

```lua
local result = app.integrations.ashby.get_job({
  job_id = "job_abc123"
})

print(result.results.title)
print(result.results.description)
```

---

## list_applications

List job applications with filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_id` | string | no | Filter by job ID |
| `candidate_id` | string | no | Filter by candidate ID |
| `status` | string | no | Filter by status: `"active"`, `"hired"`, `"rejected"`, `"withdrawn"` |
| `stage` | string | no | Filter by current stage name |
| `limit` | integer | no | Max results per page (default: 50, max: 200) |
| `offset` | integer | no | Number of results to skip for pagination |

### Example

```lua
local result = app.integrations.ashby.list_applications({
  job_id = "job_abc123",
  status = "active",
  limit = 20
})

for _, app in ipairs(result.results) do
  print(app.candidate.name .. " → " .. app.currentStage)
end
```

---

## get_application

Get detailed information about a specific application.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `application_id` | string | yes | The Ashby application ID |

### Example

```lua
local result = app.integrations.ashby.get_application({
  application_id = "app_xyz789"
})

print(result.results.candidate.name)
print(result.results.currentStage)
```

---

## list_candidates

List candidates with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | no | Filter by name (partial match) |
| `email` | string | no | Filter by email address |
| `tags` | array | no | Filter by tags |
| `limit` | integer | no | Max results per page (default: 50, max: 200) |
| `offset` | integer | no | Number of results to skip for pagination |

### Example

```lua
local result = app.integrations.ashby.list_candidates({
  name = "Jane",
  limit = 10
})

for _, c in ipairs(result.results) do
  print(c.name .. " <" .. c.email .. ">")
end
```

---

## create_note

Create a note attached to a candidate, application, or job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject_id` | string | yes | ID of the entity to attach the note to |
| `subject_type` | string | yes | Entity type: `"candidate"`, `"application"`, or `"job"` |
| `content` | string | yes | Note content (plain text) |
| `visibility` | string | no | `"team"` (default) or `"private"` |

### Example

```lua
local result = app.integrations.ashby.create_note({
  subject_id = "cand_abc123",
  subject_type = "candidate",
  content = "Had a great phone screen. Moving to onsite.",
  visibility = "team"
})
```

---

## list_interviews

List scheduled interviews.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `job_id` | string | no | Filter by job ID |
| `application_id` | string | no | Filter by application ID |
| `interviewer_id` | string | no | Filter by interviewer user ID |
| `status` | string | no | Filter by status: `"scheduled"`, `"completed"`, `"cancelled"`, `"needs_scheduling"` |
| `limit` | integer | no | Max results per page (default: 50, max: 200) |
| `offset` | integer | no | Number of results to skip for pagination |

### Example

```lua
local result = app.integrations.ashby.list_interviews({
  status = "scheduled",
  limit = 20
})

for _, iv in ipairs(result.results) do
  print(iv.candidate.name .. " — " .. iv.scheduledAt)
end
```

---

## get_current_user

Get information about the authenticated Ashby user.

### Parameters

None.

### Example

```lua
local result = app.integrations.ashby.get_current_user({})

print(result.results.name)
print(result.results.email)
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
