# Recurly — Lua API Reference

## recurly_list_accounts

List billing accounts from Recurly. Supports filtering by email and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of accounts to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `email` | string | no | Filter accounts by email address. |
| `state` | string | no | Filter by account state: `"active"`, `"closed"`, or `"inactive"`. |

### Example

```lua
local result = app.integrations.recurly.list_accounts({
  limit = 10,
  state = "active"
})

for _, account in ipairs(result.data) do
  print(account.code .. ": " .. (account.email or "no email"))
end
```

---

## recurly_get_account

Get details of a specific Recurly billing account by its ID or account code.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID or account code (e.g., `"code-123"` or a UUID). |

### Example

```lua
local result = app.integrations.recurly.get_account({
  id = "code-123"
})

print("Account: " .. result.code)
print("Email: " .. (result.email or "N/A"))
print("State: " .. result.state)
```

---

## recurly_create_account

Create a new billing account in Recurly with a unique account code, email, and name.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `code` | string | yes | A unique identifier for the account (e.g., `"cust-001"`). |
| `email` | string | no | The account email address. |
| `first_name` | string | no | The account holder's first name. |
| `last_name` | string | no | The account holder's last name. |

### Example

```lua
local result = app.integrations.recurly.create_account({
  code = "cust-001",
  email = "john@example.com",
  first_name = "John",
  last_name = "Doe"
})

print("Created account: " .. result.code)
```

---

## recurly_list_subscriptions

List subscriptions from Recurly. Supports filtering by account and state, with cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of subscriptions to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |
| `account_id` | string | no | Filter subscriptions by account ID or account code. |
| `state` | string | no | Filter by subscription state: `"active"`, `"canceled"`, `"expired"`, `"future"`, `"paused"`, or `"trial"`. |

### Example

```lua
local result = app.integrations.recurly.list_subscriptions({
  limit = 10,
  state = "active"
})

for _, sub in ipairs(result.data) do
  print(sub.uuid .. " — " .. sub.state .. " — " .. (sub.plan and sub.plan.code or "no plan"))
end
```

### Filter by account

```lua
local result = app.integrations.recurly.list_subscriptions({
  account_id = "code-123",
  state = "active"
})
```

---

## recurly_get_subscription

Get details of a specific Recurly subscription by its UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The subscription UUID. |

### Example

```lua
local result = app.integrations.recurly.get_subscription({
  id = "37c0a116-3b3a-4f57-bf32-45a1c8e0e6d8"
})

print("State: " .. result.state)
print("Plan: " .. (result.plan and result.plan.code or "N/A"))
print("Amount: " .. (result.unit_amount and tostring(result.unit_amount) or "N/A"))
```

---

## recurly_list_plans

List billing plans from Recurly. Supports cursor-based pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of plans to return (default: 20, max: 200). |
| `cursor` | string | no | Cursor for pagination — pass the value from a previous response to get the next page. |

### Example

```lua
local result = app.integrations.recurly.list_plans({
  limit = 50
})

for _, plan in ipairs(result.data) do
  print(plan.code .. ": " .. plan.name .. " — $" .. tostring(plan.currencies[1].unit_amount / 100))
end
```

---

## recurly_get_current_user

Verify the Recurly API connection by fetching the first account. Useful as a health check.

### Parameters

This tool takes no parameters.

### Example

```lua
local result = app.integrations.recurly.get_current_user({})

if result.data and #result.data > 0 then
  print("Connected! First account: " .. result.data[1].code)
else
  print("Connected, but no accounts found.")
end
```

---

## Multi-Account Usage

If you have multiple Recurly accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.recurly.function_name({...})

-- Explicit default (portable across setups)
app.integrations.recurly.default.function_name({...})

-- Named accounts
app.integrations.recurly.production.function_name({...})
app.integrations.recurly.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
