# Brevo — Lua API Reference

## list_contacts

List contacts in your Brevo account with optional search and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 50, max: 1000) |
| `offset` | integer | no | Number of contacts to skip for pagination (default: 0) |
| `search` | string | no | Search term to filter contacts by email or attributes |

### Example

```lua
local result = app.integrations.brevo.list_contacts({
  limit = 10,
  offset = 0,
  search = "john"
})

for _, contact in ipairs(result.contacts) do
  print(contact.email)
end
```

---

## get_contact

Get details of a specific contact by email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address of the contact to retrieve |

### Example

```lua
local result = app.integrations.brevo.get_contact({
  email = "john@example.com"
})

print(result.email)
print(result.attributes.FIRSTNAME)
```

---

## create_contact

Create a new contact in Brevo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | The email address for the new contact |
| `attributes` | object | no | Contact attributes, e.g. `{"FIRSTNAME": "John", "LASTNAME": "Doe"}` |
| `listIds` | array | no | Array of list IDs (integers) to add the contact to, e.g. `{2, 5}` |

### Example

```lua
local result = app.integrations.brevo.create_contact({
  email = "jane@example.com",
  attributes = {
    FIRSTNAME = "Jane",
    LASTNAME = "Doe"
  },
  listIds = {2, 5}
})

print("Created contact with ID: " .. result.id)
```

---

## list_lists

List all contact lists in your Brevo account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of lists to return (default: 50, max: 1000) |
| `offset` | integer | no | Number of lists to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.brevo.list_lists({
  limit = 20,
  offset = 0
})

for _, list in ipairs(result.lists) do
  print(list.id .. ": " .. list.name .. " (" .. list.totalSubscribers .. " subscribers)")
end
```

---

## get_list

Get details of a specific contact list by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The ID of the contact list to retrieve |

### Example

```lua
local result = app.integrations.brevo.get_list({
  id = 2
})

print(result.name .. ": " .. result.totalSubscribers .. " subscribers")
```

---

## send_email

Send a transactional email via Brevo.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `sender` | object | yes | Sender with `name` and `email` keys |
| `to` | array | yes | Array of recipient objects, each with `email` and optionally `name` |
| `subject` | string | yes | The email subject line |
| `htmlContent` | string | no | HTML body of the email (required unless `textContent` provided) |
| `textContent` | string | no | Plain text body of the email (required unless `htmlContent` provided) |

### Example

```lua
local result = app.integrations.brevo.send_email({
  sender = {
    name = "My App",
    email = "noreply@example.com"
  },
  to = {
    { email = "user@example.com", name = "John" }
  },
  subject = "Welcome!",
  htmlContent = "<h1>Hello!</h1><p>Welcome to our service.</p>",
  textContent = "Hello! Welcome to our service."
})

print("Message ID: " .. result.messageId)
```

---

## get_account

Get information about the connected Brevo account.

### Parameters

None.

### Example

```lua
local result = app.integrations.brevo.get_account()

print("Account email: " .. result.email)
print("Plan: " .. result.plan.type)
```

---

## Multi-Account Usage

If you have multiple Brevo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.brevo.function_name({...})

-- Explicit default (portable across setups)
app.integrations.brevo.default.function_name({...})

-- Named accounts
app.integrations.brevo.work.function_name({...})
app.integrations.brevo.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
