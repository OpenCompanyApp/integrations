# Devin AI — Lua API Reference

## create_session

Create a new Devin AI session with a task prompt.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `prompt` | string | yes | The task description for Devin to execute |
| `idempotency_key` | string | no | Unique key to prevent duplicate session creation |

### Examples

```lua
local result = app.integrations.devin.create_session({
  prompt = "Create a new React component for a login form with email and password fields"
})

print("Session ID: " .. result.session_id)
print("Status: " .. result.status)
```

### With idempotency key

```lua
local result = app.integrations.devin.create_session({
  prompt = "Fix the failing tests in the auth module",
  idempotency_key = "fix-auth-tests-2026-04-05"
})
```

---

## get_session

Retrieve details and current status of a Devin session.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The ID of the session to retrieve |

### Examples

```lua
local result = app.integrations.devin.get_session({
  session_id = "sess_abc123"
})

print("Status: " .. result.status)
print("Created at: " .. result.created_at)
```

---

## list_sessions

List all Devin sessions.

### Parameters

None.

### Examples

```lua
local result = app.integrations.devin.list_sessions()

for _, session in ipairs(result.sessions or {}) do
  print(session.session_id .. " - " .. session.status)
end
```

---

## send_message

Send a message to an existing Devin session.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The ID of the session to message |
| `message` | string | yes | The message content to send |

### Examples

```lua
local result = app.integrations.devin.send_message({
  session_id = "sess_abc123",
  message = "Can you also add form validation to the login component?"
})
```

---

## get_current_user

Get information about the currently authenticated Devin user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.devin.get_current_user()

print("User: " .. (result.name or "Unknown"))
print("Email: " .. (result.email or "Unknown"))
```

---

## Multi-Account Usage

If you have multiple Devin accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.devin.create_session({ prompt = "..." })

-- Explicit default (portable across setups)
app.integrations.devin.default.create_session({ prompt = "..." })

-- Named accounts
app.integrations.devin.work.create_session({ prompt = "..." })
app.integrations.devin.personal.create_session({ prompt = "..." })
```

All functions are identical across accounts — only the credentials differ.
