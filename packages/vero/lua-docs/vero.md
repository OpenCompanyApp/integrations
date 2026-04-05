# Vero — Lua API Reference

## identify_user

Identify (create or update) a user in Vero with email, name, and custom attributes.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Unique user identifier (e.g., database ID or UUID) |
| `email` | string | yes | User email address |
| `name` | string | no | Display name for the user |
| `data` | object | no | Custom user attributes as key-value pairs |

### Example

```lua
app.integrations.vero.identify_user({
  id = "usr_123",
  email = "john@example.com",
  name = "John Doe",
  data = {
    plan = "premium",
    signup_date = "2025-01-15",
    company = "Acme Inc"
  }
})
```

---

## track_event

Track a behavioral event for a user. Events can trigger automated email campaigns in Vero.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `identity` | string | yes | User ID or email address identifying the user |
| `event_name` | string | yes | Name of the event (e.g., "Logged in", "Purchased") |
| `data` | object | no | Event-specific data as key-value pairs |

### Example

```lua
app.integrations.vero.track_event({
  identity = "usr_123",
  event_name = "Purchased",
  data = {
    product = "Widget",
    price = 29.99,
    currency = "USD"
  }
})
```

---

## update_user

Update a user's email address and/or custom attributes in Vero.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Unique user identifier to update |
| `email` | string | no | New email address for the user |
| `data` | object | no | Attributes to update as key-value pairs |

### Example

```lua
app.integrations.vero.update_user({
  id = "usr_123",
  email = "john.doe@newdomain.com",
  data = {
    plan = "enterprise",
    company = "Big Corp"
  }
})
```

---

## unsubscribe

Unsubscribe a user from all Vero email campaigns.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Unique user identifier to unsubscribe |

### Example

```lua
app.integrations.vero.unsubscribe({
  id = "usr_123"
})
```

---

## resubscribe

Resubscribe a previously unsubscribed user to Vero email campaigns.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Unique user identifier to resubscribe |

### Example

```lua
app.integrations.vero.resubscribe({
  id = "usr_123"
})
```

---

## get_current_user

Get the profile of the currently authenticated Vero user. Useful for verifying API connectivity.

### Parameters

None.

### Example

```lua
local user = app.integrations.vero.get_current_user({})
print("Account: " .. (user.email or "unknown"))
```

---

## Common Workflows

### Onboard a new user and trigger welcome email

```lua
-- Step 1: Identify the user
app.integrations.vero.identify_user({
  id = "usr_456",
  email = "jane@example.com",
  name = "Jane Smith",
  data = {
    plan = "free",
    signup_date = "2025-06-15"
  }
})

-- Step 2: Track the signup event (triggers welcome campaign)
app.integrations.vero.track_event({
  identity = "usr_456",
  event_name = "Signed up",
  data = {
    source = "landing_page",
    plan = "free"
  }
})
```

### Upgrade a user's plan

```lua
-- Update user attributes
app.integrations.vero.update_user({
  id = "usr_456",
  data = {
    plan = "premium",
    upgraded_at = "2025-07-01"
  }
})

-- Track the upgrade event
app.integrations.vero.track_event({
  identity = "usr_456",
  event_name = "Upgraded plan",
  data = {
    from_plan = "free",
    to_plan = "premium"
  }
})
```

### Handle a user leaving

```lua
-- Track churn event
app.integrations.vero.track_event({
  identity = "usr_456",
  event_name = "Cancelled subscription",
  data = {
    reason = "too_expensive",
    last_plan = "premium"
  }
})

-- Unsubscribe from emails
app.integrations.vero.unsubscribe({
  id = "usr_456"
})
```

---

## Multi-Account Usage

If you have multiple Vero accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.vero.identify_user({id = "1", email = "a@b.com"})

-- Explicit default (portable across setups)
app.integrations.vero.default.identify_user({id = "1", email = "a@b.com"})

-- Named accounts
app.integrations.vero.marketing.identify_user({id = "1", email = "a@b.com"})
app.integrations.vero.transactional.track_event({identity = "1", event_name = "Order shipped"})
```

All functions are identical across accounts — only the credentials differ.
