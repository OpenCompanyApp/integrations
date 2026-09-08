# Wealthbox CRM — Ruby API Reference

## list_contacts

List contacts from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of contacts per page (default: 25, max: 200) |
| `search` | string | no | Search term to filter contacts by name or email |

### Examples

```ruby
# List all contacts
result = app.integrations.wealthbox.list_contacts()
result.contacts.each do |contact|
  puts((contact.first_name).to_s + " " + (contact.last_name).to_s)
end
```
```ruby
# Search for a contact
result = app.integrations.wealthbox.list_contacts(search: "John")
```
```ruby
# Paginate through contacts
result = app.integrations.wealthbox.list_contacts(page: 2, per_page: 50)
```
---

## get_contact

Get a specific contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The contact ID in Wealthbox |

### Examples

```ruby
result = app.integrations.wealthbox.get_contact(id: 12345)
puts((result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + ((result.email || "N/A")).to_s)
```
---

## create_contact

Create a new contact in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no* | Contact's first name |
| `last_name` | string | no* | Contact's last name |
| `email` | string | no | Contact's email address |
| `phone` | string | no | Contact's phone number |
| `street` | string | no | Street address |
| `city` | string | no | City |
| `state` | string | no | State or province |
| `zip` | string | no | ZIP or postal code |
| `type` | string | no | Contact type (e.g., "Client", "Prospect", "Lead") |
| `tags` | array | no | Tags to assign to the contact |

*At least `first_name` or `last_name` is required.

### Examples

```ruby
# Create a basic contact
result = app.integrations.wealthbox.create_contact(first_name: "Jane", last_name: "Smith", email: "jane@example.com")
puts("Created contact ID: " + (result.id).to_s)
```
```ruby
# Create a contact with full details
result = app.integrations.wealthbox.create_contact(first_name: "Jane", last_name: "Smith", email: "jane@example.com", phone: "+1-555-0123", street: "123 Main St", city: "New York", state: "NY", zip: "10001", type: "Client", tags: ["VIP", "Referral"])
```
---

## list_tasks

List tasks from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of tasks per page (default: 25, max: 200) |
| `status` | string | no | Filter by task status (e.g., "open", "completed") |

### Examples

```ruby
# List open tasks
result = app.integrations.wealthbox.list_tasks(status: "open")
result.tasks.each do |task|
  puts((task.name).to_s + " — Due: " + ((task.due_date || "No date")).to_s)
end
```
---

## create_task

Create a new task in Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The task name or title |
| `due_date` | string | no | Due date (ISO 8601, e.g., "2026-04-15") |
| `description` | string | no | Task description or notes |
| `assignee_id` | integer | no | User ID of the assignee |
| `contact_id` | integer | no | Link the task to a contact by their ID |
| `priority` | string | no | Task priority (e.g., "high", "medium", "low") |

### Examples

```ruby
# Create a follow-up task
result = app.integrations.wealthbox.create_task(name: "Follow up with Jane Smith", due_date: "2026-04-15", description: "Discuss portfolio rebalancing", contact_id: 12345, priority: "high")
puts("Created task ID: " + (result.id).to_s)
```
---

## list_opportunities

List opportunities (sales pipeline) from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of opportunities per page (default: 25, max: 200) |
| `status` | string | no | Filter by opportunity status (e.g., "open", "won", "lost") |

### Examples

```ruby
# List open opportunities
result = app.integrations.wealthbox.list_opportunities(status: "open")
result.opportunities.each do |opp|
  puts((opp.name).to_s + " — Value: $" + ((opp.value || "0")).to_s)
end
```
---

## list_workflows

List workflows from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of workflows per page (default: 25, max: 200) |

### Examples

```ruby
result = app.integrations.wealthbox.list_workflows()
result.workflows.each do |workflow|
  puts((workflow.name).to_s + " — Status: " + (workflow.status).to_s)
end
```
---

## list_events

List calendar events from Wealthbox CRM.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of events per page (default: 25, max: 200) |
| `start_date` | string | no | Filter events starting from this date (ISO 8601) |
| `end_date` | string | no | Filter events up to this date (ISO 8601) |

### Examples

```ruby
# List upcoming events for April 2026
result = app.integrations.wealthbox.list_events(start_date: "2026-04-01", end_date: "2026-04-30")
result.events.each do |event|
  puts((event.title).to_s + " — " + (event.starts_at).to_s)
end
```
---

## get_current_user

Get the currently authenticated Wealthbox user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.wealthbox.get_current_user()
puts("Logged in as: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Wealthbox accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
