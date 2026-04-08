# Close CRM — Lua API Reference

## list_leads

Search and list leads in Close CRM. Supports Close's powerful search syntax for filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | no | Search query using Close syntax (e.g., `"Acme"`, `"status:Potential"`) |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `skip` | integer | no | Records to skip for pagination |

### Search Syntax Examples

- `"Acme"` — search all fields for "Acme"
- `"name:Acme"` — search lead name only
- `"status:Potential"` — filter by status name
- `"name:Acme AND status:Qualified"` — combine conditions
- `"custom.Industry:SaaS"` — filter by custom field
- `"created_at>=2026-01-01"` — date range filter

### Example

```lua
local result = app.integrations.close.list_leads({
  query = "Acme",
  limit = 10
})

for _, lead in ipairs(result.leads) do
  print(lead.id .. ": " .. lead.name)
end
```

---

## get_lead

Get full details for a single lead by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The lead ID (e.g., `"lead_abc123XYZ"`) |

### Example

```lua
local lead = app.integrations.close.get_lead({
  id = "lead_abc123XYZ"
})

print(lead.name)
for _, contact in ipairs(lead.contacts) do
  print("  Contact: " .. contact.display_name)
end
```

---

## create_lead

Create a new lead with optional contacts.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Company or lead name |
| `contacts` | array | no | Array of contact objects |
| `url` | string | no | Company website URL |
| `status_id` | string | no | Status ID to assign |
| `custom` | object | no | Custom field values |

### Contact Object

```lua
{
  name = "John Doe",
  emails = {
    { email = "john@example.com", type = "office" }
  },
  phones = {
    { phone = "+1234567890", type = "office" }
  }
}
```

### Example

```lua
local lead = app.integrations.close.create_lead({
  name = "Acme Corp",
  contacts = {
    {
      name = "Jane Smith",
      emails = {
        { email = "jane@acme.com", type = "office" }
      },
      phones = {
        { phone = "+1234567890", type = "office" }
      }
    }
  },
  url = "https://acme.com"
})

print("Created lead: " .. lead.id)
```

---

## update_lead

Update fields on an existing lead.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The lead ID to update |
| `name` | string | no | New company or lead name |
| `status_id` | string | no | New status ID |
| `url` | string | no | New company website URL |
| `custom` | object | no | Updated custom field values |

### Example

```lua
local lead = app.integrations.close.update_lead({
  id = "lead_abc123XYZ",
  name = "Acme Corp (Updated)",
  custom = { Industry = "SaaS" }
})

print("Updated: " .. lead.name)
```

---

## delete_lead

Permanently delete a lead and all its associated data.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The lead ID to delete |

### Example

```lua
app.integrations.close.delete_lead({
  id = "lead_abc123XYZ"
})
```

---

## list_contacts

List contacts, optionally filtered by lead.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | no | Filter contacts by lead ID |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `skip` | integer | no | Records to skip for pagination |

### Example

```lua
local result = app.integrations.close.list_contacts({
  lead_id = "lead_abc123XYZ",
  limit = 50
})

for _, contact in ipairs(result.contacts) do
  print(contact.display_name)
end
```

---

## list_activities

List activities (emails, calls, notes, etc.) with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `lead_id` | string | no | Filter by lead ID |
| `type` | string | no | Activity type: `"email"`, `"call"`, `"note"`, `"sms"`, `"meeting"` |
| `limit` | integer | no | Max results (default: 25, max: 100) |
| `skip` | integer | no | Records to skip for pagination |

### Example

```lua
local result = app.integrations.close.list_activities({
  lead_id = "lead_abc123XYZ",
  type = "email",
  limit = 10
})

for _, activity in ipairs(result.activities) do
  print(activity.type .. ": " .. (activity.subject or activity.body_preview or ""))
end
```

---

## create_task

Create a new task, optionally linked to a lead.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `text` | string | yes | Task description |
| `lead_id` | string | no | Associate with a lead |
| `assignee_id` | string | no | User ID to assign to |
| `due_date` | string | no | Due date (ISO 8601, e.g., `"2026-04-15"`) |
| `is_complete` | boolean | no | Whether already complete (default: `false`) |

### Example

```lua
local task = app.integrations.close.create_task({
  text = "Follow up with prospect",
  lead_id = "lead_abc123XYZ",
  due_date = "2026-04-15"
})

print("Created task: " .. task.id)
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.close.get_current_user({})

print("Logged in as: " .. user.first_name .. " " .. user.last_name)
print("Email: " .. user.email)

for _, org in ipairs(user.organizations or {}) do
  print("Organization: " .. org.name)
end
```

---

## Multi-Account Usage

If you have multiple Close accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.close.function_name({...})

-- Explicit default (portable across setups)
app.integrations.close.default.function_name({...})

-- Named accounts
app.integrations.close.us_team.function_name({...})
app.integrations.close.eu_team.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
