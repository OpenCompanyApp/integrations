# MistralAI — Lua API Reference

## chat

Generate a chat completion using a MistralAI model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Model ID (e.g., `"mistral-large-latest"`, `"mistral-small-latest"`, `"open-mistral-nemo"`) |
| `messages` | array | yes | Array of message objects with `role` and `content` |
| `temperature` | number | no | Sampling temperature 0.0–1.0 (default: 0.7) |
| `max_tokens` | integer | no | Maximum tokens to generate |

### Message Roles

- `"system"` — Set the assistant's behavior and personality
- `"user"` — User input
- `"assistant"` — Previous assistant responses (for multi-turn)

### Examples

#### Single-turn chat

```lua
local result = app.integrations.mistralai.chat({
  model = "mistral-large-latest",
  messages = {
    { role = "user", content = "Explain quantum computing in one paragraph." }
  },
  temperature = 0.7
})

for _, choice in ipairs(result.choices) do
  print(choice.content)
end
```

#### Multi-turn conversation

```lua
local result = app.integrations.mistralai.chat({
  model = "mistral-small-latest",
  messages = {
    { role = "system", content = "You are a helpful coding assistant." },
    { role = "user", content = "Write a Python function to reverse a string." },
    { role = "assistant", content = "Here's a simple way..." },
    { role = "user", content = "Can you make it handle Unicode?" }
  }
})
```

---

## create_embedding

Generate text embeddings for semantic search, similarity, or clustering.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Embedding model (e.g., `"mistral-embed"`) |
| `input` | string | yes | Text to embed, or JSON array of strings for batch |

### Examples

#### Single text embedding

```lua
local result = app.integrations.mistralai.create_embedding({
  model = "mistral-embed",
  input = "The quick brown fox jumps over the lazy dog"
})

print("Embedding dimensions: " .. result.embeddings[1].dimensions)
```

#### Batch embeddings

```lua
local result = app.integrations.mistralai.create_embedding({
  model = "mistral-embed",
  input = '["First text", "Second text", "Third text"]'
})

print("Generated " .. result.embeddingCount .. " embeddings")
```

---

## list_models

List all models available in your MistralAI account.

### Parameters

None.

### Example

```lua
local result = app.integrations.mistralai.list_models()

for _, model in ipairs(result.models) do
  print(model.id .. " (owned by: " .. (model.owned_by or "unknown") .. ")")
end

print("Total models: " .. result.total)
```

---

## finetune

Create a fine-tuning job to train a custom model.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | yes | Base model to fine-tune (e.g., `"open-mistral-7b"`) |
| `training_files` | array | yes | Array of uploaded training file IDs |
| `hyperparameters` | string | no | JSON-encoded hyperparameters (e.g., `{"n_epochs": 3}`) |
| `suffix` | string | no | Suffix for the resulting model name |

### Example

```lua
local result = app.integrations.mistralai.finetune({
  model = "open-mistral-7b",
  training_files = { "file-abc123" },
  hyperparameters = '{"n_epochs": 3, "learning_rate": 0.0001}',
  suffix = "my-custom-model"
})

print("Job ID: " .. result.id)
print("Status: " .. result.status)
```

---

## list_agents

List all MistralAI agents in your account.

### Parameters

None.

### Example

```lua
local result = app.integrations.mistralai.list_agents()

for _, agent in ipairs(result.agents) do
  print(agent.name .. " (" .. agent.model .. ")")
end

print("Total agents: " .. result.total)
```

---

## create_agent

Create a new MistralAI agent with custom instructions.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Agent name (e.g., `"Support Bot"`) |
| `model` | string | yes | Model to use (e.g., `"mistral-large-latest"`) |
| `instructions` | string | yes | System instructions defining agent behavior |
| `description` | string | no | Short description of the agent's purpose |

### Example

```lua
local result = app.integrations.mistralai.create_agent({
  name = "Code Reviewer",
  model = "mistral-large-latest",
  instructions = "You are an expert code reviewer. Analyze code for bugs, performance issues, and best practices. Be concise and actionable.",
  description = "Reviews code for quality and issues"
})

print("Created agent: " .. result.name .. " (ID: " .. result.id .. ")")
```

---

## get_current_user

Get information about the authenticated MistralAI user.

### Parameters

None.

### Example

```lua
local result = app.integrations.mistralai.get_current_user()

print("User info retrieved successfully")
```

---

## Multi-Account Usage

If you have multiple MistralAI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.mistralai.chat({...})

-- Explicit default (portable across setups)
app.integrations.mistralai.default.chat({...})

-- Named accounts
app.integrations.mistralai.production.chat({...})
app.integrations.mistralai.development.chat({...})
```

All functions are identical across accounts — only the credentials differ.
