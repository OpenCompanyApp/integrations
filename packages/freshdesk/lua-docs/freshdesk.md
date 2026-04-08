# Freshdesk — Lua API Reference

## Authentication

The Freshdesk integration uses HTTP Basic Auth with your API key as the username and `X` as the password. Configure your **API Key** and **Domain** (the part before `.freshdesk.com`) in the integration settings.

---

## Ticket Operations

### list_tickets

List support tickets with optional filters and pagination.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (max: 100, default: 30) |
| `filter` | string | no | Predefined filter: `"new_and_my_open"`, `"watching"`, `"spam"`, `"deleted"` |
| `company_id` | integer | no | Filter by company ID |
| `requester_id` | integer | no | Filter by requester ID |
| `email` | string | no | Filter by requester email |

```lua
local result = app.integrations.freshdesk.list_tickets({
  filter = "new_and_my_open",
  per_page = 25
})
for _, ticket in ipairs(result) do
  print(ticket.id .. ": " .. ticket.subject .. " [" .. ticket.status .. "]")
end
```

### get_ticket

Get full details of a specific ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```lua
local ticket = app.integrations.freshdesk.get_ticket({ ticket_id = 12345 })
print(ticket.subject)
print(ticket.description)
print("Status: " .. ticket.status .. ", Priority: " .. ticket.priority)
```

### create_ticket

Create a new support ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `subject` | string | yes | Ticket subject |
| `description` | string | yes | HTML description |
| `email` | string | yes | Requester email |
| `priority` | integer | no | 1=Low, 2=Medium, 3=High, 4=Urgent |
| `status` | integer | no | 2=Open, 3=Pending, 4=Resolved, 5=Closed |
| `type` | string | no | Ticket type (e.g., "Question", "Incident") |
| `tags` | array | no | Array of tag strings |
| `group_id` | integer | no | Group to assign |
| `assignee_id` | integer | no | Agent to assign |
| `cc_emails` | array | no | CC email addresses |

```lua
local ticket = app.integrations.freshdesk.create_ticket({
  subject = "Cannot access account",
  description = "<p>User reports being locked out after password reset.</p>",
  email = "john@example.com",
  priority = 3,
  status = 2,
  tags = { "login", "urgent" }
})
print("Created ticket #" .. ticket.id)
```

### update_ticket

Update an existing ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |
| `subject` | string | no | New subject |
| `description` | string | no | New description |
| `priority` | integer | no | New priority (1–4) |
| `status` | integer | no | New status (2–5) |
| `type` | string | no | New type |
| `tags` | array | no | Replace tags |
| `group_id` | integer | no | New group |
| `assignee_id` | integer | no | New assignee |

```lua
app.integrations.freshdesk.update_ticket({
  ticket_id = 12345,
  status = 4,
  priority = 2
})
```

### delete_ticket

Permanently delete a ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```lua
app.integrations.freshdesk.delete_ticket({ ticket_id = 12345 })
```

---

## Contact Operations

### list_contacts

List customer contacts.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page |
| `email` | string | no | Filter by email |
| `company_id` | integer | no | Filter by company |
| `mobile` | string | no | Filter by mobile |
| `phone` | string | no | Filter by phone |

```lua
local contacts = app.integrations.freshdesk.list_contacts({ per_page = 50 })
```

### get_contact

Get details of a specific contact.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | yes | The contact ID |

```lua
local contact = app.integrations.freshdesk.get_contact({ contact_id = 42 })
print(contact.name .. " <" .. contact.email .. ">")
```

### create_contact

Create a new customer contact.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `email` | string | yes | Contact email |
| `name` | string | yes | Full name |
| `phone` | string | no | Phone number |
| `mobile` | string | no | Mobile number |
| `company_id` | integer | no | Company to associate |
| `job_title` | string | no | Job title |
| `tags` | array | no | Tags |

```lua
local contact = app.integrations.freshdesk.create_contact({
  email = "jane@example.com",
  name = "Jane Smith",
  job_title = "CTO"
})
```

---

## Agent Operations

### list_agents

List all helpdesk agents.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page |

```lua
local agents = app.integrations.freshdesk.list_agents()
```

### get_agent

Get details of a specific agent.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `agent_id` | integer | yes | The agent ID |

```lua
local agent = app.integrations.freshdesk.get_agent({ agent_id = 5 })
print(agent.contact.name)
```

### get_current_user

Get the currently authenticated agent. Useful for verifying API credentials.

```lua
local user = app.integrations.freshdesk.get_current_user({})
print("Authenticated as: " .. user.contact.name)
```

---

## Conversation Operations

### list_conversations

List all conversations (replies and notes) on a ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```lua
local convos = app.integrations.freshdesk.list_conversations({ ticket_id = 12345 })
for _, c in ipairs(convos) do
  print(c.source .. ": " .. c.body_text)
end
```

### create_reply

Post a public reply to a ticket (visible to the customer).

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |
| `body` | string | yes | HTML body of the reply |
| `cc_emails` | array | no | CC email addresses |
| `bcc_emails` | array | no | BCC email addresses |

```lua
app.integrations.freshdesk.create_reply({
  ticket_id = 12345,
  body = "<p>Hi, we've resolved this issue. Please let us know if you need anything else!</p>"
})
```

### create_note

Add a private note to a ticket (only visible to agents).

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |
| `body` | string | yes | HTML body of the note |

```lua
app.integrations.freshdesk.create_note({
  ticket_id = 12345,
  body = "<p>Spoke with customer on the phone. They confirmed the fix works.</p>"
})
```

---

## Company Operations

### list_companies

List customer companies.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page |

```lua
local companies = app.integrations.freshdesk.list_companies({ page = 1 })
for _, company in ipairs(companies) do
  print(company.name)
end
```

---

## Status & Priority Reference

### Ticket Status

| Value | Meaning |
|-------|---------|
| 2 | Open |
| 3 | Pending |
| 4 | Resolved |
| 5 | Closed |

### Ticket Priority

| Value | Meaning |
|-------|---------|
| 1 | Low |
| 2 | Medium |
| 3 | High |
| 4 | Urgent |

---

## Multi-Account Usage

If you have multiple Freshdesk accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.freshdesk.list_tickets({})

-- Explicit default (portable across setups)
app.integrations.freshdesk.default.list_tickets({})

-- Named accounts
app.integrations.freshdesk.production.list_tickets({})
app.integrations.freshdesk.staging.list_tickets({})
```

All functions are identical across accounts — only the credentials differ.
