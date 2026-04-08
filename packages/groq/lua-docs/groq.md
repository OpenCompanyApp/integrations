# Groq — Lua API Reference

## list_models

List available Groq AI models.

### Parameters

None.

### Example

```lua
local result = app.integrations["groq"].list_models({})

for _, model in ipairs(result.data) do
  print(model.id)
end
```

---

## create_completion

Create a chat completion using a Groq model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Model ID, e.g. `"llama-3.3-70b-versatile"` |
| `messages` | array | yes | Array of message objects with `role` and `content` |
| `temperature` | number | no | Randomness control (0.0–2.0) |
| `max_tokens` | integer | no | Max tokens in the response |
| `top_p` | number | no | Nucleus sampling (0.0–1.0) |
| `stream` | boolean | no | Stream the response (default: false) |

### Message Format

The `messages` array contains message objects:

```lua
{
  { role = "system", content = "You are a helpful assistant." },
  { role = "user", content = "Hello!" }
}
```

For multi-turn conversations:

```lua
{
  { role = "system", content = "You are a helpful assistant." },
  { role = "user", content = "Hello!" },
  { role = "assistant", content = "Hi there!" },
  { role = "user", content = "Tell me more." }
}
```

### Example

```lua
local result = app.integrations["groq"].create_completion({
  model = "llama-3.3-70b-versatile",
  messages = {
    { role = "system", content = "You are a helpful assistant." },
    { role = "user", content = "Write a haiku about programming." }
  },
  temperature = 0.7,
  max_tokens = 100
})

for _, choice in ipairs(result.choices) do
  print(choice.message.content)
end
```

---

## list_messages

List messages in a Groq Cloud conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | The conversation ID |
| `limit` | integer | no | Max messages per page (default: 20) |
| `after` | string | no | Cursor for pagination |

### Example

```lua
local result = app.integrations["groq"].list_messages({
  conversation_id = "conv_abc123",
  limit = 10
})

for _, msg in ipairs(result.data) do
  print(msg.role .. ": " .. msg.content)
end
```

---

## create_message

Create a message in a Groq Cloud conversation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `conversation_id` | string | yes | The conversation ID |
| `role` | string | yes | Message role (e.g., `"user"`, `"assistant"`) |
| `content` | string | yes | The message text |

### Example

```lua
local result = app.integrations["groq"].create_message({
  conversation_id = "conv_abc123",
  role = "user",
  content = "What is the capital of France?"
})

print(result.id)
print(result.role .. ": " .. result.content)
```

---

## list_files

List files uploaded to the Groq Files API.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `purpose` | string | no | Filter by purpose (e.g., `"batch"`) |
| `limit` | integer | no | Max files per page (default: 20) |
| `after` | string | no | Cursor for pagination |

### Example

```lua
local result = app.integrations["groq"].list_files({
  limit = 10
})

for _, file in ipairs(result.data) do
  print(file.id .. " — " .. file.filename .. " (" .. file.bytes .. " bytes)")
end
```

---

## get_file

Get metadata for an uploaded file.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `file_id` | string | yes | The file identifier, e.g. `"file-abc123"` |

### Example

```lua
local result = app.integrations["groq"].get_file({
  file_id = "file-abc123"
})

print("File: " .. result.filename)
print("Purpose: " .. result.purpose)
print("Size: " .. result.bytes .. " bytes")
print("Status: " .. result.status)
```

---

## get_current_user

Get information about the currently authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations["groq"].get_current_user({})

print("User: " .. (result.id or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Groq accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["groq"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["groq"].default.function_name({...})

-- Named accounts
app.integrations["groq"].work.function_name({...})
app.integrations["groq"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
