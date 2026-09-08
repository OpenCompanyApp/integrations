# Freshservice — Ruby API Reference

## list_tickets

List support tickets with optional pagination and filtering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |
| `per_page` | integer | no | Number of tickets per page (max 100) |
| `filter` | string | no | Predefined filter: `"new_and_my_open"`, `"watching"`, `"spam"`, or `"deleted"` |

### Examples

```ruby
# List open tickets (first page)
result = app.integrations.freshservice.list_tickets(filter: "new_and_my_open", per_page: 25)
result.tickets.each do |ticket|
  puts((ticket.id).to_s + ": " + (ticket.subject).to_s + " [Priority: " + (ticket.priority).to_s + "]")
end
```
```ruby
# Paginate through tickets
result = app.integrations.freshservice.list_tickets(page: 2, per_page: 50)
```
---

## get_ticket

Get full details of a specific ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket display ID |

### Example

```ruby
result = app.integrations.freshservice.get_ticket(ticket_id: 42)
ticket = result.ticket
puts("Subject: " + (ticket.subject).to_s)
puts("Status: " + (ticket.status).to_s)
puts("Priority: " + (ticket.priority).to_s)
puts("Requester: " + (ticket.requester.email).to_s)
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

```ruby
result = app.integrations.freshservice.create_ticket(subject: "VPN connection issue", description: "<p>Cannot connect to the company VPN since this morning. Getting error code 691.</p>", email: "john@example.com", priority: 3)
puts("Created ticket #" + (result.ticket.id).to_s)
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

```ruby
# Assign and prioritize a ticket
result = app.integrations.freshservice.update_ticket(ticket_id: 42, responder_id: 5, priority: 4)
# Resolve a ticket
result = app.integrations.freshservice.update_ticket(ticket_id: 42, status: 4)
# Add tags
result = app.integrations.freshservice.update_ticket(ticket_id: 42, tags: ["vpn", "urgent", "networking"])
```
---

## delete_ticket

Delete a ticket permanently.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticket_id` | integer | yes | The ticket display ID to delete |

### Example

```ruby
result = app.integrations.freshservice.delete_ticket(ticket_id: 42)
puts(result)
```
---

## list_agents

List all agents (support staff) in the Freshservice account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | string | no | Page cursor for pagination |

### Example

```ruby
result = app.integrations.freshservice.list_agents()
result.agents.each do |agent|
  puts((agent.id).to_s + ": " + (agent.first_name).to_s + " " + (agent.last_name).to_s + " (" + (agent.email).to_s + ")")
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

```ruby
result = app.integrations.freshservice.get_agent(agent_id: 5)
agent = result.agent
puts((agent.first_name).to_s + " " + (agent.last_name).to_s)
puts("Email: " + (agent.email).to_s)
puts("Available: " + ((agent.available).to_s).to_s)
```
---

## list_assets

List IT assets with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (1-based) |

### Example

```ruby
result = app.integrations.freshservice.list_assets(page: 1)
result.assets.each do |asset|
  puts((asset.display_id).to_s + ": " + (asset.name).to_s + " [" + (asset.asset_type).to_s + "]")
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

```ruby
result = app.integrations.freshservice.get_asset(asset_id: 15)
asset = result.asset
puts("Name: " + (asset.name).to_s)
puts("Type: " + (asset.asset_type).to_s)
puts("State: " + (asset.state_name).to_s)
```
---

## get_current_user

Get the profile of the currently authenticated agent. Takes no parameters.

### Example

```ruby
result = app.integrations.freshservice.get_current_user()
agent = result.agent
puts("Authenticated as: " + (agent.first_name).to_s + " " + (agent.last_name).to_s)
puts("Email: " + (agent.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Freshservice accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.freshservice.list_tickets()
# Explicit default (portable across setups)
app.integrations.freshservice.default.list_tickets()
# Named accounts
app.integrations.freshservice.production.list_tickets()
app.integrations.freshservice.staging.list_tickets()
```
All functions are identical across accounts — only the credentials differ.
