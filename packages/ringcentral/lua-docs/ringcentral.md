# RingCentral — Lua API Reference

## list_messages

List messages from the RingCentral message store. Supports filtering by type, date range, read status, and direction.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messageType` | string | no | Filter by type: `Sms`, `Fax`, `VoiceMail`, `Pager`, or `All` (default: All) |
| `dateFrom` | string | no | Start date (ISO 8601, e.g., `"2025-01-01T00:00:00Z"`) |
| `dateTo` | string | no | End date (ISO 8601, e.g., `"2025-01-31T23:59:59Z"`) |
| `direction` | string | no | `Inbound`, `Outbound`, or `All` |
| `readStatus` | string | no | `Read`, `Unread`, or `All` |
| `perPage` | integer | no | Records per page (default: 100, max: 1000) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations.ringcentral.list_messages({
  messageType = "Sms",
  dateFrom = "2025-01-01T00:00:00Z",
  perPage = 25
})

for _, msg in ipairs(result.records) do
  print(msg.from.phoneNumber .. " -> " .. msg.to[1].phoneNumber .. ": " .. msg.subject)
end
```

---

## get_message

Get detailed information about a specific message by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messageId` | string | yes | The unique message record ID |

### Example

```lua
local result = app.integrations.ringcentral.get_message({
  messageId = "1234567890"
})

print("From: " .. result.from.phoneNumber)
print("Subject: " .. result.subject)
print("Status: " .. result.readStatus)
```

---

## send_sms

Send an SMS message via RingCentral.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender phone number (must be a RingCentral number, e.g., `"+16505551234"`) |
| `to` | string | yes | Destination phone number (e.g., `"+16505559876"`) |
| `text` | string | yes | Message body (max 160 chars per segment; longer messages are concatenated) |

### Example

```lua
local result = app.integrations.ringcentral.send_sms({
  from = "+16505551234",
  to = "+16505559876",
  text = "Hello from RingCentral!"
})

print("Message sent! ID: " .. result.id)
print("Status: " .. result.messageStatus)
```

---

## list_calls

List call log records for the authenticated extension.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `dateFrom` | string | no | Start date (ISO 8601) |
| `dateTo` | string | no | End date (ISO 8601) |
| `direction` | string | no | `Inbound`, `Outbound`, or `All` |
| `type` | string | no | `Voice`, `Fax`, or `All` |
| `phoneNumber` | string | no | Filter by phone number (caller or receiver) |
| `perPage` | integer | no | Records per page (default: 100, max: 1000) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations.ringcentral.list_calls({
  dateFrom = "2025-01-01T00:00:00Z",
  dateTo = "2025-01-31T23:59:59Z",
  direction = "Inbound",
  perPage = 50
})

for _, call in ipairs(result.records) do
  print(call.from.phoneNumber .. " called " .. call.to.phoneNumber .. " (" .. call.duration .. "s)")
end
```

---

## list_contacts

List contacts from the RingCentral personal address book.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `startsWith` | string | no | Filter by name/company prefix |
| `perPage` | integer | no | Records per page (default: 100, max: 1000) |
| `page` | integer | no | Page number (default: 1) |

### Example

```lua
local result = app.integrations.ringcentral.list_contacts({
  startsWith = "John",
  perPage = 25
})

for _, contact in ipairs(result.records) do
  print(contact.firstName .. " " .. contact.lastName)
  if contact.phoneNumbers then
    for _, phone in ipairs(contact.phoneNumbers) do
      print("  " .. phone.phoneType .. ": " .. phone.phoneNumber)
    end
  end
end
```

---

## get_current_user

Get information about the currently authenticated RingCentral extension. No parameters required.

### Example

```lua
local result = app.integrations.ringcentral.get_current_user({})

print("Extension: " .. result.name)
print("Status: " .. result.status)
print("Login: " .. result.loginName)

if result.contact then
  print("Email: " .. (result.contact.email or "N/A"))
end
```

---

## Multi-Account Usage

If you have multiple RingCentral accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.ringcentral.list_messages({...})

-- Explicit default (portable across setups)
app.integrations.ringcentral.default.list_messages({...})

-- Named accounts
app.integrations.ringcentral.work.list_messages({...})
app.integrations.ringcentral.support.list_messages({...})
```

All functions are identical across accounts — only the credentials differ.
