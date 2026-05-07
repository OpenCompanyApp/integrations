# Retell AI - Lua API Reference

Namespace: `app.integrations.retell_ai`

Retell uses API-root paths for agents, phone numbers, LLMs, and voices, while calls use `/v2/...` paths. This integration normalizes older `/v2` base URL configs back to `https://api.retellai.com`.

## Calls

```lua
local call = app.integrations.retell_ai.create_call({
  agent_id = "agent_123",
  metadata = {customer_id = "cus_123"},
  options = {
    from_number = "+14155550100",
    to_number = "+14155550199"
  }
})

local web_call = app.integrations.retell_ai.create_web_call({
  data = {agent_id = "agent_123"}
})

local calls = app.integrations.retell_ai.list_calls({
  filter = {agent_id = "agent_123"}
})

local details = app.integrations.retell_ai.get_call({call_id = "call_123"})

app.integrations.retell_ai.update_call({
  call_id = "call_123",
  metadata = {reviewed = true}
})

app.integrations.retell_ai.stop_call({call_id = "call_123"})
app.integrations.retell_ai.delete_call({call_id = "call_123"})
```

## Agents

```lua
local agents = app.integrations.retell_ai.list_agents({})
local agent = app.integrations.retell_ai.get_agent({agent_id = "agent_123"})

local created = app.integrations.retell_ai.create_agent({
  voice_id = "11labs-Adrian",
  prompt = "You are a helpful appointment scheduling agent.",
  options = {
    agent_name = "Scheduling Agent"
  }
})

app.integrations.retell_ai.update_agent({
  agent_id = "agent_123",
  data = {agent_name = "Updated Agent"}
})

app.integrations.retell_ai.delete_agent({agent_id = "agent_123"})
```

## Phone Numbers

```lua
local numbers = app.integrations.retell_ai.list_phone_numbers({})

local number = app.integrations.retell_ai.get_phone_number({
  phone_number = "+14155550100"
})

app.integrations.retell_ai.update_phone_number({
  phone_number = "+14155550100",
  data = {
    inbound_agent_id = "agent_123"
  }
})
```

## LLMs And Voices

```lua
local llms = app.integrations.retell_ai.list_retell_llms({})
local llm = app.integrations.retell_ai.get_retell_llm({llm_id = "llm_123"})

local voices = app.integrations.retell_ai.list_voices({})
local voice = app.integrations.retell_ai.get_voice({voice_id = "11labs-Adrian"})
```

## Generic API Helpers

Use generic helpers only for documented Retell endpoints that do not yet have a dedicated tool. `path` must be relative to the configured API base URL; absolute URLs are rejected.

```lua
local flows = app.integrations.retell_ai.api_get({
  path = "/list-conversation-flows"
})

local created_llm = app.integrations.retell_ai.api_post({
  path = "/create-retell-llm",
  body = {general_prompt = "You are a concise support agent."}
})

local updated = app.integrations.retell_ai.api_patch({
  path = "/update-agent/agent_123",
  body = {agent_name = "Updated Agent"}
})

local deleted = app.integrations.retell_ai.api_delete({
  path = "/delete-retell-llm/llm_123"
})
```

## Multi-Account Usage

```lua
app.integrations.retell_ai.list_agents({})
app.integrations.retell_ai.default.list_agents({})
app.integrations.retell_ai.production.list_calls({
  filter = {agent_id = "agent_123"}
})
```

All account namespaces expose the same tools; only stored API keys differ.
