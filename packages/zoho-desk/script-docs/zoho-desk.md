# Zoho Desk — Ruby API Reference

## list_tickets

List support tickets with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `departmentId` | string | no | Filter by department ID |
| `status` | string | no | Filter by status: "Open", "On Hold", "Closed", "Escalated" |
| `priority` | string | no | Filter by priority: "High", "Medium", "Low" |
| `from` | integer | no | Starting index for pagination (default: 1) |
| `limit` | integer | no | Max tickets to return (default: 25, max: 200) |
| `sortBy` | string | no | Sort field (e.g., "createdTime", "subject") |
| `sortOrder` | string | no | Sort direction: "asc" or "desc" |
| `search` | string | no | Search term for subject or description |

### Example

```ruby
result = app.call("integrations.zoho-desk.list_tickets", status: "Open", priority: "High", limit: 10)
(result.data || []).each do |ticket|
  puts((ticket.id).to_s + ": " + (ticket.subject).to_s + " [" + (ticket.status).to_s + "]")
end
```
---

## get_ticket

Get full details of a specific support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticketId` | string | yes | The ticket ID to retrieve |

### Example

```ruby
result = app.call("integrations.zoho-desk.get_ticket", ticket_id: "123456789")
puts("Subject: " + (result.subject).to_s)
puts("Status: " + (result.status).to_s)
puts("Priority: " + (result.priority).to_s)
```
---

## create_ticket

Create a new support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Ticket subject line |
| `departmentId` | string | yes | Department ID to assign |
| `description` | string | no | Detailed description |
| `contactId` | string | no | Contact ID to associate |
| `email` | string | no | Contact email (alternative to contactId) |
| `priority` | string | no | Priority: "High", "Medium", "Low", "Lowest" |
| `status` | string | no | Initial status |
| `channel` | string | no | Channel: "Email", "Phone", "Web", "Chat" |
| `assigneeId` | string | no | Agent ID to assign |
| `teamId` | string | no | Team ID to assign |

### Example

```ruby
result = app.call("integrations.zoho-desk.create_ticket", subject: "Login issue", department_id: "123456", description: "User cannot log in after password reset.", priority: "High", email: "user@example.com")
puts("Created ticket: " + (result.id).to_s)
```
---

## update_ticket

Update an existing support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticketId` | string | yes | The ticket ID to update |
| `subject` | string | no | Updated subject |
| `description` | string | no | Updated description |
| `status` | string | no | New status |
| `priority` | string | no | New priority |
| `assigneeId` | string | no | Reassign to agent |
| `teamId` | string | no | Reassign to team |
| `departmentId` | string | no | Move to department |
| `channel` | string | no | Updated channel |

### Example

```ruby
result = app.call("integrations.zoho-desk.update_ticket", ticket_id: "123456789", status: "Closed")
puts("Ticket updated")
```
---

## list_contacts

List contacts from Zoho Desk.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | integer | no | Starting index for pagination |
| `limit` | integer | no | Max contacts to return |
| `search` | string | no | Search by name, email, or phone |
| `sortBy` | string | no | Sort field |
| `sortOrder` | string | no | Sort direction: "asc" or "desc" |

### Example

```ruby
result = app.call("integrations.zoho-desk.list_contacts", search: "john", limit: 5)
(result.data || []).each do |contact|
  puts((contact.id).to_s + ": " + (contact.firstName).to_s + " " + ((contact.lastName || "")).to_s)
end
```
---

## list_articles

List knowledge base articles.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `departmentId` | string | no | Filter by department |
| `categoryId` | string | no | Filter by category |
| `from` | integer | no | Starting index for pagination |
| `limit` | integer | no | Max articles to return |
| `search` | string | no | Search by title or content |
| `sortBy` | string | no | Sort field |
| `sortOrder` | string | no | Sort direction: "asc" or "desc" |

### Example

```ruby
result = app.call("integrations.zoho-desk.list_articles", department_id: "123456", search: "password reset", limit: 5)
(result.data || []).each do |article|
  puts((article.id).to_s + ": " + (article.title).to_s)
end
```
---

## list_departments

List all support departments.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | integer | no | Starting index for pagination |
| `limit` | integer | no | Max departments to return |

### Example

```ruby
result = app.call("integrations.zoho-desk.list_departments")
(result.data || []).each do |dept|
  puts((dept.id).to_s + ": " + (dept.name).to_s)
end
```
---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```ruby
result = app.call("integrations.zoho-desk.get_current_user")
puts("Logged in as: " + (result.firstName).to_s + " " + ((result.lastName || "")).to_s)
puts("Email: " + ((result.emailId || "N/A")).to_s)
puts("Role: " + (((result.role && result.role.name) || "N/A")).to_s)
```
---

## Multi-Account Usage

If you have multiple Zoho Desk accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.call("integrations.zoho-desk.list_tickets")
# Explicit default (portable across setups)
app.call("integrations.zoho-desk.default.list_tickets")
# Named accounts
app.call("integrations.zoho-desk.production.list_tickets")
app.call("integrations.zoho-desk.staging.list_tickets")
```
All functions are identical across accounts — only the credentials differ.
