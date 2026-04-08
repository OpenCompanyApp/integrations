# Elastic Email — Lua API Reference

## send_email

Send a transactional email via Elastic Email.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient email address. For multiple recipients, separate with semicolons. |
| `subject` | string | yes | Email subject line. |
| `body` | string | yes | HTML body content of the email. |
| `from` | string | no | Sender email address (must be verified in your account). |
| `from_name` | string | no | Display name for the sender. |
| `reply_to` | string | no | Reply-to email address. |
| `cc` | string | no | CC recipients, separated by semicolons. |
| `bcc` | string | no | BCC recipients, separated by semicolons. |

### Example

```lua
local result = app.integrations["elastic-email"].send_email({
  to = "john@example.com",
  subject = "Welcome!",
  body = "<h1>Welcome aboard!</h1><p>Thanks for signing up.</p>",
  from = "noreply@myapp.com",
  from_name = "My App"
})

print(result.message)
```

---

## list_templates

List email templates available in your Elastic Email account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max templates to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Example

```lua
local result = app.integrations["elastic-email"].list_templates({
  limit = 20
})

for _, tpl in ipairs(result.data or {}) do
  print(tpl.name .. " (ID: " .. tpl.id .. ")")
end
```

---

## get_template

Get details of a specific email template by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The template ID |

### Example

```lua
local result = app.integrations["elastic-email"].get_template({
  id = 123
})

print(result.name)
print(result.subject)
```

---

## list_contacts

List contacts from your Elastic Email account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max contacts to return (default: 100) |
| `offset` | integer | no | Pagination offset (default: 0) |

### Example

```lua
local result = app.integrations["elastic-email"].list_contacts({
  limit = 50
})

for _, contact in ipairs(result.data or {}) do
  print(contact.email)
end
```

---

## create_contact

Create or add a contact in Elastic Email. Optionally assign to an existing list.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Contact email address |
| `list_name` | string | no | Name of the list to add the contact to |
| `first_name` | string | no | Contact first name |
| `last_name` | string | no | Contact last name |

### Example

```lua
local result = app.integrations["elastic-email"].create_contact({
  email = "jane@example.com",
  list_name = "Newsletter",
  first_name = "Jane",
  last_name = "Doe"
})

print(result.message)
```

---

## get_current_user

Get information about the currently authenticated Elastic Email user account.

### Parameters

None.

### Example

```lua
local result = app.integrations["elastic-email"].get_current_user({})

print("Account: " .. result.email)
print("Plan: " .. (result.plan or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Elastic Email accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["elastic-email"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["elastic-email"].default.function_name({...})

-- Named accounts
app.integrations["elastic-email"].marketing.function_name({...})
app.integrations["elastic-email"].transactional.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
