# OpenRouter — Lua API Reference

## list_models

List available AI models on OpenRouter.

### Parameters

None.

### Example

```lua
local result = app.integrations["openrouter"].list_models({})

for _, model in ipairs(result.data) do
  print(model.id .. " — " .. model.name)
end
```

---

## create_completion

Create a chat completion using any model available on OpenRouter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | The model to use (e.g., "openai/gpt-4o", "anthropic/claude-3.5-sonnet") |
| `messages` | array | yes | Array of message objects with `role` and `content` |
| `max_tokens` | integer | no | Maximum tokens to generate |
| `temperature` | number | no | Randomness control (0.0–2.0) |
| `top_p` | number | no | Nucleus sampling parameter (0.0–1.0) |
| `stop` | array | no | Strings that stop generation when encountered |
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
  { role = "system", content = "You are a helpful assistant." },
  { role = "user", content = "Hello!" },
  { role = "assistant", content = "Hi there!" },
  { role = "user", content = "Tell me more." }
}
```

### Example

```lua
local result = app.integrations["openrouter"].create_completion({
  model = "openai/gpt-4o",
  messages = {
    { role = "user", content = "Write a haiku about programming." }
  },
  max_tokens = 100,
  temperature = 0.7
})

print(result.choices[1].message.content)
print("Model: " .. result.model)
print("Usage input: " .. result.usage.prompt_tokens .. ", output: " .. result.usage.completion_tokens)
```

---

## list_generations

List generation records from OpenRouter.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Max generations per page |
| `offset` | integer | no | Number of generations to skip |
| `order` | string | no | Sort order — "asc" or "desc" (default: "desc") |

### Example

```lua
local result = app.integrations["openrouter"].list_generations({
  limit = 10
})

for _, gen in ipairs(result.data) do
  print(gen.id .. " — " .. gen.model .. " — tokens: " .. gen.native_tokens_prompt)
end
```

---

## get_generation

Get details for a specific OpenRouter generation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The generation identifier |

### Example

```lua
local result = app.integrations["openrouter"].get_generation({
  id = "gen_01ABC123"
})

print("Model: " .. result.model)
print("Input tokens: " .. result.native_tokens_prompt)
print("Output tokens: " .. result.native_tokens_completion)
print("Cost: $" .. result.total_cost)
```

---

## list_api_keys

List API keys for the OpenRouter account.

### Parameters

None.

### Example

```lua
local result = app.integrations["openrouter"].list_api_keys({})

for _, key in ipairs(result.data) do
  print(key.name .. " — created: " .. key.created_at)
end
```

---

## get_usage

Get usage statistics for the OpenRouter account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `period` | string | no | Time period for usage data (e.g., "day", "week", "month") |

### Example

```lua
local result = app.integrations["openrouter"].get_usage({
  period = "month"
})

print("Total cost: $" .. result.total_cost)
print("Total tokens: " .. result.total_tokens)
```

---

## get_current_user

Get the authenticated user's profile and account information.

### Parameters

None.

### Example

```lua
local result = app.integrations["openrouter"].get_current_user({})

print("Label: " .. (result.data.label or "unknown"))
print("Limit: " .. (result.data.limit or "unlimited"))
print("Usage: " .. (result.data.usage or "0"))
```

---

## Multi-Account Usage

If you have multiple OpenRouter accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["openrouter"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["openrouter"].default.function_name({...})

-- Named accounts
app.integrations["openrouter"].work.function_name({...})
app.integrations["openrouter"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
