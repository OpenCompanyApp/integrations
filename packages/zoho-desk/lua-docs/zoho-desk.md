# Zoho Desk — Lua API Reference

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

```lua
local result = app.integrations["zoho-desk"].list_tickets({
  status = "Open",
  priority = "High",
  limit = 10
})

for _, ticket in ipairs(result.data or {}) do
  print(ticket.id .. ": " .. ticket.subject .. " [" .. ticket.status .. "]")
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

```lua
local result = app.integrations["zoho-desk"].get_ticket({
  ticketId = "123456789"
})

print("Subject: " .. result.subject)
print("Status: " .. result.status)
print("Priority: " .. result.priority)
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

```lua
local result = app.integrations["zoho-desk"].create_ticket({
  subject = "Login issue",
  departmentId = "123456",
  description = "User cannot log in after password reset.",
  priority = "High",
  email = "user@example.com"
})

print("Created ticket: " .. result.id)
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

```lua
local result = app.integrations["zoho-desk"].update_ticket({
  ticketId = "123456789",
  status = "Closed"
})

print("Ticket updated")
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

```lua
local result = app.integrations["zoho-desk"].list_contacts({
  search = "john",
  limit = 5
})

for _, contact in ipairs(result.data or {}) do
  print(contact.id .. ": " .. contact.firstName .. " " .. (contact.lastName or ""))
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

```lua
local result = app.integrations["zoho-desk"].list_articles({
  departmentId = "123456",
  search = "password reset",
  limit = 5
})

for _, article in ipairs(result.data or {}) do
  print(article.id .. ": " .. article.title)
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

```lua
local result = app.integrations["zoho-desk"].list_departments({})

for _, dept in ipairs(result.data or {}) do
  print(dept.id .. ": " .. dept.name)
end
```

---

## get_current_user

Get the currently authenticated user's profile.

### Parameters

None.

### Example

```lua
local result = app.integrations["zoho-desk"].get_current_user({})

print("Logged in as: " .. result.firstName .. " " .. (result.lastName or ""))
print("Email: " .. (result.emailId or "N/A"))
print("Role: " .. (result.role and result.role.name or "N/A"))
```

---

## Multi-Account Usage

If you have multiple Zoho Desk accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zoho-desk"].list_tickets({...})

-- Explicit default (portable across setups)
app.integrations["zoho-desk"].default.list_tickets({...})

-- Named accounts
app.integrations["zoho-desk"].production.list_tickets({...})
app.integrations["zoho-desk"].staging.list_tickets({...})
```

All functions are identical across accounts — only the credentials differ.
