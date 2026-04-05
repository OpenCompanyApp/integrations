# Workable — Lua API Reference

## list_jobs

List jobs in your Workable account, optionally filtered by state.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `state` | string | no | Filter by state: `"published"`, `"draft"`, `"archived"`, `"closed"` |
| `limit` | integer | no | Max results (default: 50) |

### Example

```lua
local result = app.integrations.workable.list_jobs({
  state = "published",
  limit = 20
})

for _, job in ipairs(result.jobs) do
  print(job.title .. " (" .. job.shortcode .. ") - " .. job.location.city)
end
```

---

## get_job

Get full details for a specific job by its shortcode.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | Job shortcode, e.g. `"GRO-001"` |

### Example

```lua
local result = app.integrations.workable.get_job({
  shortcode = "GRO-001"
})

print(result.title)
print(result.description)
print(result.employment_type)
print(result.url)
```

---

## list_candidates

List candidates for a specific job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | Job shortcode, e.g. `"GRO-001"` |
| `limit` | integer | no | Max results (default: 50) |

### Example

```lua
local result = app.integrations.workable.list_candidates({
  shortcode = "GRO-001"
})

for _, candidate in ipairs(result.candidates) do
  print(candidate.name .. " <" .. candidate.email .. "> — stage: " .. candidate.stage)
end
```

---

## get_candidate

Get full details for a specific candidate by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Candidate ID |

### Example

```lua
local result = app.integrations.workable.get_candidate({
  id = "abc123"
})

print(result.name)
print(result.email)
print(result.stage)
```

---

## create_candidate

Create a new candidate for a specific job.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `shortcode` | string | yes | Job shortcode to apply candidate to |
| `name` | string | yes | Candidate's full name |
| `email` | string | yes | Candidate's email address |
| `phone` | string | no | Phone number |
| `headline` | string | no | Brief headline or title |
| `cover_letter` | string | no | Cover letter text |

### Example

```lua
local result = app.integrations.workable.create_candidate({
  shortcode = "GRO-001",
  name = "Jane Smith",
  email = "jane@example.com",
  phone = "+1-555-0123",
  cover_letter = "I am very interested in this position."
})

print("Created candidate: " .. result.id)
```

---

## list_members

List team members in your Workable account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 50) |

### Example

```lua
local result = app.integrations.workable.list_members({
  limit = 20
})

for _, member in ipairs(result.members) do
  print(member.name .. " — " .. member.role)
end
```

---

## get_current_user

Get the currently authenticated user's profile. Useful for verifying the connection.

### Parameters

None.

### Example

```lua
local result = app.integrations.workable.get_current_user({})

print("Connected as: " .. result.name .. " (" .. result.email .. ")")
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
app.integrations.workable.acme.list_jobs({})
app.integrations.workable.startup_co.list_jobs({})
```

All functions are identical across accounts — only the credentials differ.
