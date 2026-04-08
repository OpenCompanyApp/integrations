# BlandAI — Lua API Reference

## make_call

Initiate an AI-powered phone call via BlandAI.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `phone_number` | string | yes | Phone number in E.164 format, e.g. `"+1234567890"` |
| `task` | string | yes | Instructions for the AI agent to follow during the call |
| `voice` | string | no | Voice identifier to use (leave empty for default) |
| `wait_for_greeting` | boolean | no | Wait for callee to speak first (default: false) |
| `record` | boolean | no | Record the call (default: true) |
| `max_duration` | integer | no | Maximum call duration in minutes |

### Example

```lua
local result = app.integrations.blandai.make_call({
  phone_number = "+1234567890",
  task = "Ask the customer if they are satisfied with their recent purchase and collect feedback.",
  voice = "josh"
})

print("Call ID: " .. result.call_id)
print("Status: " .. result.status)
```

---

## get_call

Retrieve details for a specific call, including transcript, status, and metadata.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique identifier of the call |

### Example

```lua
local result = app.integrations.blandai.get_call({
  call_id = "abc123-def456-ghi789"
})

print("Status: " .. result.status)
print("Duration: " .. tostring(result.call_length) .. " seconds")
print("Transcript: " .. result.transcript)
```

---

## list_calls

List phone calls with optional pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of calls to return (default: 50) |
| `offset` | integer | no | Number of calls to skip for pagination (default: 0) |

### Example

```lua
local result = app.integrations.blandai.list_calls({
  limit = 10,
  offset = 0
})

for _, call in ipairs(result.calls or {}) do
  print(call.call_id .. ": " .. call.status .. " (" .. call.to .. ")")
end
```

---

## analyze_call

Analyze a call transcript with a custom prompt to extract insights or evaluate outcomes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique identifier of the call to analyze |
| `prompt` | string | yes | Analysis prompt (e.g. "Summarize the key points discussed") |

### Example

```lua
local result = app.integrations.blandai.analyze_call({
  call_id = "abc123-def456-ghi789",
  prompt = "Was the customer satisfied? Extract key concerns and any action items mentioned."
})

print("Analysis: " .. tostring(result.analysis or result.answer))
```

### More prompt examples

```lua
-- Sentiment analysis
analyze_call({ call_id = "...", prompt = "Rate the customer's sentiment from 1-10 with a brief explanation." })

-- Action item extraction
analyze_call({ call_id = "...", prompt = "List all action items and follow-ups mentioned during the call." })

-- Data extraction
analyze_call({ call_id = "...", prompt = "Extract the customer's name, email, and phone number from the conversation." })
```

---

## get_current_user

Get the authenticated user's account information.

### Parameters

None.

### Example

```lua
local result = app.integrations.blandai.get_current_user({})

print("Account: " .. tostring(result.email or result.name))
```

---

## Multi-Account Usage

If you have multiple BlandAI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.blandai.make_call({...})

-- Explicit default (portable across setups)
app.integrations.blandai.default.make_call({...})

-- Named accounts
app.integrations.blandai.production.make_call({...})
app.integrations.blandai.staging.make_call({...})
```

All functions are identical across accounts — only the credentials differ.
