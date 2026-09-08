# Freshdesk — Ruby API Reference

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

```ruby
result = app.integrations.freshdesk.list_tickets(filter: "new_and_my_open", per_page: 25)
result.each do |ticket|
  puts((ticket.id).to_s + ": " + (ticket.subject).to_s + " [" + (ticket.status).to_s + "]")
end
```
### get_ticket

Get full details of a specific ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```ruby
ticket = app.integrations.freshdesk.get_ticket(ticket_id: 12345)
puts(ticket.subject)
puts(ticket.description)
puts("Status: " + (ticket.status).to_s + ", Priority: " + (ticket.priority).to_s)
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

```ruby
ticket = app.integrations.freshdesk.create_ticket(subject: "Cannot access account", description: "<p>User reports being locked out after password reset.</p>", email: "john@example.com", priority: 3, status: 2, tags: ["login", "urgent"])
puts("Created ticket #" + (ticket.id).to_s)
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

```ruby
app.integrations.freshdesk.update_ticket(ticket_id: 12345, status: 4, priority: 2)
```
### delete_ticket

Permanently delete a ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```ruby
app.integrations.freshdesk.delete_ticket(ticket_id: 12345)
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

```ruby
contacts = app.integrations.freshdesk.list_contacts(per_page: 50)
```
### get_contact

Get details of a specific contact.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `contact_id` | integer | yes | The contact ID |

```ruby
contact = app.integrations.freshdesk.get_contact(contact_id: 42)
puts((contact.name).to_s + " <" + (contact.email).to_s + ">")
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

```ruby
contact = app.integrations.freshdesk.create_contact(email: "jane@example.com", name: "Jane Smith", job_title: "CTO")
```
---

## Agent Operations

### list_agents

List all helpdesk agents.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page |

```ruby
agents = app.integrations.freshdesk.list_agents()
```
### get_agent

Get details of a specific agent.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `agent_id` | integer | yes | The agent ID |

```ruby
agent = app.integrations.freshdesk.get_agent(agent_id: 5)
puts(agent.contact.name)
```
### get_current_user

Get the currently authenticated agent. Useful for verifying API credentials.

```ruby
user = app.integrations.freshdesk.get_current_user()
puts("Authenticated as: " + (user.contact.name).to_s)
```
---

## Conversation Operations

### list_conversations

List all conversations (replies and notes) on a ticket.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |

```ruby
convos = app.integrations.freshdesk.list_conversations(ticket_id: 12345)
convos.each do |c|
  puts((c.source).to_s + ": " + (c.body_text).to_s)
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

```ruby
app.integrations.freshdesk.create_reply(ticket_id: 12345, body: "<p>Hi, we've resolved this issue. Please let us know if you need anything else!</p>")
```
### create_note

Add a private note to a ticket (only visible to agents).

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket ID |
| `body` | string | yes | HTML body of the note |

```ruby
app.integrations.freshdesk.create_note(ticket_id: 12345, body: "<p>Spoke with customer on the phone. They confirmed the fix works.</p>")
```
---

## Company Operations

### list_companies

List customer companies.

| Parameter | Type | Required | Description |
|-----------|------|----------|-------------|
| `page` | integer | no | Page number |
| `per_page` | integer | no | Results per page |

```ruby
companies = app.integrations.freshdesk.list_companies(page: 1)
companies.each do |company|
  puts(company.name)
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

```ruby
# Default account (always works)
app.integrations.freshdesk.list_tickets()
# Explicit default (portable across setups)
app.integrations.freshdesk.default.list_tickets()
# Named accounts
app.integrations.freshdesk.production.list_tickets()
app.integrations.freshdesk.staging.list_tickets()
```
All functions are identical across accounts — only the credentials differ.
