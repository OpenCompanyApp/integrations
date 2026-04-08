# Workable — Lua API Reference

## list_jobs

List jobs from your Workable account with optional state filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by job state: `"published"`, `"draft"`, `"closed"`, or `"archived"`. Omit to list all jobs. |
| `limit` | integer | no | Number of results per page (default: 50, max: 100). |
| `offset` | integer | no | Offset for pagination — pass the value from a previous response to get the next page. |

### Examples

```lua
-- List all published jobs
local result = app.integrations.workable.list_jobs({
  state = "published"
})

for _, job in ipairs(result.jobs) do
  print(job.title .. " (" .. job.shortcode .. ")")
end

-- Paginate through all jobs
local offset = 0
repeat
  local page = app.integrations.workable.list_jobs({
    limit = 50,
    offset = offset
  })
  for _, job in ipairs(page.jobs or {}) do
    print(job.title .. " - " .. job.state)
  end
  offset = offset + 50
until #page.jobs < 50
```

---

## get_job

Get full details for a specific Workable job by its shortcode.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | The job shortcode identifier (e.g., `"GROVF002"`). |

### Examples

```lua
local result = app.integrations.workable.get_job({
  shortcode = "GROVF002"
})

print(result.title)
print(result.department)
print(result.employment_type)
print(result.location.city .. ", " .. result.location.country)
```

---

## create_job

Create a new job posting in Workable.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | Job title (e.g., `"Senior Backend Engineer"`). |
| `description` | string | yes | Full job description in HTML or plain text. |
| `department` | string | no | Department name (e.g., `"Engineering"`). |
| `employment_type` | string | no | Employment type: `"full-time"`, `"part-time"`, `"contract"`, `"temporary"`, `"intern"`. |

### Examples

```lua
local result = app.integrations.workable.create_job({
  title = "Senior Backend Engineer",
  description = "<p>We are looking for an experienced backend engineer...</p>",
  department = "Engineering",
  employment_type = "full-time"
})

print("Created job: " .. result.shortcode)
```

---

## list_candidates

List candidates for a specific Workable job, with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | The job shortcode to list candidates for (e.g., `"GROVF002"`). |
| `limit` | integer | no | Number of results per page (default: 50, max: 100). |
| `offset` | integer | no | Offset for pagination — pass the value from a previous response to get the next page. |

### Examples

```lua
-- List candidates for a job
local result = app.integrations.workable.list_candidates({
  shortcode = "GROVF002"
})

for _, candidate in ipairs(result.candidates or {}) do
  print(candidate.name .. " - Stage: " .. candidate.stage)
end

-- Paginate through all candidates
local offset = 0
repeat
  local page = app.integrations.workable.list_candidates({
    shortcode = "GROVF002",
    limit = 50,
    offset = offset
  })
  for _, candidate in ipairs(page.candidates or {}) do
    print(candidate.name .. " <" .. candidate.email .. ">")
  end
  offset = offset + 50
until #(page.candidates or {}) < 50
```

---

## get_candidate

Get full details for a specific Workable candidate by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The candidate ID (e.g., `"abc123def456"`). |

### Examples

```lua
local result = app.integrations.workable.get_candidate({
  id = "abc123def456"
})

print(result.name)
print(result.email)
print(result.stage)
print("Applied: " .. result.applied_at)
print("Phone: " .. (result.phone or "N/A"))
```

---

## list_members

List all team members in your Workable account.

### Parameters

This function takes no parameters.

### Examples

```lua
local result = app.integrations.workable.list_members()

for _, member in ipairs(result.members or {}) do
  print(member.name .. " - " .. member.email .. " (" .. (member.role or "member") .. ")")
end
```

---

## get_current_user

Get the profile of the currently authenticated Workable user.

### Parameters

This function takes no parameters.

### Examples

```lua
local result = app.integrations.workable.get_current_user()

print("Logged in as: " .. result.name)
print("Email: " .. result.email)
print("Role: " .. (result.role or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Workable accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.workable.list_jobs({})

-- Explicit default (portable across setups)
app.integrations.workable.default.list_jobs({})

-- Named accounts
app.integrations.workable.us_office.list_jobs({})
app.integrations.workable.eu_office.list_jobs({})
```

All functions are identical across accounts — only the credentials differ.
