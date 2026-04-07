# Venmo — Lua API Reference

## Overview

The Venmo integration provides 7 tools for managing payments, users, and transactions. All calls go through `app.integrations.venmo.<method>({ ... })`.

**Payment amounts** are in dollars (e.g., `25.00` for twenty-five dollars).

## Authentication

Venmo uses a **Bearer access token** obtained via the OAuth 2.0 flow. The token is sent in the `Authorization` header as `Bearer <token>`.

Configure it in the integration settings under **Access Token**. Obtain one by completing the Venmo OAuth authorization flow. See the [Venmo developer documentation](https://developer.venmo.com) for details.

## Payments

### `app.integrations.venmo.list_payments(...)`

List Venmo payments with optional filtering and pagination.

```lua
local result = app.integrations.venmo.list_payments({
    limit = 20,
})
-- Returns: { payments = { { id = "...", status = "settled", amount = 25.00, note = "Dinner", action = "pay", created_at = "..." } }, paging = {} }

-- Filter by date range
local result = app.integrations.venmo.list_payments({
    after = "2026-01-01T00:00:00Z",
    before = "2026-03-31T23:59:59Z",
    limit = 50,
})

-- Paginate with offset
local page2 = app.integrations.venmo.list_payments({
    limit = 20,
    offset = 20,
})
```

### `app.integrations.venmo.get_payment(...)`

Retrieve a Venmo payment by ID. Returns full payment details including sender and recipient.

```lua
local payment = app.integrations.venmo.get_payment({
    id = "1234567890",
})
-- Returns: { id = "1234567890", status = "settled", amount = 25.00, note = "Dinner", action = "pay", sender = { ... }, recipient = { ... }, created_at = "..." }
```

### `app.integrations.venmo.create_payment(...)`

Create a Venmo payment. Requires amount, recipient user ID, and a note.

```lua
local payment = app.integrations.venmo.create_payment({
    amount = 25.00,
    user_id = "1234567890",
    note = "Dinner last night 🍕",
    audience = "friends",
})
-- Returns: { id = "...", status = "pending", amount = 25.00, note = "Dinner last night 🍕", action = "pay", audience = "friends", created_at = "..." }

-- Private payment
local payment = app.integrations.venmo.create_payment({
    amount = 100.00,
    user_id = "1234567890",
    note = "Rent share",
    audience = "private",
})
```

**Audience values**: `"private"`, `"friends"`, `"public"`. Default is `"friends"`.

## Users

### `app.integrations.venmo.list_users(...)`

Search for Venmo users by username, email, or phone number.

```lua
local result = app.integrations.venmo.list_users({
    query = "johnsmith",
    limit = 10,
})
-- Returns: { users = { { id = "...", username = "johnsmith", display_name = "John Smith", profile_picture_url = "..." } }, paging = {} }

-- Search by email
local result = app.integrations.venmo.list_users({
    query = "john@example.com",
})
```

### `app.integrations.venmo.get_user(...)`

Retrieve a Venmo user by ID. Returns full profile details.

```lua
local user = app.integrations.venmo.get_user({
    id = "1234567890",
})
-- Returns: { id = "1234567890", username = "johnsmith", display_name = "John Smith", first_name = "John", last_name = "Smith", email = "john@example.com", phone = "+15551234567", profile_picture_url = "...", about = "...", date_joined = "..." }
```

## Transactions

### `app.integrations.venmo.list_transactions(...)`

List Venmo transactions with optional filtering by date range, action type, and pagination.

```lua
local result = app.integrations.venmo.list_transactions({
    limit = 20,
})
-- Returns: { transactions = { { id = "...", status = "settled", amount = 25.00, note = "...", action = "pay", created_at = "..." } }, paging = {} }

-- Filter by action type (pay or charge)
local result = app.integrations.venmo.list_transactions({
    action = "pay",
    limit = 50,
})

-- Filter by date range
local result = app.integrations.venmo.list_transactions({
    after = "2026-01-01T00:00:00Z",
    before = "2026-01-31T23:59:59Z",
})
```

## Current User

### `app.integrations.venmo.get_current_user(...)`

Get the currently authenticated Venmo user's profile, including balance.

```lua
local user = app.integrations.venmo.get_current_user({})
-- Returns: { id = "...", username = "myusername", display_name = "My Name", first_name = "...", last_name = "...", email = "...", phone = "...", profile_picture_url = "...", about = "...", date_joined = "...", balance = 125.50 }
```

## Pagination

List endpoints (`list_payments`, `list_users`, `list_transactions`) use offset-based pagination.

- `limit` — Number of records to return (default 20).
- `offset` — Number of records to skip.
- `paging` — The response includes a `paging` object with pagination metadata.

```lua
-- Collect all payments across pages
local all_payments = {}
local offset = 0
local limit = 50

repeat
    local result = app.integrations.venmo.list_payments({
        limit = limit,
        offset = offset,
    })

    for _, p in ipairs(result.payments) do
        table.insert(all_payments, p)
    end

    offset = offset + limit
until #result.payments < limit
```

## Common Workflows

### Pay a friend

```lua
-- Step 1: Find the user
local result = app.integrations.venmo.list_users({
    query = "janesmith",
})
local user = result.users[1]

-- Step 2: Create the payment
local payment = app.integrations.venmo.create_payment({
    amount = 35.50,
    user_id = user.id,
    note = "Concert tickets 🎶",
    audience = "friends",
})
```

### Review recent transactions

```lua
-- Get last 10 transactions
local result = app.integrations.venmo.list_transactions({
    limit = 10,
})

for _, txn in ipairs(result.transactions) do
    print(txn.action .. " $" .. txn.amount .. " — " .. txn.note)
end
```

### Check your balance and profile

```lua
local me = app.integrations.venmo.get_current_user({})
print("Hello, " .. me.display_name .. "! Balance: $" .. (me.balance or 0))
```

## Notes

- **Amounts are in dollars** — `25.00` means twenty-five dollars, not cents.
- **Audience visibility** — Each payment has an audience setting: `"private"` (only sender and recipient), `"friends"` (friends of both), or `"public"` (everyone). Default is `"friends"`.
- **Action types** — Payments can be `"pay"` (sending money) or `"charge"` (requesting money).
- **OAuth token** — The access token is obtained via Venmo's OAuth 2.0 flow. Tokens may expire and need refreshing.
- **Error handling** — API errors include the HTTP status code and message. Common errors: `401` (invalid or expired token), `403` (forbidden), `404` (not found), `429` (rate limit exceeded).

---

## Multi-Account Usage

If you have multiple Venmo accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.venmo.function_name({...})

-- Explicit default (portable across setups)
app.integrations.venmo.default.function_name({...})

-- Named accounts
app.integrations.venmo.personal.function_name({...})
app.integrations.venmo.business.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
