# Stripe Connect — Lua API Reference

## Overview

The Stripe Connect integration provides 7 tools for managing connected accounts, payouts, balance transactions, and capabilities. All calls go through `app.integrations["stripe-connect"].<method>({ ... })`.

**Amounts are always in cents** (smallest currency unit). For example, $10.00 → `1000`, €25.50 → `2550`.

**ID prefixes** — Stripe objects use recognizable prefixes:

| Prefix | Object              |
|--------|---------------------|
| `acct_`| Connect Account     |
| `po_`  | Payout              |
| `txn_` | Balance Transaction |

## Authentication

Stripe Connect uses a **Bearer token** (your Stripe API key). Configure it in the integration settings under **Access Token**. Find yours at **Stripe Dashboard → Developers → API keys**.

## Accounts

### `app.integrations["stripe-connect"].list_accounts(...)`

List Stripe Connect accounts with optional pagination.

```lua
local result = app.integrations["stripe-connect"].list_accounts({
    limit = 25,
})
-- Returns: { accounts = { { id = "acct_...", business_type = "company", display_name = "Acme Corp", email = "admin@acme.com", country = "US", created = 1712304000 } }, has_more = false }
```

### `app.integrations["stripe-connect"].get_account(...)`

Retrieve a Stripe Connect account by ID with full details.

```lua
local account = app.integrations["stripe-connect"].get_account({
    id = "acct_1234567890",
})
-- Returns: { id = "acct_...", business_type = "company", display_name = "Acme Corp", email = "admin@acme.com", country = "US", default_currency = "usd", capabilities = { card_payments = "active", transfers = "active" }, charges_enabled = true, payouts_enabled = true, created = 1712304000 }
```

## Payouts

### `app.integrations["stripe-connect"].list_payouts(...)`

List Stripe Connect payouts with optional filtering by status and arrival date.

```lua
-- List all payouts
local result = app.integrations["stripe-connect"].list_payouts({
    limit = 25,
})
-- Returns: { payouts = { { id = "po_...", amount = 10000, currency = "usd", status = "paid", arrival_date = 1712304000, method = "standard", created = 1712200000 } }, has_more = false }

-- Filter by status
local result = app.integrations["stripe-connect"].list_payouts({
    status = "paid",
    limit = 10,
})

-- Status values: "paid", "pending", "in_transit", "canceled", "failed"

-- Filter by arrival date (Unix timestamp)
local result = app.integrations["stripe-connect"].list_payouts({
    arrival_date = { gte = 1712304000 },
    limit = 25,
})
```

### `app.integrations["stripe-connect"].get_payout(...)`

Retrieve a Stripe Connect payout by ID with full details.

```lua
local payout = app.integrations["stripe-connect"].get_payout({
    id = "po_1234567890",
})
-- Returns: { id = "po_...", amount = 10000, currency = "usd", status = "paid", arrival_date = 1712304000, method = "standard", destination = "ba_...", failure_code = nil, failure_message = nil, metadata = {}, created = 1712200000 }
```

## Balance Transactions

### `app.integrations["stripe-connect"].list_balances(...)`

List Stripe Connect balance transactions with optional pagination.

```lua
local result = app.integrations["stripe-connect"].list_balances({
    limit = 25,
})
-- Returns: { balance_transactions = { { id = "txn_...", type = "charge", amount = 10000, currency = "usd", net = 9710, fee = 290, description = "Payment for order #1234", status = "available", created = 1712304000 } }, has_more = false }
```

## Capabilities

### `app.integrations["stripe-connect"].list_capabilities(...)`

List capabilities for a specific Stripe Connect account.

```lua
local result = app.integrations["stripe-connect"].list_capabilities({
    account = "acct_1234567890",
})
-- Returns: { capabilities = { { id = "card_payments", account = "acct_...", status = "active", requested = true } }, has_more = false }
```

## Current User

### `app.integrations["stripe-connect"].get_current_user(...)`

Get the currently authenticated Stripe Connect user.

```lua
local user = app.integrations["stripe-connect"].get_current_user({})
-- Returns: { id = "usr_...", name = "John Doe", email = "john@example.com", created = 1712304000 }
```

## Pagination

All list endpoints (`list_accounts`, `list_payouts`, `list_balances`) return a `has_more` field. Use `limit` to control page size (1–100, default 10).

## Notes

- **All monetary amounts are in cents** — the smallest currency unit. `$10.00` is `1000`, `€5.50` is `550`.
- **Currency codes** are lowercase three-letter ISO 4217 codes: `"usd"`, `"eur"`, `"gbp"`, etc.
- **Error handling** — API errors include the HTTP status code and Stripe error message. Common errors: `401` (invalid access token), `403` (insufficient permissions), `404` (object not found), `429` (rate limit exceeded).

---

## Multi-Account Usage

If you have multiple stripe-connect accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations["stripe-connect"].function_name({...})

-- Explicit default (portable across setups)
app.integrations["stripe-connect"].default.function_name({...})

-- Named accounts
app.integrations["stripe-connect"].work.function_name({...})
app.integrations["stripe-connect"].personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
