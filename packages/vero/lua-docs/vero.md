# Vero — Lua API Reference

## identify_user

Identify or create a user in Vero with profile attributes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | Unique user identifier (user ID or email) |
| `email` | string | no | User's email address |
| `name` | string | no | User's full name |
| `extra` | object | no | Additional user traits as key-value pairs |

### Examples

#### Identify a new user

```lua
local result = app.integrations.vero.identify_user({
  identity = "user_12345",
  email = "jane@example.com",
  name = "Jane Doe",
  extra = {
    plan = "pro",
    country = "US"
  }
})

print(result.message)
```

#### Identify with minimal info

```lua
local result = app.integrations.vero.identify_user({
  identity = "jane@example.com",
  email = "jane@example.com"
})
```

---

## track_event

Track a custom event for a user in Vero. The user must already be identified.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | Unique user identifier |
| `event_name` | string | yes | Name of the event to track |
| `data` | object | no | Event properties as key-value pairs |

### Examples

#### Track a purchase event

```lua
local result = app.integrations.vero.track_event({
  identity = "user_12345",
  event_name = "Purchase Completed",
  data = {
    amount = 49.99,
    currency = "USD",
    product = "Pro Plan"
  }
})

print(result.message)
```

#### Track a simple event

```lua
local result = app.integrations.vero.track_event({
  identity = "user_12345",
  event_name = "Logged In"
})
```

---

## update_user

Update a user's profile attributes in Vero. Only specified fields are modified.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | Unique user identifier |
| `changes` | object | yes | Key-value pairs of attributes to update |

### Examples

#### Update user plan and name

```lua
local result = app.integrations.vero.update_user({
  identity = "user_12345",
  changes = {
    name = "Jane Smith",
    plan = "enterprise",
    company = "Acme Corp"
  }
})

print(result.message)
```

---

## add_tag

Add one or more tags to a user in Vero. Tags are useful for segmenting users.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | Unique user identifier |
| `tags` | array | yes | Array of tag names to add |

### Examples

#### Add a single tag

```lua
local result = app.integrations.vero.add_tag({
  identity = "user_12345",
  tags = { "VIP" }
})

print(result.message)
```

#### Add multiple tags

```lua
local result = app.integrations.vero.add_tag({
  identity = "user_12345",
  tags = { "Newsletter Subscriber", "Pro User", "Beta Tester" }
})

print(result.message)
```

---

## remove_tag

Remove one or more tags from a user in Vero.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | Unique user identifier |
| `tags` | array | yes | Array of tag names to remove |

### Examples

#### Remove a tag

```lua
local result = app.integrations.vero.remove_tag({
  identity = "user_12345",
  tags = { "Trial" }
})

print(result.message)
```

#### Remove multiple tags

```lua
local result = app.integrations.vero.remove_tag({
  identity = "user_12345",
  tags = { "Inactive", "Trial" }
})

print(result.message)
```

---

## Multi-Account Usage

If you have multiple Vero accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vero.identify_user({...})

-- Explicit default (portable across setups)
app.integrations.vero.default.identify_user({...})

-- Named accounts
app.integrations.vero.work.identify_user({...})
app.integrations.vero.marketing.identify_user({...})
```

All functions are identical across accounts — only the credentials differ.
