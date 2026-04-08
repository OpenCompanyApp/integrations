# Freshservice — Lua API Reference

## list_tickets

List support tickets with optional pagination and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `per_page` | integer | no | Number of tickets per page (max 100) |
| `filter` | string | no | Predefined filter: `"new_and_my_open"`, `"watching"`, `"spam"`, or `"deleted"` |

### Examples

```lua
-- List open tickets (first page)
local result = app.integrations.freshservice.list_tickets({
  filter = "new_and_my_open",
  per_page = 25
})

for _, ticket in ipairs(result.tickets) do
  print(ticket.id .. ": " .. ticket.subject .. " [Priority: " .. ticket.priority .. "]")
end
```

```lua
-- Paginate through tickets
local result = app.integrations.freshservice.list_tickets({
  page = 2,
  per_page = 50
})
```

---

## get_ticket

Get full details of a specific ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket display ID |

### Example

```lua
local result = app.integrations.freshservice.get_ticket({
  ticket_id = 42
})

local ticket = result.ticket
print("Subject: " .. ticket.subject)
print("Status: " .. ticket.status)
print("Priority: " .. ticket.priority)
print("Requester: " .. ticket.requester.email)
```

---

## create_ticket

Create a new support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | The ticket subject / title |
| `description` | string | yes | Ticket description (supports HTML) |
| `email` | string | no | Email address of the requester |
| `priority` | integer | no | Priority: 1=Low, 2=Medium, 3=High, 4=Urgent |

### Priority Values

| Value | Level |
|-------|-------|
| 1 | Low |
| 2 | Medium (default) |
| 3 | High |
| 4 | Urgent |

### Example

```lua
local result = app.integrations.freshservice.create_ticket({
  subject = "VPN connection issue",
  description = "<p>Cannot connect to the company VPN since this morning. Getting error code 691.</p>",
  email = "john@example.com",
  priority = 3
})

print("Created ticket #" .. result.ticket.id)
```

---

## update_ticket

Update an existing ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket display ID |
| `subject` | string | no | Updated ticket subject |
| `description` | string | no | Updated ticket description |
| `priority` | integer | no | Priority: 1=Low, 2=Medium, 3=High, 4=Urgent |
| `status` | integer | no | Status: 2=Open, 3=Pending, 4=Resolved, 5=Closed |
| `responder_id` | integer | no | ID of the agent to assign |
| `tags` | array | no | Array of tag strings |

### Status Values

| Value | Status |
|-------|--------|
| 2 | Open |
| 3 | Pending |
| 4 | Resolved |
| 5 | Closed |

### Examples

```lua
-- Assign and prioritize a ticket
local result = app.integrations.freshservice.update_ticket({
  ticket_id = 42,
  responder_id = 5,
  priority = 4
})

-- Resolve a ticket
local result = app.integrations.freshservice.update_ticket({
  ticket_id = 42,
  status = 4
})

-- Add tags
local result = app.integrations.freshservice.update_ticket({
  ticket_id = 42,
  tags = {"vpn", "urgent", "networking"}
})
```

---

## delete_ticket

Delete a ticket permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket display ID to delete |

### Example

```lua
local result = app.integrations.freshservice.delete_ticket({
  ticket_id = 42
})

print(result) -- "Ticket 42 has been deleted."
```

---

## list_agents

List all agents (support staff) in the Freshservice account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | string | no | Page cursor for pagination |

### Example

```lua
local result = app.integrations.freshservice.list_agents({})

for _, agent in ipairs(result.agents) do
  print(agent.id .. ": " .. agent.first_name .. " " .. agent.last_name .. " (" .. agent.email .. ")")
end
```

---

## get_agent

Get details of a specific agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `agent_id` | integer | yes | The agent ID |

### Example

```lua
local result = app.integrations.freshservice.get_agent({
  agent_id = 5
})

local agent = result.agent
print(agent.first_name .. " " .. agent.last_name)
print("Email: " .. agent.email)
print("Available: " .. tostring(agent.available))
```

---

## list_assets

List IT assets with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```lua
local result = app.integrations.freshservice.list_assets({
  page = 1
})

for _, asset in ipairs(result.assets) do
  print(asset.display_id .. ": " .. asset.name .. " [" .. asset.asset_type .. "]")
end
```

---

## get_asset

Get details of a specific asset.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `asset_id` | integer | yes | The asset display ID |

### Example

```lua
local result = app.integrations.freshservice.get_asset({
  asset_id = 15
})

local asset = result.asset
print("Name: " .. asset.name)
print("Type: " .. asset.asset_type)
print("State: " .. asset.state_name)
```

---

## get_current_user

Get the profile of the currently authenticated agent. Takes no parameters.

### Example

```lua
local result = app.integrations.freshservice.get_current_user({})

local agent = result.agent
print("Authenticated as: " .. agent.first_name .. " " .. agent.last_name)
print("Email: " .. agent.email)
```

---

## Multi-Account Usage

If you have multiple Freshservice accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshservice.list_tickets({})

-- Explicit default (portable across setups)
app.integrations.freshservice.default.list_tickets({})

-- Named accounts
app.integrations.freshservice.production.list_tickets({})
app.integrations.freshservice.staging.list_tickets({})
```

All functions are identical across accounts — only the credentials differ.
