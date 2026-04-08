# Capsule CRM — Lua API Reference

## list_contacts

List contacts (people and organisations) from Capsule CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of contacts per page, max 100 (default: 50) |

### Examples

```lua
-- List first page of contacts
local result = app.integrations.capsule.list_contacts({})

-- List second page with 25 results
local result = app.integrations.capsule.list_contacts({
  page = 2,
  per_page = 25
})

for _, contact in ipairs(result.parties) do
  print(contact.id .. ": " .. (contact.firstName or "") .. " " .. (contact.lastName or ""))
end
```

---

## get_contact

Retrieve a single contact (person or organisation) by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact (party) ID |

### Examples

```lua
local result = app.integrations.capsule.get_contact({ id = 12345 })
local party = result.party

print(party.firstName .. " " .. party.lastName)
print("Type: " .. party.type)
```

---

## create_contact

Create a new person or organisation in Capsule CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `type` | string | no | Contact type: "person" (default) or "organisation" |
| `firstName` | string | yes | First name of the contact |
| `lastName` | string | yes | Last name of the contact |
| `emailAddresses` | array | no | Email addresses, e.g. `{{address = "user@example.com"}}` |

### Examples

```lua
-- Create a person contact with email
local result = app.integrations.capsule.create_contact({
  type = "person",
  firstName = "Jane",
  lastName = "Doe",
  emailAddresses = {
    { address = "jane@example.com" }
  }
})

print("Created contact ID: " .. result.party.id)

-- Create an organisation
local result = app.integrations.capsule.create_contact({
  type = "organisation",
  firstName = "Acme Corp",
  lastName = ""
})
```

---

## list_opportunities

List sales opportunities from Capsule CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of opportunities per page, max 100 (default: 50) |
| `status` | string | no | Filter by status: OPEN, WON, LOST, or CLOSED |

### Examples

```lua
-- List all open opportunities
local result = app.integrations.capsule.list_opportunities({
  status = "OPEN"
})

for _, opp in ipairs(result.opportunities) do
  print(opp.id .. ": " .. opp.name .. " - " .. (opp.value or "no value"))
end

-- Paginated list of all opportunities
local result = app.integrations.capsule.list_opportunities({
  page = 1,
  per_page = 100
})
```

---

## get_opportunity

Retrieve a single sales opportunity by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The opportunity ID |

### Examples

```lua
local result = app.integrations.capsule.get_opportunity({ id = 67890 })
local opp = result.opportunity

print(opp.name)
print("Value: " .. (opp.value or "N/A"))
print("Status: " .. opp.status)
```

---

## list_tasks

List tasks from Capsule CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of tasks per page, max 100 (default: 50) |
| `status` | string | no | Filter by status: OPEN or COMPLETED |

### Examples

```lua
-- List open tasks
local result = app.integrations.capsule.list_tasks({
  status = "OPEN"
})

for _, task in ipairs(result.tasks) do
  print(task.id .. ": " .. task.description)
end

-- Completed tasks, page 2
local result = app.integrations.capsule.list_tasks({
  status = "COMPLETED",
  page = 2,
  per_page = 25
})
```

---

## get_current_user

Get the currently authenticated Capsule CRM user. Use this to verify credentials or identify the connected account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.capsule.get_current_user({})
local user = result.user

print("Connected as: " .. user.firstName .. " " .. user.lastName)
print("Email: " .. user.emailAddress)
```

---

## Multi-Account Usage

If you have multiple Capsule CRM accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.capsule.list_contacts({})

-- Explicit default (portable across setups)
app.integrations.capsule.default.list_contacts({})

-- Named accounts
app.integrations.capsule.work.list_contacts({})
app.integrations.capsule.personal.list_contacts({})
```

All functions are identical across accounts — only the credentials differ.
