# Customer.io — Lua API Reference

## identify_customer

Create or update a customer profile in Customer.io.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Unique identifier for the customer (user ID, email, or external ID) |
| `email` | string | no | Customer email address |
| `name` | string | no | Customer full name |
| `attributes` | object | no | Additional custom attributes (key-value pairs) |

### Examples

#### Create a new customer

```lua
local result = app.integrations.customerio.identify_customer({
  id = "user_12345",
  email = "jane@example.com",
  name = "Jane Doe",
  attributes = {
    plan = "premium",
    company = "Acme Corp"
  }
})

print(result.message)
```

#### Update an existing customer

```lua
local result = app.integrations.customerio.identify_customer({
  id = "user_12345",
  attributes = {
    plan = "enterprise",
    mrr = 299
  }
})
```

---

## track_event

Track a custom event for a customer. Events can trigger campaign workflows and are used for segmentation.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Customer identifier (must match the ID used in identify) |
| `name` | string | yes | Event name (e.g., `"purchase"`, `"signup"`) |
| `data` | object | no | Event data — key-value pairs with event details |

### Examples

#### Track a purchase event

```lua
local result = app.integrations.customerio.track_event({
  id = "user_12345",
  name = "purchase",
  data = {
    product = "Pro Plan",
    amount = 99.00,
    currency = "USD"
  }
})

print(result.message)
```

#### Track a simple event

```lua
local result = app.integrations.customerio.track_event({
  id = "user_12345",
  name = "logged_in"
})
```

---

## list_segments

List all segments in the Customer.io workspace.

### Parameters

None.

### Example

```lua
local result = app.integrations.customerio.list_segments({})

for _, segment in ipairs(result.segments or {}) do
  print(segment.name .. " (ID: " .. segment.id .. ")")
end
```

---

## list_campaigns

List all campaigns in the Customer.io workspace.

### Parameters

None.

### Example

```lua
local result = app.integrations.customerio.list_campaigns({})

for _, campaign in ipairs(result.campaigns or {}) do
  print(campaign.name .. " — Status: " .. tostring(campaign.active))
end
```

---

## get_campaign

Get detailed information about a specific campaign.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The campaign ID to retrieve |

### Example

```lua
local result = app.integrations.customerio.get_campaign({
  id = 42
})

print("Campaign: " .. result.name)
print("Active: " .. tostring(result.active))
```

---

## list_newsletters

List all newsletters in the Customer.io workspace.

### Parameters

None.

### Example

```lua
local result = app.integrations.customerio.list_newsletters({})

for _, newsletter in ipairs(result.newsletters or {}) do
  print(newsletter.name .. " — Status: " .. tostring(newsletter.state))
end
```

---

## get_current_user

Get the currently authenticated user and account information. Useful for verifying API credentials.

### Parameters

None.

### Example

```lua
local result = app.integrations.customerio.get_current_user({})

print("Account: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Customer.io accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.customerio.function_name({...})

-- Explicit default (portable across setups)
app.integrations.customerio.default.function_name({...})

-- Named accounts
app.integrations.customerio.production.function_name({...})
app.integrations.customerio.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
