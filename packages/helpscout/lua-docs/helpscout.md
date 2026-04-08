# HelpScout — Lua API Reference

## list_conversations

List support conversations with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `mailbox` | integer | no | Filter by mailbox ID |
| `status` | string | no | Filter by status: `"open"`, `"closed"`, `"pending"`, `"spam"`, `"all"` |
| `assignee` | integer | no | Filter by assigned user ID (0 for unassigned) |
| `customer` | integer | no | Filter by customer ID |
| `tag` | string | no | Filter by tag name |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 50) |
| `sort_field` | string | no | Sort by: `createdAt`, `updatedAt`, `customer.name`, `subject`, `status`, `mailbox` |
| `sort_order` | string | no | Sort direction: `"asc"` or `"desc"` (default: `"desc"`) |
| `query` | string | no | Search query to filter by keyword |

### Example

```lua
local result = app.integrations.helpscout.list_conversations({
  status = "open",
  mailbox = 123,
  per_page = 10
})

for _, conv in ipairs(result._embedded.conversations) do
  print(conv.id .. ": " .. conv.subject .. " (" .. conv.status .. ")")
end
```

---

## get_conversation

Get full details of a specific conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The conversation ID |

### Example

```lua
local conv = app.integrations.helpscout.get_conversation({ id = 456 })
print("Subject: " .. conv.subject)
print("Status: " .. conv.status)
print("Customer: " .. conv._embedded.customer.firstName .. " " .. conv._embedded.customer.lastName)
```

---

## create_conversation

Create a new support conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subject` | string | yes | Conversation subject line |
| `mailbox_id` | integer | yes | Mailbox ID to create the conversation in |
| `customer_id` | integer | no* | Customer ID (required unless `customer_email` is provided) |
| `customer_email` | string | no* | Customer email (used if `customer_id` is not provided) |
| `body` | string | yes | Content of the first message |
| `type` | string | no | `"email"` (default) or `"chat"` |
| `status` | string | no | `"open"` (default), `"pending"`, or `"closed"` |
| `assignee_id` | integer | no | User ID to assign to |
| `tags` | array | no | Array of tag names |
| `cc` | array | no | Array of email addresses to CC |
| `bcc` | array | no | Array of email addresses to BCC |

### Example

```lua
local result = app.integrations.helpscout.create_conversation({
  subject = "Billing question",
  mailbox_id = 123,
  customer_email = "jane@example.com",
  body = "I have a question about my latest invoice.",
  tags = { "billing", "priority" }
})

print("Created conversation: " .. result.id)
```

---

## update_conversation

Update an existing conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The conversation ID to update |
| `status` | string | no | New status: `"open"`, `"closed"`, `"pending"`, `"spam"` |
| `subject` | string | no | Updated subject line |
| `assignee_id` | integer | no | User ID to assign (0 to unassign) |
| `mailbox_id` | integer | no | Move to a different mailbox |
| `tags` | array | no | Replace all tags (array of strings) |

### Example

```lua
app.integrations.helpscout.update_conversation({
  id = 456,
  status = "closed",
  tags = { "resolved", "billing" }
})
```

---

## list_customers

List or search customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | Filter by first name (partial match) |
| `last_name` | string | no | Filter by last name (partial match) |
| `email` | string | no | Filter by email (partial match) |
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 50) |
| `sort_field` | string | no | Sort by: `firstName`, `lastName`, `createdAt`, `updatedAt` |
| `sort_order` | string | no | Sort direction: `"asc"` or `"desc"` |
| `query` | string | no | Search query to filter by keyword |

### Example

```lua
local result = app.integrations.helpscout.list_customers({
  email = "jane@example.com"
})

for _, customer in ipairs(result._embedded.customers) do
  print(customer.id .. ": " .. customer.firstName .. " " .. customer.lastName)
end
```

---

## get_customer

Get details of a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The customer ID |

### Example

```lua
local customer = app.integrations.helpscout.get_customer({ id = 789 })
print(customer.firstName .. " " .. customer.lastName)
print("Email: " .. customer._embedded.emails[1].value)
```

---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `first_name` | string | no | First name |
| `last_name` | string | no | Last name |
| `email` | string | no | Primary email address |
| `organization` | string | no | Company or organization name |
| `job_title` | string | no | Job title |
| `phone` | string | no | Phone number |

At least one of `first_name`, `last_name`, or `email` is required.

### Example

```lua
local result = app.integrations.helpscout.create_customer({
  first_name = "Jane",
  last_name = "Doe",
  email = "jane@example.com",
  organization = "Acme Corp"
})

print("Created customer: " .. result.id)
```

---

## list_mailboxes

List all mailboxes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number (default: 1) |
| `per_page` | integer | no | Results per page (default: 25, max: 50) |

### Example

```lua
local result = app.integrations.helpscout.list_mailboxes({})

for _, mailbox in ipairs(result._embedded.mailboxes) do
  print(mailbox.id .. ": " .. mailbox.name .. " (" .. mailbox.email .. ")")
end
```

---

## get_mailbox

Get details of a specific mailbox.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The mailbox ID |

### Example

```lua
local mailbox = app.integrations.helpscout.get_mailbox({ id = 123 })
print("Mailbox: " .. mailbox.name)
print("Email: " .. mailbox.email)
```

---

## get_current_user

Get the profile of the currently authenticated user.

### Parameters

None.

### Example

```lua
local user = app.integrations.helpscout.get_current_user({})
print("Logged in as: " .. user.firstName .. " " .. user.lastName)
print("Email: " .. user.email)
print("Role: " .. user.role)
```

---

## Multi-Account Usage

If you have multiple HelpScout accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.helpscout.function_name({...})

-- Explicit default (portable across setups)
app.integrations.helpscout.default.function_name({...})

-- Named accounts
app.integrations.helpscout.work.function_name({...})
app.integrations.helpscout.support.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
