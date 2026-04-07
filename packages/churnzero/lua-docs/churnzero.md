# ChurnZero — Lua API Reference

## list_accounts

Search and list accounts in ChurnZero. Supports filtering by search term and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `search` | string | no | Search term to filter accounts by name or other attributes |
| `page` | integer | no | Page number for pagination (default: 1) |
| `perPage` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.churnzero.list_accounts({
  search = "Acme",
  perPage = 10
})

for _, account in ipairs(result.accounts) do
  print(account.id .. ": " .. account.name)
end
```

---

## get_account

Get full details for a single account by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The account ID to retrieve |

### Example

```lua
local account = app.integrations.churnzero.get_account({
  id = "acc_abc123"
})

print(account.name)
print("Health Score: " .. (account.healthScore or "N/A"))
print("License Count: " .. (account.licenseCount or "0"))
```

---

## list_contacts

List contacts, optionally filtered by account or search term.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | no | Filter contacts by account ID |
| `search` | string | no | Search term to filter contacts by name or email |
| `page` | integer | no | Page number for pagination (default: 1) |
| `perPage` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.churnzero.list_contacts({
  account_id = "acc_abc123",
  perPage = 50
})

for _, contact in ipairs(result.contacts) do
  print(contact.firstName .. " " .. contact.lastName .. " (" .. (contact.email or "") .. ")")
end
```

---

## get_contact

Get full details for a single contact by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The contact ID to retrieve |

### Example

```lua
local contact = app.integrations.churnzero.get_contact({
  id = "con_abc123"
})

print(contact.firstName .. " " .. contact.lastName)
print("Email: " .. (contact.email or "N/A"))
print("Role: " .. (contact.role or "N/A"))
```

---

## list_alerts

List alerts — risk signals, usage drops, renewal reminders, and other notifications.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | no | Filter alerts by account ID |
| `status` | string | no | Alert status: `"open"`, `"dismissed"`, `"snoozed"` |
| `page` | integer | no | Page number for pagination (default: 1) |
| `perPage` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.churnzero.list_alerts({
  status = "open",
  perPage = 10
})

for _, alert in ipairs(result.alerts) do
  print(alert.type .. ": " .. (alert.title or alert.message or ""))
end
```

---

## list_usage

List usage data — track how customers engage with your product features.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | no | Filter usage data by account ID |
| `feature` | string | no | Filter by feature or module name |
| `page` | integer | no | Page number for pagination (default: 1) |
| `perPage` | integer | no | Results per page (default: 25, max: 100) |

### Example

```lua
local result = app.integrations.churnzero.list_usage({
  account_id = "acc_abc123",
  feature = "Reporting"
})

for _, entry in ipairs(result.usage) do
  print(entry.feature .. ": " .. entry.value)
end
```

---

## get_current_user

Get the authenticated user's profile.

### Parameters

None.

### Example

```lua
local user = app.integrations.churnzero.get_current_user({})

print("Logged in as: " .. (user.firstName or "") .. " " .. (user.lastName or ""))
print("Email: " .. (user.email or "N/A"))
print("Tenant: " .. (user.tenantName or "N/A"))
```

---

## Multi-Account Usage

If you have multiple ChurnZero instances configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.churnzero.function_name({...})

-- Explicit default (portable across setups)
app.integrations.churnzero.default.function_name({...})

-- Named accounts
app.integrations.churnzero.us_team.function_name({...})
app.integrations.churnzero.eu_team.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
