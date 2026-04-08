# Retell AI — Lua API Reference

## create_call

Create a new AI-powered phone call using a Retell AI voice agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `agent_id` | string | yes | The Retell AI agent ID to use (e.g., `"agent_17a9b81c3c0"`) |
| `metadata` | table | no | Key-value metadata to attach to the call for tracking and context |

### Example

```lua
local result = app.integrations["retell-ai"].create_call({
  agent_id = "agent_17a9b81c3c0",
  metadata = {
    customer_id = "12345",
    campaign = "onboarding",
  }
})

print("Call created: " .. result.call_id)
print("Status: " .. result.status)
```

---

## get_call

Retrieve details for a specific phone call by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `call_id` | string | yes | The unique identifier of the call to retrieve |

### Example

```lua
local result = app.integrations["retell-ai"].get_call({
  call_id = "call_17a9b81c3c0"
})

print("Status: " .. result.call_status)
print("Duration: " .. tostring(result.start_ts) .. " - " .. tostring(result.end_ts))
if result.transcript then
  print("Transcript: " .. result.transcript)
end
```

---

## list_calls

List phone calls with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `filter` | table | no | Optional filters (agent_id, status, start_timestamp, end_timestamp, etc.) |

### Example

```lua
-- List all calls
local result = app.integrations["retell-ai"].list_calls({})

for _, call in ipairs(result.calls or {}) do
  print(call.call_id .. ": " .. call.call_status)
end

-- Filter by agent
local result = app.integrations["retell-ai"].list_calls({
  filter = {
    agent_id = "agent_17a9b81c3c0"
  }
})
```

---

## list_agents

List all configured voice agents in your Retell AI account.

### Parameters

None.

### Example

```lua
local result = app.integrations["retell-ai"].list_agents({})

for _, agent in ipairs(result.agents or result or {}) do
  print(agent.agent_id .. ": " .. (agent.agent_name or "Unnamed"))
  print("  Voice: " .. (agent.voice_id or "default"))
end
```

---

## create_agent

Create a new voice AI agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `voice_id` | string | yes | The voice ID to assign (e.g., `"11labs_Alice"`) |
| `prompt` | string | yes | System prompt defining the agent's behavior and personality |
| `options` | table | no | Additional configuration (agent_name, language, ambient_noise, etc.) |

### Example

```lua
local result = app.integrations["retell-ai"].create_agent({
  voice_id = "11labs_Alice",
  prompt = "You are a helpful customer support agent. Be friendly and concise. Help customers with their account questions.",
  options = {
    agent_name = "Support Agent",
    language = "en",
  }
})

print("Agent created: " .. result.agent_id)
```

---

## get_current_user

Retrieve current Retell AI account information.

### Parameters

None.

### Example

```lua
local result = app.integrations["retell-ai"].get_current_user({})

-- Returns agent list and account info
print("Account connected successfully")
```

---

## Multi-Account Usage

If you have multiple Retell AI accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["retell-ai"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["retell-ai"].default.function_name({...})

-- Named accounts
app.integrations["retell-ai"].production.function_name({...})
app.integrations["retell-ai"].staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
