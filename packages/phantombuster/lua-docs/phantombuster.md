# Phantombuster — Lua API Reference

## list_agents

List all Phantombuster agents in your account.

### Parameters

None.

### Response

Returns an array of agent objects with `id`, `name`, `status`, and other metadata.

### Example

```lua
local result = app.integrations.phantombuster.list_agents({})

for _, agent in ipairs(result.agents or {}) do
  print(agent.name .. " (id: " .. agent.id .. ") - " .. agent.status)
end
```

---

## get_agent

Get details for a specific Phantombuster agent.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The agent ID |

### Example

```lua
local result = app.integrations.phantombuster.get_agent({
  id = "1234567890123456789"
})

print("Agent: " .. result.name)
print("Status: " .. result.status)
```

---

## launch_agent

Launch a Phantombuster agent to start an automation. Returns a container ID you can use to track execution.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The agent ID to launch |

### Example

```lua
local result = app.integrations.phantombuster.launch_agent({
  id = "1234567890123456789"
})

print("Launched! Container ID: " .. result.container.id)
```

---

## list_containers

List all Phantombuster containers (execution runs). Returns run history with status, timestamps, and agent associations.

### Parameters

None.

### Example

```lua
local result = app.integrations.phantombuster.list_containers({})

for _, container in ipairs(result.containers or {}) do
  print("Container " .. container.id .. " — " .. container.status .. " — " .. container.agentId)
end
```

---

## get_container

Get details for a specific Phantombuster container (execution run), including status, output, and logs.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The container ID |

### Example

```lua
local result = app.integrations.phantombuster.get_container({
  id = "9876543210987654321"
})

print("Status: " .. result.status)
print("Output: " .. (result.output or "no output yet"))
```

---

## get_current_user

Get the authenticated Phantombuster user profile, including account info and plan details.

### Parameters

None.

### Example

```lua
local result = app.integrations.phantombuster.get_current_user({})

print("Email: " .. result.email)
print("Plan: " .. result.plan)
```

---

## Multi-Account Usage

If you have multiple Phantombuster accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.phantombuster.function_name({})

-- Explicit default (portable across setups)
app.integrations.phantombuster.default.function_name({})

-- Named accounts
app.integrations.phantombuster.work.function_name({})
app.integrations.phantombuster.client.function_name({})
```

All functions are identical across accounts — only the credentials differ.
