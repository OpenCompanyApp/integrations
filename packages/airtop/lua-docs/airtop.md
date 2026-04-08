# Airtop — Lua API Reference

## create_session

Create a new cloud browser session. A session is a container for browser windows.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile` | string | no | Browser profile name for persisting cookies and state |
| `proxy` | string | no | Proxy configuration (e.g., `"http://user:pass@host:port"`) |

### Example

```lua
local session = app.integrations.airtop.create_session({
  profile = "default"
})

print("Session ID: " .. session.id)
```

---

## get_session

Get details of an existing browser session.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The session ID to retrieve |

### Example

```lua
local session = app.integrations.airtop.get_session({
  session_id = "sess_abc123"
})

print("Status: " .. session.status)
```

---

## create_window

Open a new browser window within a session.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The session ID to create the window in |
| `url` | string | no | Starting URL to navigate to when the window opens |
| `width` | integer | no | Window width in pixels (default: 1280) |
| `height` | integer | no | Window height in pixels (default: 720) |

### Example

```lua
local window = app.integrations.airtop.create_window({
  session_id = "sess_abc123",
  url = "https://example.com",
  width = 1920,
  height = 1080
})

print("Window ID: " .. window.id)
```

---

## get_window

Get details of a browser window.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The session ID |
| `window_id` | string | yes | The window ID to retrieve |

### Example

```lua
local window = app.integrations.airtop.get_window({
  session_id = "sess_abc123",
  window_id = "win_xyz789"
})

print("Current URL: " .. window.url)
```

---

## navigate

Navigate a browser window to a URL.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The session ID |
| `window_id` | string | yes | The window ID to navigate |
| `url` | string | yes | The URL to navigate to |
| `wait_until` | string | no | When to consider navigation complete: `"load"`, `"domcontentloaded"`, or `"networkidle"` |

### Example

```lua
local result = app.integrations.airtop.navigate({
  session_id = "sess_abc123",
  window_id = "win_xyz789",
  url = "https://example.com",
  wait_until = "networkidle"
})

print("Navigated to: " .. result.url)
```

---

## get_page_content

Extract the content of the currently loaded page.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `session_id` | string | yes | The session ID |
| `window_id` | string | yes | The window ID to get content from |

### Example

```lua
local content = app.integrations.airtop.get_page_content({
  session_id = "sess_abc123",
  window_id = "win_xyz789"
})

print(content)
```

---

## list_sessions

List all active browser sessions.

### Parameters

None.

### Example

```lua
local sessions = app.integrations.airtop.list_sessions({})

for _, session in ipairs(sessions) do
  print("Session: " .. session.id .. " — " .. session.status)
end
```

---

## get_current_user

Get the profile of the authenticated Airtop user.

### Parameters

None.

### Example

```lua
local user = app.integrations.airtop.get_current_user({})

print("Logged in as: " .. user.email)
```

---

## Typical Workflow

```lua
-- 1. Create a browser session
local session = app.integrations.airtop.create_session({})

-- 2. Open a window
local window = app.integrations.airtop.create_window({
  session_id = session.id
})

-- 3. Navigate to a page
app.integrations.airtop.navigate({
  session_id = session.id,
  window_id = window.id,
  url = "https://example.com"
})

-- 4. Extract content
local content = app.integrations.airtop.get_page_content({
  session_id = session.id,
  window_id = window.id
})

print(content)
```

---

## Multi-Account Usage

If you have multiple Airtop accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.airtop.function_name({...})

-- Explicit default (portable across setups)
app.integrations.airtop.default.function_name({...})

-- Named accounts
app.integrations.airtop.work.function_name({...})
app.integrations.airtop.client.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
