# Revolut — Lua API Reference

## Overview

The Revolut integration provides 7 tools for managing business banking — accounts, transactions, cards, and user profile. All calls go through `app.integrations.revolut.<method>({ ... })`.

## Authentication

Revolut uses a **Bearer access token** (`oa_prod_...` or `oa_sandbox_...`). The token is sent via the `Authorization: Bearer <token>` header.

Configure it in the integration settings under **Access Token**. Generate one in the **Revolut Business Developer Portal**. Use a token with only the permissions you need.

## Accounts

### `app.integrations.revolut.list_accounts(...)`

List all Revolut business accounts. Returns account IDs, names, balances, and currency information.

```lua
local result = app.integrations.revolut.list_accounts({})
-- Returns: { accounts = { { id = "...", name = "Main GBP", currency = "GBP", balance = 125000, state = "active", type = "current" }, ... } }
```

### `app.integrations.revolut.get_account(...)`

Retrieve a Revolut account by ID with full details.

```lua
local account = app.integrations.revolut.get_account({
    id = "acc_abc123",
})
-- Returns: { id = "acc_abc123", name = "Main GBP", currency = "GBP", balance = 125000, state = "active", type = "current", public_id = "...", created_at = "...", updated_at = "..." }
```

## Transactions

### `app.integrations.revolut.list_transactions(...)`

List Revolut transactions with optional filters. Supports filtering by account, date range, type, and pagination.

```lua
-- List recent transactions
local result = app.integrations.revolut.list_transactions({
    count = 50,
})
-- Returns: { transactions = { { id = "...", type = "card_payment", state = "completed", amount = -2500, currency = "GBP", description = "Office Supplies", ... } } }

-- Filter by account and date range
local result = app.integrations.revolut.list_transactions({
    account_id = "acc_abc123",
    from = "2026-01-01T00:00:00Z",
    to = "2026-03-31T23:59:59Z",
    count = 100,
})

-- Filter by type
local result = app.integrations.revolut.list_transactions({
    type = "card_payment",
    count = 25,
})

-- Common types: "card_payment", "transfer", "fx", "topup", "atm", "refund"
```

### `app.integrations.revolut.get_transaction(...)`

Retrieve a Revolut transaction by ID with full details including all legs.

```lua
local transaction = app.integrations.revolut.get_transaction({
    id = "tx_def456",
})
-- Returns: { id = "tx_def456", type = "card_payment", state = "completed", legs = { { account_id = "...", amount = -2500, currency = "GBP", ... } }, description = "Office Supplies", reference = "INV-001", created_at = "...", updated_at = "...", completed_at = "..." }
```

## Cards

### `app.integrations.revolut.list_cards(...)`

List all Revolut business cards. Returns card IDs, last 4 digits, status, and cardholder information.

```lua
local result = app.integrations.revolut.list_cards({})
-- Returns: { cards = { { id = "...", last_four_digits = "4242", status = "active", cardholder_name = "John Doe", currency = "GBP", type = "physical", label = "Company Card", expiry_date = "12/28" }, ... } }
```

### `app.integrations.revolut.get_card(...)`

Retrieve a Revolut card by ID with full details including spending limits.

```lua
local card = app.integrations.revolut.get_card({
    id = "card_ghi789",
})
-- Returns: { id = "card_ghi789", last_four_digits = "4242", status = "active", cardholder_name = "John Doe", currency = "GBP", type = "physical", label = "Company Card", expiry_date = "12/28", spending_limits = { ... }, created_at = "...", updated_at = "..." }
```

## User

### `app.integrations.revolut.get_current_user(...)`

Get the currently authenticated Revolut user profile.

```lua
local user = app.integrations.revolut.get_current_user({})
-- Returns: { id = "...", first_name = "John", last_name = "Doe", email = "john@company.com", phone = "+44123456789", state = "active", created_at = "...", updated_at = "..." }
```

## Common Workflows

### Check balances across all accounts

```lua
local result = app.integrations.revolut.list_accounts({})

for _, account in ipairs(result.accounts) do
    local amount = account.balance / 100
    print(account.name .. ": " .. amount .. " " .. account.currency)
end
```

### Find recent card payments

```lua
local result = app.integrations.revolut.list_transactions({
    type = "card_payment",
    count = 20,
})

for _, tx in ipairs(result.transactions) do
    if tx.state == "completed" then
        local amount = tx.amount / 100
        print(tx.description .. ": " .. amount .. " " .. tx.currency)
    end
end
```

### Review spending on a specific card

```lua
-- Step 1: Find the card
local cards = app.integrations.revolut.list_cards({})
local my_card = nil
for _, c in ipairs(cards.cards) do
    if c.last_four_digits == "4242" then
        my_card = c
        break
    end
end

-- Step 2: Get full card details with limits
if my_card then
    local details = app.integrations.revolut.get_card({ id = my_card.id })
    -- Review spending limits
    for _, limit in ipairs(details.spending_limits or {}) do
        print(limit.amount .. " " .. limit.currency .. " / " .. limit.interval)
    end
end
```

### Verify user and check account access

```lua
-- Step 1: Get user profile
local user = app.integrations.revolut.get_current_user({})
print("Connected as: " .. user.first_name .. " " .. user.last_name .. " (" .. user.email .. ")")

-- Step 2: List accessible accounts
local accounts = app.integrations.revolut.list_accounts({})
print("Number of accounts: " .. #accounts.accounts)
```

## Notes

- **All monetary amounts are in cents** (smallest currency unit) unless otherwise stated by the API. For example, £125.00 may be `12500`, €50.50 may be `5050`.
- **Transaction legs** — A transaction can have multiple legs (e.g., a currency conversion has a debit leg and a credit leg in different currencies).
- **Transaction states** — Common states include `pending`, `completed`, `declined`, `failed`, `reverted`.
- **Card types** — `"physical"` or `"virtual"`.
- **Date filters** — Use ISO 8601 format for date parameters: `"2026-01-01T00:00:00Z"`.
- **Error handling** — API errors include the HTTP status code and error message. Common errors: `401` (invalid or expired token), `403` (insufficient permissions), `404` (resource not found), `429` (rate limit exceeded).

---

## Multi-Account Usage

If you have multiple revolut accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.revolut.function_name({...})

-- Explicit default (portable across setups)
app.integrations.revolut.default.function_name({...})

-- Named accounts
app.integrations.revolut.work.function_name({...})
app.integrations.revolut.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
