# Memberstack — Lua API Reference

## list_members

List members with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Members per page (default: 50, max: 100) |
| `page` | integer | no | Page number, 1-based (default: 1) |

### Example

```lua
local result = app.integrations.memberstack.list_members({
  limit = 25,
  page = 1
})

for _, member in ipairs(result.data) do
  print(member.id .. ": " .. member.email)
end
```

---

## get_member

Get a single member by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |

### Example

```lua
local result = app.integrations.memberstack.get_member({
  id = "mem_abc123"
})

print(result.data.email)
print(result.data.metadata.name)
```

---

## create_member

Create a new member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Email address |
| `password` | string | no | Password for the member |
| `planId` | string | no | Plan ID to assign (use `list_plans` to find IDs) |
| `metadata` | object | no | Custom key-value metadata |

### Example

```lua
local result = app.integrations.memberstack.create_member({
  email = "newuser@example.com",
  password = "secure-password",
  planId = "pln_premium",
  metadata = {
    name = "Jane Doe",
    company = "Acme Inc"
  }
})

print("Created member: " .. result.data.id)
```

---

## update_member

Update an existing member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |
| `email` | string | no | New email address |
| `planId` | string | no | New plan ID to assign |
| `metadata` | object | no | Metadata to merge with existing values |

### Example

```lua
local result = app.integrations.memberstack.update_member({
  id = "mem_abc123",
  planId = "pln_enterprise",
  metadata = {
    role = "admin"
  }
})
```

---

## delete_member

Permanently delete a member.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Memberstack member ID |

### Example

```lua
app.integrations.memberstack.delete_member({
  id = "mem_abc123"
})
```

---

## list_plans

List all membership plans.

### Parameters

None.

### Example

```lua
local result = app.integrations.memberstack.list_plans({})

for _, plan in ipairs(result.data) do
  print(plan.id .. ": " .. plan.name .. " ($" .. plan.price .. ")")
end
```

---

## get_current_user

Get the currently authenticated user (verifies API credentials).

### Parameters

None.

### Example

```lua
local result = app.integrations.memberstack.get_current_user({})

print("Authenticated as: " .. result.data.email)
```

---

## Multi-Account Usage

If you have multiple Memberstack accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.memberstack.list_members({limit = 10})

-- Explicit default (portable across setups)
app.integrations.memberstack.default.list_members({limit = 10})

-- Named accounts
app.integrations.memberstack.production.list_members({limit = 10})
app.integrations.memberstack.staging.list_members({limit = 10})
```

All functions are identical across accounts — only the credentials differ.
