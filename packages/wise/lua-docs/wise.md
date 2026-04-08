# Wise — Lua API Reference

## list_profiles

List all Wise profiles (personal and business) for the authenticated user.

### Parameters

None.

### Example

```lua
local result = app.integrations.wise.list_profiles({})

for _, profile in ipairs(result) do
  print(profile.id .. ": " .. profile.type .. " — " .. profile.firstName .. " " .. profile.lastName)
end
```

---

## get_profile

Get details of a specific Wise profile by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | integer | yes | The Wise profile ID. |

### Example

```lua
local result = app.integrations.wise.get_profile({
  profile_id = 123456
})

print("Type: " .. result.type)
print("Name: " .. result.firstName .. " " .. result.lastName)
```

---

## list_balances

List multi-currency account balances for a Wise profile.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `profile_id` | integer | yes | The Wise profile ID to list balances for. |

### Example

```lua
local result = app.integrations.wise.list_balances({
  profile_id = 123456
})

for _, account in ipairs(result) do
  for _, balance in ipairs(account.balances) do
    print(balance.currency .. ": " .. balance.amount.value)
  end
end
```

---

## list_transfers

List Wise transfers with optional filtering by profile, status, and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Maximum number of transfers to return. |
| `offset` | integer | no | Number of transfers to skip for pagination. |
| `profile_id` | integer | no | Filter transfers by profile ID. |
| `status` | string | no | Filter by transfer status (e.g. `incoming_payment_waiting`, `processing`, `funds_converted`, `funds_refunded`, `outgoing_payment_sent`). |

### Example

```lua
-- List recent transfers
local result = app.integrations.wise.list_transfers({
  limit = 10
})

for _, transfer in ipairs(result) do
  print(transfer.id .. ": " .. transfer.sourceCurrency .. " " .. transfer.sourceAmount .. " -> " .. transfer.targetCurrency)
end
```

```lua
-- Filter by status
local result = app.integrations.wise.list_transfers({
  status = "outgoing_payment_sent",
  profile_id = 123456
})
```

---

## get_transfer

Get details of a specific Wise transfer by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `transfer_id` | integer | yes | The Wise transfer ID. |

### Example

```lua
local result = app.integrations.wise.get_transfer({
  transfer_id = 789012
})

print("Status: " .. result.status)
print("Amount: " .. result.sourceCurrency .. " " .. result.sourceAmount)
print("Rate: " .. result.rate)
```

---

## create_transfer

Create a new money transfer on Wise.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `source_account` | integer | yes | Source account ID (borderless account balance to debit from). |
| `target_account` | integer | yes | Target account ID (recipient account to credit). |
| `amount` | number | yes | Amount to transfer in the source currency. |
| `reference` | string | no | Payment reference or description for the transfer. |

### Example

```lua
local result = app.integrations.wise.create_transfer({
  source_account = 111111,
  target_account = 222222,
  amount = 100.00,
  reference = "Invoice #1234"
})

print("Transfer ID: " .. result.id)
print("Status: " .. result.status)
```

---

## get_current_user

Get details of the currently authenticated Wise user.

### Parameters

None.

### Example

```lua
local result = app.integrations.wise.get_current_user({})

print("Name: " .. result.firstName .. " " .. result.lastName)
print("Email: " .. result.email)
```

---

## Multi-Account Usage

If you have multiple Wise accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.wise.function_name({...})

-- Explicit default (portable across setups)
app.integrations.wise.default.function_name({...})

-- Named accounts
app.integrations.wise.business.function_name({...})
app.integrations.wise.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
