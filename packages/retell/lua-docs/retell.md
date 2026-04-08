# Retell AI — Lua API Reference

## list_calls

List AI voice calls with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of calls to return |
| `filter_criteria` | object | no | Filter criteria (e.g., `{"agent_id": "agent_123"}`) |
| `before` | string | no | Return calls created before this timestamp (cursor pagination) |
| `after` | string | no | Return calls created after this timestamp (cursor pagination) |

### Examples

```lua
-- List recent calls
local result = app.integrations.retell.list_calls({
  limit = 10
})

for _, call in ipairs(result.calls or {}) do
  print(call.call_id .. ": " .. call.call_status)
end

-- Filter by agent
local result = app.integrations.retell.list_calls({
  limit = 5,
  filter_criteria = { agent_id = "agent_abcdef123456" }
})
```

---

## get_call

Get detailed information about a specific call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique call identifier |

### Example

```lua
local result = app.integrations.retell.get_call({
  call_id = "call_abcdef123456"
})

print("Status: " .. result.call_status)
print("Duration: " .. (result.start_timestamp and result.end_timestamp and (result.end_timestamp - result.start_timestamp) or "N/A"))
```

---

## create_phone_call

Initiate a new AI-powered phone call.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `agent_id` | string | yes | The agent to use for the call |
| `metadata` | object | no | Custom metadata to attach to the call |
| `retell_llm_dynamic_variables` | object | no | Dynamic variables injected into the agent's LLM prompt |

### Example

```lua
local result = app.integrations.retell.create_phone_call({
  agent_id = "agent_abcdef123456",
  metadata = {
    customer_name = "Acme Corp",
    call_purpose = "follow-up"
  },
  retell_llm_dynamic_variables = {
    customer_name = "John",
    account_type = "premium"
  }
})

print("Call created: " .. result.call_id)
```

---

## list_agents

List all AI voice agents.

### Parameters

None.

### Example

```lua
local result = app.integrations.retell.list_agents()

for _, agent in ipairs(result.agents or {}) do
  print(agent.agent_id .. ": " .. (agent.name or "Unnamed"))
end
```

---

## get_agent

Get detailed information about a specific agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `agent_id` | string | yes | The unique agent identifier |

### Example

```lua
local result = app.integrations.retell.get_agent({
  agent_id = "agent_abcdef123456"
})

print("Agent: " .. (result.name or "Unnamed"))
print("Model: " .. (result.model or "N/A"))
print("Voice: " .. (result.voice_id or "N/A"))
```

---

## create_agent

Create a new AI voice agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `model` | string | no | LLM model (e.g., `"gpt-4o"`, `"gpt-4o-mini"`) |
| `voice_id` | string | no | Voice ID for the agent |
| `prompt` | string | no | System prompt defining agent behavior |
| `response_engine` | object | no | Response engine configuration |

### Example

```lua
local result = app.integrations.retell.create_agent({
  model = "gpt-4o",
  voice_id = "11labs-Adrian",
  prompt = "You are a helpful customer support agent for Acme Corp. Be friendly and concise.",
  response_engine = {
    type = "retell-llm"
  }
})

print("Agent created: " .. result.agent_id)
```

---

## get_current_user

Get the currently authenticated Retell AI user.

### Parameters

None.

### Example

```lua
local result = app.integrations.retell.get_current_user()

print("User: " .. (result.email or result.name or "Unknown"))
```

---

## Multi-Account Usage

If you have multiple Retell AI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.retell.list_calls({})

-- Explicit default (portable across setups)
app.integrations.retell.default.list_calls({})

-- Named accounts
app.integrations.retell.production.list_calls({})
app.integrations.retell.staging.list_agents({})
```

All functions are identical across accounts — only the credentials differ.
