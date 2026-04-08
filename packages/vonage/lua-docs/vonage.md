# Vonage — Lua API Reference

## send_sms

Send an SMS message via Vonage. Provide sender, recipient, and message text. The recipient number must be in E.164 format.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `from` | string | yes | Sender ID or phone number (e.g. `"VonageAPI"` or a purchased number). |
| `to` | string | yes | Recipient phone number in E.164 format (e.g. `"14155552671"`). |
| `text` | string | yes | The SMS message body text. |
| `type` | string | no | Message type: `"text"` (default), `"unicode"`, or `"binary"`. |

### Examples

```lua
local result = app.integrations.vonage.send_sms({
  from = "VonageAPI",
  to = "14155552671",
  text = "Hello from Vonage!"
})

print("Sent " .. result.message_count .. " message(s)")
for _, msg in ipairs(result.messages) do
  print("  To: " .. msg.to .. " — ID: " .. msg.message_id)
end
```

---

## list_messages

Search and list SMS messages from your Vonage account. Requires a date in YYYY-MM-DD format.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | Date to search messages for, in YYYY-MM-DD format (e.g. `"2025-01-15"`). |
| `to` | string | no | Recipient phone number to filter by (E.164 format). |

### Examples

```lua
local result = app.integrations.vonage.list_messages({
  date = "2025-06-15"
})

for _, msg in ipairs(result.messages or {}) do
  print(msg.message_id .. ": " .. (msg.status or "unknown"))
end
```

```lua
-- Filter by recipient
local result = app.integrations.vonage.list_messages({
  date = "2025-06-15",
  to = "14155552671"
})
```

---

## list_sms

Search and list SMS messages from your Vonage account. Alias for list_messages with the same parameters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `date` | string | yes | Date to search in ISO format (YYYY-MM-DD, e.g. `"2025-01-15"`). |
| `to` | string | no | Filter by recipient phone number in E.164 format. |

### Examples

```lua
local result = app.integrations.vonage.list_sms({
  date = "2025-06-01"
})
```

---

## list_numbers

List phone numbers purchased on your Vonage account. Optionally filter by pattern.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `pattern` | string | no | A pattern to search for in the phone numbers. |
| `search_pattern` | integer | no | How to match the pattern: `0` = starts with, `1` = contains, `2` = ends with. |
| `size` | integer | no | Number of results per page (default: 10). |
| `index` | integer | no | Page index for pagination (1-based). |

### Examples

```lua
local result = app.integrations.vonage.list_numbers()

for _, num in ipairs(result.numbers or {}) do
  print(num.msisdn .. " (" .. num.country .. ")")
end
```

```lua
-- Find US numbers containing "555"
local result = app.integrations.vonage.list_numbers({
  pattern = "555",
  search_pattern = 1
})
```

---

## get_account_balance

Get the current balance of your Vonage account.

### Parameters

None.

### Examples

```lua
local result = app.integrations.vonage.get_account_balance()

print("Balance: " .. result.value .. " " .. (result.currency or ""))
print("Auto-reload: " .. tostring(result.auto_reload))
```

---

## list_applications

List Vonage applications configured on your account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of applications per page (default: 10). |
| `page` | integer | no | Page number for pagination (1-based). |

### Examples

```lua
local result = app.integrations.vonage.list_applications()

for _, app in ipairs(result._embedded.applications or {}) do
  print(app.name .. " — " .. app.id)
end
```

---

## verify_request

Send a verification code to a phone number via Vonage Verify. Returns a request_id used to check the code later.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `number` | string | yes | Phone number to verify in E.164 format (e.g. `"14155552671"`). |
| `brand` | string | yes | The name shown in the verification message (e.g. `"MyApp"`). |

### Examples

```lua
local result = app.integrations.vonage.verify_request({
  number = "14155552671",
  brand = "MyApp"
})

print("Request ID: " .. result.request_id)
-- Store request_id for use with verify_check
```

---

## verify_check

Check a verification code against a Vonage Verify request.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `request_id` | string | yes | The request_id returned by the verify request. |
| `code` | string | yes | The verification code entered by the user. |

### Examples

```lua
local result = app.integrations.vonage.verify_check({
  request_id = "abc123-request-id",
  code = "4821"
})

if result.status == "0" then
  print("Verification successful!")
else
  print("Verification failed")
end
```

---

## Multi-Account Usage

If you have multiple vonage accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vonage.function_name({...})

-- Explicit default (portable across setups)
app.integrations.vonage.default.function_name({...})

-- Named accounts
app.integrations.vonage.us.function_name({...})
app.integrations.vonage.eu.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
