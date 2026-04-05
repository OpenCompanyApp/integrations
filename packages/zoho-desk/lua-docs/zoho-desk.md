# Zoho Desk — Lua API Reference

## list_tickets

List support tickets with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `departmentId` | string | no | Filter by department ID |
| `status` | string | no | Filter by status (e.g., `"Open"`, `"On Hold"`, `"Closed"`) |
| `priority` | string | no | Filter by priority (`"Highest"`, `"High"`, `"Medium"`, `"Low"`, `"Lowest"`) |
| `contactId` | string | no | Filter by contact ID |
| `assigneeId` | string | no | Filter by assignee (agent) ID |
| `from` | integer | no | Pagination offset (default: 1) |
| `limit` | integer | no | Results per page (default: 50, max: 200) |
| `sortBy` | string | no | Sort field (e.g., `"createdTime"`, `"modifiedTime"`, `"ticketNumber"`) |
| `sortOrder` | string | no | Sort direction: `"asc"` or `"desc"` |

### Examples

```lua
-- List all open tickets
local result = app.integrations["zoho-desk"].list_tickets({
  status = "Open",
  limit = 25
})

for _, ticket in ipairs(result) do
  print(ticket.ticketNumber .. ": " .. ticket.subject)
end

-- List high-priority tickets in a specific department
local result = app.integrations["zoho-desk"].list_tickets({
  departmentId = "987654321",
  priority = "High",
  sortBy = "createdTime",
  sortOrder = "desc"
})
```

---

## get_ticket

Get a single ticket by ID with full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `ticketId` | string | yes | The Zoho Desk ticket ID |

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
| `departmentId` | string | yes | Department to assign the ticket to |
| `description` | string | no | Detailed description of the issue |
| `contactId` | string | no | Contact ID to associate |
| `email` | string | no | Contact email (alternative to contactId) |
| `priority` | string | no | Priority level |
| `status` | string | no | Initial status (default: department default) |
| `category` | string | no | Ticket category |
| `channel` | string | no | Source channel (default: `"Web"`) |
| `assigneeId` | string | no | Agent ID to assign |

### Example

```lua
local result = app.integrations["zoho-desk"].create_ticket({
  subject = "Cannot access account",
  departmentId = "987654321",
  description = "User reports being locked out after password change.",
  priority = "High",
  email = "john@example.com"
})

print("Created ticket: " .. result.ticketNumber)
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
| `status` | string | no | New status (`"Open"`, `"On Hold"`, `"Closed"`, `"Resolved"`) |
| `priority` | string | no | New priority |
| `assigneeId` | string | no | Reassign to this agent |
| `departmentId` | string | no | Move to this department |
| `category` | string | no | Updated category |
| `comment` | string | no | Add a comment with the update |

### Example

```lua
local result = app.integrations["zoho-desk"].update_ticket({
  ticketId = "123456789",
  status = "Resolved",
  comment = "Issue resolved after resetting the user's password."
})
```

---

## list_contacts

List customer contacts with optional search.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search by name or email |
| `from` | integer | no | Pagination offset (default: 1) |
| `limit` | integer | no | Results per page (default: 50, max: 200) |
| `sortBy` | string | no | Sort field |
| `sortOrder` | string | no | Sort direction |

### Example

```lua
local result = app.integrations["zoho-desk"].list_contacts({
  search = "john@example.com",
  limit = 10
})

for _, contact in ipairs(result) do
  print(contact.firstName .. " " .. (contact.lastName or "") .. " - " .. (contact.email or ""))
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
| `status` | string | no | Filter by status (e.g., `"Published"`, `"Draft"`) |
| `from` | integer | no | Pagination offset (default: 1) |
| `limit` | integer | no | Results per page (default: 50, max: 200) |
| `sortBy` | string | no | Sort field |
| `sortOrder` | string | no | Sort direction |

### Example

```lua
local result = app.integrations["zoho-desk"].list_articles({
  departmentId = "987654321",
  status = "Published",
  limit = 20
})

for _, article in ipairs(result) do
  print(article.title)
end
```

---

## list_departments

List all departments in the organization. No parameters required.

### Example

```lua
local result = app.integrations["zoho-desk"].list_departments({})

for _, dept in ipairs(result) do
  print(dept.id .. ": " .. dept.name)
end
```

---

## get_current_user

Get the currently authenticated user profile. No parameters required.

### Example

```lua
local result = app.integrations["zoho-desk"].get_current_user({})

print("Logged in as: " .. result.firstName .. " " .. (result.lastName or ""))
print("Email: " .. (result.email or ""))
print("Role: " .. (result.roleName or ""))
```

---

## Multi-Account Usage

If you have multiple Zoho Desk accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["zoho-desk"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["zoho-desk"].default.function_name({...})

-- Named accounts
app.integrations["zoho-desk"].production.function_name({...})
app.integrations["zoho-desk"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
