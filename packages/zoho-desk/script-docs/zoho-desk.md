# Zoho Desk — JavaScript API Reference

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

```js
var result = app.integrations["zoho-desk"].list_tickets({
  status: "Open",
  priority: "High",
  limit: 10,
})

for (const ticket of (result.data || [])) {
  console.log(ticket.id + ": " + ticket.subject + " [" + ticket.status + "]")
}
```
---

## get_ticket

Get full details of a specific support ticket.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticketId` | string | yes | The ticket ID to retrieve |

### Example

```js
var result = app.integrations["zoho-desk"].get_ticket({
  ticketId: "123456789",
})

console.log("Subject: " + result.subject)
console.log("Status: " + result.status)
console.log("Priority: " + result.priority)
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

```js
var result = app.integrations["zoho-desk"].create_ticket({
  subject: "Login issue",
  departmentId: "123456",
  description: "User cannot log in after password reset.",
  priority: "High",
  email: "user@example.com",
})

console.log("Created ticket: " + result.id)
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

```js
var result = app.integrations["zoho-desk"].update_ticket({
  ticketId: "123456789",
  status: "Closed",
})

console.log("Ticket updated")
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

```js
var result = app.integrations["zoho-desk"].list_contacts({
  search: "john",
  limit: 5,
})

for (const contact of (result.data || [])) {
  console.log(contact.id + ": " + contact.firstName + " " + (contact.lastName || ""))
}
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

```js
var result = app.integrations["zoho-desk"].list_articles({
  departmentId: "123456",
  search: "password reset",
  limit: 5,
})

for (const article of (result.data || [])) {
  console.log(article.id + ": " + article.title)
}
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

```js
var result = app.integrations["zoho-desk"].list_departments({})

for (const dept of (result.data || [])) {
  console.log(dept.id + ": " + dept.name)
}
```
---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```js
var result = app.integrations["zoho-desk"].get_current_user({})

console.log("Logged in as: " + result.firstName + " " + (result.lastName || ""))
console.log("Email: " + (result.emailId || "N/A"))
console.log("Role: " + (result.role && result.role.name || "N/A"))
```
---

## Multi-Account Usage

If you have multiple Zoho Desk accounts configured, use account-specific namespaces:

```js
// Default account (always works)
app.integrations["zoho-desk"].list_tickets({ /* parameters */ })

// Explicit default (portable across setups)
app.integrations["zoho-desk"].default.list_tickets({ /* parameters */ })

// Named accounts
app.integrations["zoho-desk"].production.list_tickets({ /* parameters */ })
app.integrations["zoho-desk"].staging.list_tickets({ /* parameters */ })
```
All functions are identical across accounts — only the credentials differ.
