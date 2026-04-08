# Segment — Lua API Reference

## identify

Identify a user in Segment with their traits. Links metadata about a user to a known userId.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `userId` | string | yes | The unique identifier for the user in your database |
| `traits` | object | no | Key-value pairs of user traits (e.g., name, email, plan, role, company) |

### Examples

```lua
-- Identify a user with traits
app.integrations.segment.identify({
  userId = "user-42",
  traits = {
    name = "Jane Doe",
    email = "jane@example.com",
    plan = "pro",
    role = "admin"
  }
})
```

```lua
-- Update a user's plan
app.integrations.segment.identify({
  userId = "user-42",
  traits = {
    plan = "enterprise",
    upgraded_at = "2026-04-05"
  }
})
```

---

## track

Track a custom event for a user in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `event` | string | yes | The name of the event (e.g., "Order Completed") |
| `userId` | string | yes | The unique identifier for the user |
| `properties` | object | no | Key-value pairs of event properties |

### Examples

```lua
-- Track a purchase event
app.integrations.segment.track({
  event = "Order Completed",
  userId = "user-42",
  properties = {
    revenue = 99.99,
    currency = "USD",
    productId = "widget-3000",
    quantity = 2
  }
})
```

```lua
-- Track a button click
app.integrations.segment.track({
  event = "CTA Clicked",
  userId = "user-42",
  properties = {
    button = "Upgrade to Pro",
    page = "/pricing"
  }
})
```

---

## page

Record a page view in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | The name of the page viewed |
| `userId` | string | yes | The unique identifier for the user |
| `properties` | object | no | Key-value pairs of page properties (url, referrer, title, path) |

### Examples

```lua
-- Record a page view
app.integrations.segment.page({
  name = "Product Listing",
  userId = "user-42",
  properties = {
    url = "/products/widgets",
    category = "Widgets",
    referrer = "https://google.com"
  }
})
```

---

## group

Associate a user with a group (organization, company, account) in Segment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `groupId` | string | yes | The unique identifier for the group |
| `userId` | string | yes | The unique identifier for the user |
| `traits` | object | no | Key-value pairs of group traits (name, plan, industry) |

### Examples

```lua
-- Add user to an organization
app.integrations.segment.group({
  groupId = "org-123",
  userId = "user-42",
  traits = {
    name = "Acme Corp",
    plan = "enterprise",
    industry = "Technology",
    employee_count = 250
  }
})
```

---

## get_workspace

Get details of a Segment workspace by its slug. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug (e.g., "my-workspace") |

### Examples

```lua
-- Get workspace details
local ws = app.integrations.segment.get_workspace({
  slug = "my-workspace"
})
print(ws.name)
print(ws.id)
```

---

## list_sources

List all sources in a Segment workspace. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug |

### Examples

```lua
-- List all sources
local result = app.integrations.segment.list_sources({
  slug = "my-workspace"
})

for _, source in ipairs(result.sources or {}) do
  print(source.name .. " (" .. source.id .. ")")
end
```

---

## get_source

Get details of a specific Segment source. Requires an API token.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `slug` | string | yes | The workspace slug |
| `id` | string | yes | The source ID |

### Examples

```lua
-- Get source details
local source = app.integrations.segment.get_source({
  slug = "my-workspace",
  id = "abc123"
})
print(source.name)
print(source.write_key)
```

---

## get_current_user

Get the currently authenticated Segment user. Requires an API token. Useful for verifying credentials.

### Parameters

None.

### Examples

```lua
-- Verify API token is working
local user = app.integrations.segment.get_current_user({})
print("Authenticated as: " .. user.email)
```

---

## Multi-Account Usage

If you have multiple Segment accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.segment.track({...})

-- Explicit default (portable across setups)
app.integrations.segment.default.track({...})

-- Named accounts
app.integrations.segment.production.track({...})
app.integrations.segment.staging.track({...})
```

All functions are identical across accounts — only the credentials differ.
