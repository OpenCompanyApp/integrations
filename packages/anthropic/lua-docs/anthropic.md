# Anthropic (Claude) — Lua API Reference

## list_messages

List messages in the Anthropic conversation history.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | no | Filter messages by model ID (e.g., "claude-sonnet-4-20250514") |
| `limit` | integer | no | Max messages per page (default: 20, max: 1000) |
| `before_id` | string | no | Return messages before this message ID |
| `after_id` | string | no | Return messages after this message ID |

### Example

```lua
local result = app.integrations["anthropic"].list_messages({
  limit = 10
})

for _, msg in ipairs(result.data) do
  print(msg.id .. " — " .. msg.model .. " — " .. msg.role)
end
```

---

## create_message

Send a prompt to Claude and receive an AI-generated response.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | The model to use (e.g., "claude-sonnet-4-20250514") |
| `messages` | array | yes | Array of message objects with `role` and `content` |
| `max_tokens` | integer | no | Maximum tokens to generate (default: 4096) |
| `system` | string | no | System prompt to set behavior and context |
| `temperature` | number | no | Randomness control (0.0–1.0) |
| `top_p` | number | no | Nucleus sampling parameter (0.0–1.0) |
| `stop_sequences` | array | no | Strings that stop generation when encountered |
| `stream` | boolean | no | Stream response incrementally (default: false) |

### Message Format

The `messages` array contains message objects:

```lua
{
  { role = "user", content = "Your prompt here" }
}
```

For multi-turn conversations:

```lua
{
  { role = "user", content = "Hello!" },
  { role = "assistant", content = "Hi there!" },
  { role = "user", content = "Tell me more." }
}
```

### Example

```lua
local result = app.integrations["anthropic"].create_message({
  model = "claude-sonnet-4-20250514",
  messages = {
    { role = "user", content = "Write a haiku about programming." }
  },
  max_tokens = 100,
  temperature = 0.7
})

for _, block in ipairs(result.content) do
  if block.type == "text" then
    print(block.text)
  end
end

print("Stop reason: " .. result.stop_reason)
print("Usage input: " .. result.usage.input_tokens .. ", output: " .. result.usage.output_tokens)
```

---

## list_models

List available Anthropic AI models.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max models per page (default: 20, max: 1000) |
| `before_id` | string | no | Return models before this ID |
| `after_id` | string | no | Return models after this ID |

### Example

```lua
local result = app.integrations["anthropic"].list_models({
  limit = 10
})

for _, model in ipairs(result.data) do
  print(model.id .. " — " .. model.display_name)
end
```

---

## get_model

Get detailed information about a specific Anthropic model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Model identifier, e.g. `"claude-sonnet-4-20250514"` |

### Example

```lua
local result = app.integrations["anthropic"].get_model({
  id = "claude-sonnet-4-20250514"
})

print("Model: " .. result.display_name)
print("Created: " .. result.created_at)
```

---

## list_workspaces

List Anthropic workspaces.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max workspaces per page (default: 20, max: 1000) |
| `before_id` | string | no | Return workspaces before this ID |
| `after_id` | string | no | Return workspaces after this ID |

### Example

```lua
local result = app.integrations["anthropic"].list_workspaces({
  limit = 10
})

for _, ws in ipairs(result.data) do
  print(ws.id .. " — " .. ws.name)
end
```

---

## get_workspace

Get details for a specific Anthropic workspace.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The workspace identifier |

### Example

```lua
local result = app.integrations["anthropic"].get_workspace({
  id = "wrksp_01ABC123"
})

print("Workspace: " .. result.name)
```

---

## get_current_user

Get the authenticated user's profile and account information.

### Parameters

None.

### Example

```lua
local result = app.integrations["anthropic"].get_current_user({})

print("User: " .. (result.name or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Anthropic accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["anthropic"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["anthropic"].default.function_name({...})

-- Named accounts
app.integrations["anthropic"].work.function_name({...})
app.integrations["anthropic"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
