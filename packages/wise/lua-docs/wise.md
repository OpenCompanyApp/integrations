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
| `types` | string | no | Comma-separated balance types. Defaults to `STANDARD,SAVINGS`. |

### Example

```lua
local result = app.integrations.wise.list_balances({
  profile_id = 123456,
  types = "STANDARD,SAVINGS"
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
| `profile_id` | integer | no | Filter transfers by profile ID. Sent to Wise as `profile`. |
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
| `target_account` | integer | yes | Target account ID (recipient account to credit). |
| `quote_uuid` | string | yes | V2 quote UUID for this transfer. |
| `customer_transaction_id` | string | yes | UUID used by Wise for idempotency. Reuse it when retrying the same create request. |
| `source_account` | integer | no | Optional refund recipient source account ID. |
| `reference` | string | no | Payment reference or description for the transfer. |
| `details` | object | no | Additional transfer details returned by Wise transfer-requirements. |

### Example

```lua
local result = app.integrations.wise.create_transfer({
  target_account = 222222,
  quote_uuid = "11111111-2222-3333-4444-555555555555",
  customer_transaction_id = "aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee",
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
