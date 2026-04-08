# MessageBird — Lua API Reference

## send_sms

Send an SMS message to one or more recipients.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `originator` | string | yes | Sender name or phone number (e.g., `"OpenCompany"` or `"+3197012345678"`). Max 11 chars for alphanumeric. |
| `recipients` | array | yes | Array of phone numbers in international format, e.g., `{"+31612345678", "+447912345678"}` |
| `body` | string | yes | SMS text. Max 160 chars for a single message; longer messages are concatenated. |

### Example

```lua
local result = app.integrations.messagebird.send_sms({
  originator = "OpenCompany",
  recipients = {"+31612345678"},
  body = "Hello from MessageBird!"
})

print("Message ID: " .. result.id)
print("Status: " .. result.status)
```

---

## get_message

Retrieve details of a specific message by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The message ID (e.g., `"a6e89f50c0d25b35a212345678901234"`) |

### Example

```lua
local result = app.integrations.messagebird.get_message({
  id = "a6e89f50c0d25b35a212345678901234"
})

print("Status: " .. result.status)
print("Body: " .. result.body)
```

---

## list_messages

List sent and received messages with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 20, max: 1000) |
| `offset` | integer | no | Pagination offset (default: 0) |
| `status` | string | no | Filter: `scheduled`, `sent`, `buffered`, `delivered`, `expired`, `delivery_failed` |
| `direction` | string | no | Filter: `mt` (outgoing), `mo` (incoming) |

### Example

```lua
local result = app.integrations.messagebird.list_messages({
  limit = 10,
  status = "delivered"
})

for _, msg in ipairs(result.items) do
  print(msg.id .. " -> " .. msg.status)
end
```

---

## list_balance

Check your MessageBird account balance.

### Parameters

None.

### Example

```lua
local result = app.integrations.messagebird.list_balance({})

print("Balance: " .. result.amount .. " " .. result.type)
```

---

## list_numbers

List purchased phone numbers with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max results (default: 20) |
| `offset` | integer | no | Pagination offset (default: 0) |
| `country_code` | string | no | ISO 3166-1 alpha-2 country code (e.g., `"NL"`, `"US"`) |
| `number_type` | string | no | Filter: `mobile`, `landline` |

### Example

```lua
local result = app.integrations.messagebird.list_numbers({
  country_code = "NL",
  number_type = "mobile"
})

for _, num in ipairs(result.items) do
  print(num.number .. " (" .. num.country .. ")")
end
```

---

## get_current_user

Get current account information and balance.

### Parameters

None.

### Example

```lua
local result = app.integrations.messagebird.get_current_user({})

print("Balance: " .. result.amount)
print("Payment type: " .. result.type)
```

---

## Multi-Account Usage

If you have multiple MessageBird accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.messagebird.function_name({...})

-- Explicit default (portable across setups)
app.integrations.messagebird.default.function_name({...})

-- Named accounts
app.integrations.messagebird.work.function_name({...})
app.integrations.messagebird.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
