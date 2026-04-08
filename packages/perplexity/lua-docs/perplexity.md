# Perplexity AI — Lua API Reference

## chat

Send messages to Perplexity AI for a chat completion response. Supports multi-turn conversations with message history.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `messages` | array | yes | Array of message objects with "role" and "content". |
| `model` | string | no | Model to use: "sonar", "sonar-pro", "sonar-reasoning", "sonar-reasoning-pro" (default: "sonar") |
| `temperature` | number | no | Sampling temperature 0.0–2.0 (default: 0.2) |
| `max_tokens` | integer | no | Maximum tokens in the response |
| `search_domain_filter` | array | no | Domains to limit search to (e.g., `{"wikipedia.org"}`) |
| `return_images` | boolean | no | Return images in response (default: false) |
| `return_related_questions` | boolean | no | Return related questions (default: false) |
| `search_recency_filter` | string | no | Filter by recency: "month", "week", "day", "hour" |

### Message Roles

| Role | Description |
|------|-------------|
| `system` | Set the assistant's behavior and instructions |
| `user` | The user's message or question |
| `assistant` | Previous assistant responses (for multi-turn) |

### Available Models

| Model | Description |
|-------|-------------|
| `sonar` | Fast, lightweight search-grounded responses |
| `sonar-pro` | Advanced model with deeper search and reasoning |
| `sonar-reasoning` | Reasoning-focused model |
| `sonar-reasoning-pro` | Advanced reasoning with comprehensive search |

### Examples

#### Simple question

```lua
local result = app.integrations.perplexity.chat({
  messages = {
    { role = "user", content = "What is quantum computing?" }
  }
})

print(result.content)
-- Citations are available in result.citations
for i, url in ipairs(result.citations or {}) do
  print("Source: " .. url)
end
```

#### Multi-turn conversation

```lua
local result = app.integrations.perplexity.chat({
  messages = {
    { role = "system", content = "You are a helpful science tutor." },
    { role = "user", content = "Explain photosynthesis." },
    { role = "assistant", content = "Photosynthesis is the process..." },
    { role = "user", content = "What are the main factors affecting its rate?" }
  },
  model = "sonar-pro",
  temperature = 0.3
})

print(result.content)
```

#### Domain-filtered search

```lua
local result = app.integrations.perplexity.chat({
  messages = {
    { role = "user", content = "What is the latest PHP version?" }
  },
  search_domain_filter = { "php.net" },
  search_recency_filter = "month"
})

print(result.content)
```

---

## ask

Ask Perplexity AI a question and get a concise answer with cited sources. Best for factual queries, research, and knowledge questions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `query` | string | yes | The question or prompt to ask |
| `model` | string | no | Model to use (default: "sonar") |
| `temperature` | number | no | Sampling temperature 0.0–2.0 (default: 0.2) |
| `max_tokens` | integer | no | Maximum tokens in the response |
| `search_domain_filter` | array | no | Domains to limit search to |
| `return_images` | boolean | no | Return images in response (default: false) |
| `return_related_questions` | boolean | no | Return related questions (default: false) |
| `search_recency_filter` | string | no | Filter by recency: "month", "week", "day", "hour" |

### Examples

#### Simple question

```lua
local result = app.integrations.perplexity.ask({
  query = "What is the population of Tokyo?"
})

print(result.answer)
```

#### With options

```lua
local result = app.integrations.perplexity.ask({
  query = "Latest news about space exploration",
  model = "sonar-pro",
  search_recency_filter = "week",
  return_related_questions = true
})

print(result.answer)

if result.related_questions then
  for _, q in ipairs(result.related_questions) do
    print("Related: " .. q)
  end
end
```

---

## list_models

List all available Perplexity AI models.

### Parameters

None.

### Example

```lua
local result = app.integrations.perplexity.list_models({})

for _, model in ipairs(result.data or {}) do
  print(model.id .. " — " .. (model.description or ""))
end
```

---

## get_current_user

Get information about the currently authenticated Perplexity API user.

### Parameters

None.

### Example

```lua
local result = app.integrations.perplexity.get_current_user({})

print("User: " .. (result.email or "unknown"))
print("Plan: " .. (result.plan or "unknown"))
```

---

## Multi-Account Usage

If you have multiple Perplexity accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.perplexity.chat({...})

-- Explicit default (portable across setups)
app.integrations.perplexity.default.chat({...})

-- Named accounts
app.integrations.perplexity.work.chat({...})
app.integrations.perplexity.personal.chat({...})
```

All functions are identical across accounts — only the credentials differ.
