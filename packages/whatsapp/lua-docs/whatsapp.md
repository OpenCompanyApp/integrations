# WhatsApp Business — Lua API Reference

## send_message

Send a text message to a WhatsApp recipient. Use this for replying within an existing 24-hour customer service window. For new conversations, use `send_template` instead.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient phone number in international format without + (e.g. `"15551234567"`) |
| `body` | string | yes | Text content of the message (max 4096 characters) |
| `preview_url` | boolean | no | Whether to render URLs as link previews (default: `false`) |

### Examples

```lua
-- Send a simple text message
local result = app.integrations.whatsapp.send_message({
  to = "15551234567",
  body = "Hello! Your order has been shipped."
})

print("Message ID: " .. result.messages[1].id)
```

```lua
-- Send with link preview
local result = app.integrations.whatsapp.send_message({
  to = "15551234567",
  body = "Check out our docs: https://example.com/docs",
  preview_url = true
})
```

---

## get_message

Retrieve a specific WhatsApp message by its ID. Returns the message content, status (sent, delivered, read), and timestamps.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `message_id` | string | yes | The WhatsApp message ID (e.g. `"wamid.HBgM..."`) |

### Examples

```lua
local result = app.integrations.whatsapp.get_message({
  message_id = "wamid.HBgM..."
})

print("Status: " .. result.messages[1].message_status)
```

---

## list_templates

List approved WhatsApp message templates. Templates are required to initiate new conversations outside the 24-hour service window.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of templates to return (default: 100) |
| `after` | string | no | Cursor for pagination — pass the value from a previous response to get the next page |

### Examples

```lua
local result = app.integrations.whatsapp.list_templates({
  limit = 50
})

for _, tmpl in ipairs(result.data) do
  print(tmpl.name .. " (" .. tmpl.status .. ")")
end
```

```lua
-- Paginate through templates
local page = app.integrations.whatsapp.list_templates({ limit = 10 })
local cursor = page.paging and page.paging.cursors and page.paging.cursors.after or nil

if cursor then
  local next_page = app.integrations.whatsapp.list_templates({ limit = 10, after = cursor })
end
```

---

## list_contacts

List WhatsApp contacts for the business phone number. Returns WhatsApp IDs and profile names.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of contacts to return (default: 100) |
| `after` | string | no | Cursor for pagination — pass the value from a previous response to get the next page |

### Examples

```lua
local result = app.integrations.whatsapp.list_contacts({})

for _, contact in ipairs(result.data) do
  print(contact.wa_id .. ": " .. (contact.profile_name or "Unknown"))
end
```

---

## send_template

Send a template-based WhatsApp message. Use this to initiate new conversations outside the 24-hour window. The template must be pre-approved in the WhatsApp Business Manager.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `to` | string | yes | Recipient phone number in international format without + |
| `template_name` | string | yes | Name of the approved template (e.g. `"hello_world"`) |
| `language` | string | no | Language code (e.g. `"en_US"`, `"en"`). Defaults to `"en"` |
| `components` | array | no | Template components — array of objects with `type` and parameters |

### Component Structure

```json
[
  {
    "type": "body",
    "parameters": [
      { "type": "text", "text": "John" }
    ]
  }
]
```

### Examples

```lua
-- Send the built-in hello_world template
local result = app.integrations.whatsapp.send_template({
  to = "15551234567",
  template_name = "hello_world",
  language = "en_US"
})

print("Message ID: " .. result.messages[1].id)
```

```lua
-- Send a template with dynamic body parameters
local result = app.integrations.whatsapp.send_template({
  to = "15551234567",
  template_name = "order_update",
  language = "en",
  components = {
    {
      type = "body",
      parameters = {
        { type = "text", text = "Order #12345" },
        { type = "text", text = "shipped" }
      }
    }
  }
})
```

---

## get_current_user

Get the authenticated WhatsApp Business user info — name, email, and business ID. Useful for verifying which account is connected.

### Parameters

None.

### Examples

```lua
local result = app.integrations.whatsapp.get_current_user({})

print("Connected as: " .. result.name .. " (ID: " .. result.id .. ")")
```

---

## Multi-Account Usage

If you have multiple WhatsApp accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.whatsapp.send_message({ to = "15551234567", body = "Hello" })

-- Explicit default (portable across setups)
app.integrations.whatsapp.default.send_message({ to = "15551234567", body = "Hello" })

-- Named accounts
app.integrations.whatsapp.support.send_message({ to = "15551234567", body = "Hello" })
app.integrations.whatsapp.sales.send_template({ to = "15551234567", template_name = "hello_world" })
```

All functions are identical across accounts — only the credentials differ.
