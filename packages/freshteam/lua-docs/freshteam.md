# Freshteam — Lua API Reference

## list_candidates

List recruitment candidates with optional status filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"active"`, `"hired"`, `"rejected"`, `"on_hold"`) |

### Example

```lua
local result = app.integrations.freshteam.list_candidates({
  page = 1,
  per_page = 10,
  status = "active"
})

for _, candidate in ipairs(result) do
  print(candidate.first_name .. " " .. candidate.last_name .. " - " .. candidate.email)
end
```

---

## get_candidate

Retrieve details for a specific candidate.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The candidate ID |

### Example

```lua
local candidate = app.integrations.freshteam.get_candidate({ id = 12345 })
print(candidate.first_name .. " " .. candidate.last_name)
print("Email: " .. candidate.email)
print("Status: " .. candidate.status)
```

---

## list_job_postings

List job postings with optional filtering by status and department.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `status` | string | no | Filter by status (e.g., `"published"`, `"draft"`, `"closed"`) |
| `department_id` | integer | no | Filter by department ID |

### Example

```lua
local result = app.integrations.freshteam.list_job_postings({
  page = 1,
  per_page = 10,
  status = "published"
})

for _, job in ipairs(result) do
  print(job.title .. " (" .. job.status .. ")")
end
```

---

## get_job_posting

Retrieve details for a specific job posting.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The job posting ID |

### Example

```lua
local job = app.integrations.freshteam.get_job_posting({ id = 67890 })
print(job.title)
print("Department: " .. (job.department and job.department.name or "N/A"))
print("Location: " .. (job.location or "Remote"))
```

---

## list_employees

List employees with optional department filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 20) |
| `department_id` | integer | no | Filter by department ID |

### Example

```lua
local result = app.integrations.freshteam.list_employees({
  page = 1,
  per_page = 50
})

for _, emp in ipairs(result) do
  print(emp.first_name .. " " .. emp.last_name .. " - " .. (emp.email or ""))
end
```

---

## get_employee

Retrieve details for a specific employee.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The employee ID |

### Example

```lua
local emp = app.integrations.freshteam.get_employee({ id = 54321 })
print(emp.first_name .. " " .. emp.last_name)
print("Email: " .. emp.email)
print("Department: " .. (emp.department and emp.department.name or "N/A"))
```

---

## get_current_user

Retrieve the currently authenticated user's profile. Useful for verifying the connection.

### Parameters

None.

### Example

```lua
local user = app.integrations.freshteam.get_current_user({})
print("Logged in as: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Freshteam accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshteam.list_candidates({})

-- Explicit default (portable across setups)
app.integrations.freshteam.default.list_candidates({})

-- Named accounts
app.integrations.freshteam.acme.list_candidates({})
app.integrations.freshteam.other_company.list_employees({})
```

All functions are identical across accounts — only the credentials differ.
