# Stripe — Lua API Reference

## Overview

The Stripe integration provides 25 tools for managing customers, products, prices, payment intents, invoices, subscriptions, and account balance. All calls go through `app.integrations.stripe.<method>({ ... })`.

**Amounts are always in cents** (smallest currency unit). For example, $10.00 → `1000`, €25.50 → `2550`.

**ID prefixes** — Stripe objects use recognizable prefixes:

| Prefix | Object          |
|--------|-----------------|
| `cus_` | Customer        |
| `prod_`| Product         |
| `price_`| Price          |
| `pi_`  | Payment Intent  |
| `in_`  | Invoice         |
| `sub_` | Subscription    |
| `pm_`  | Payment Method  |

## Authentication

Stripe uses a **Secret API Key** (`sk_live_...` or `sk_test_...`). The key is sent via HTTP Basic Auth with the key as the username and an empty password.

Configure it in the integration settings under **Secret API Key**. Find yours at **Stripe Dashboard → Developers → API keys**. Use a restricted key with only the permissions you need.

## Customers

### `app.integrations.stripe.create_customer(...)`

Create a new Stripe customer. Supports name, email, description, phone, and custom metadata.

```lua
local customer = app.integrations.stripe.create_customer({
    name = "Acme Corp",
    email = "billing@acme.com",
    description = "Enterprise customer",
    phone = "+1 555-0123",
    metadata = {
        crm_id = "12345",
        tier = "enterprise",
    },
})
-- Returns: { id = "cus_abc123", name = "Acme Corp", email = "billing@acme.com", phone = "+1 555-0123", created = 1712304000 }
```

### `app.integrations.stripe.get_customer(...)`

Retrieve a Stripe customer by ID.

```lua
local customer = app.integrations.stripe.get_customer({
    id = "cus_abc123",
})
-- Returns: { id = "cus_abc123", name = "Acme Corp", email = "billing@acme.com", ... }
```

### `app.integrations.stripe.update_customer(...)`

Update an existing Stripe customer's details.

```lua
local customer = app.integrations.stripe.update_customer({
    id = "cus_abc123",
    name = "Acme Corp (Updated)",
    email = "finance@acme.com",
    metadata = {
        tier = "premium",
    },
})
-- Returns: { id = "cus_abc123", name = "Acme Corp (Updated)", email = "finance@acme.com", ... }
```

### `app.integrations.stripe.list_customers(...)`

List Stripe customers with optional filtering by email and cursor-based pagination.

```lua
-- List all customers (up to limit)
local result = app.integrations.stripe.list_customers({
    limit = 25,
})
-- Returns: { customers = { { id = "cus_abc123", name = "...", email = "...", ... }, ... }, has_more = true }

-- Filter by email
local result = app.integrations.stripe.list_customers({
    email = "billing@acme.com",
    limit = 10,
})

-- Paginate: use the last customer ID as starting_after
local page2 = app.integrations.stripe.list_customers({
    limit = 25,
    starting_after = "cus_abc123",
})
```

### `app.integrations.stripe.delete_customer(...)`

Delete a Stripe customer permanently by ID.

```lua
local result = app.integrations.stripe.delete_customer({
    id = "cus_abc123",
})
-- Returns: { id = "cus_abc123", deleted = true }
```

## Products

### `app.integrations.stripe.create_product(...)`

Create a new Stripe product. Requires a name.

```lua
local product = app.integrations.stripe.create_product({
    name = "Pro Plan",
    description = "Access to all pro features",
    active = true,
    metadata = {
        type = "subscription",
    },
})
-- Returns: { id = "prod_xyz789", name = "Pro Plan", description = "Access to all pro features", active = true, ... }
```

### `app.integrations.stripe.get_product(...)`

Retrieve a Stripe product by ID.

```lua
local product = app.integrations.stripe.get_product({
    id = "prod_xyz789",
})
-- Returns: { id = "prod_xyz789", name = "Pro Plan", description = "...", active = true, ... }
```

### `app.integrations.stripe.list_products(...)`

List Stripe products with optional filtering by active status and cursor-based pagination.

```lua
-- List all products
local result = app.integrations.stripe.list_products({
    limit = 50,
})
-- Returns: { products = { { id = "prod_...", name = "...", ... } }, has_more = false }

-- List only active products
local result = app.integrations.stripe.list_products({
    active = true,
    limit = 100,
})

-- Paginate
local page2 = app.integrations.stripe.list_products({
    limit = 50,
    starting_after = "prod_xyz789",
})
```

## Prices

### `app.integrations.stripe.create_price(...)`

Create a price for a Stripe product. Amounts are in cents. Omit `recurring_interval` for one-time prices.

```lua
-- Recurring monthly price: $29.99/month
local price = app.integrations.stripe.create_price({
    product = "prod_xyz789",
    unit_amount = 2999,
    currency = "usd",
    recurring_interval = "month",
})
-- Returns: { id = "price_def456", product = "prod_xyz789", unit_amount = 2999, currency = "usd", recurring = { interval = "month", interval_count = 1 }, active = true }

-- One-time price: $99.00
local price = app.integrations.stripe.create_price({
    product = "prod_xyz789",
    unit_amount = 9900,
    currency = "usd",
})

-- Recurring every 3 months: $79.99/quarter
local price = app.integrations.stripe.create_price({
    product = "prod_xyz789",
    unit_amount = 7999,
    currency = "usd",
    recurring_interval = "month",
    recurring_interval_count = 3,
})
```

### `app.integrations.stripe.list_prices(...)`

List Stripe prices with optional filtering by product, active status, and cursor-based pagination.

```lua
-- List all prices for a specific product
local result = app.integrations.stripe.list_prices({
    product = "prod_xyz789",
})
-- Returns: { prices = { { id = "price_...", unit_amount = 2999, currency = "usd", recurring = {...}, active = true } }, has_more = false }

-- List only active prices
local result = app.integrations.stripe.list_prices({
    product = "prod_xyz789",
    active = true,
    limit = 50,
})

-- Paginate
local page2 = app.integrations.stripe.list_prices({
    limit = 50,
    starting_after = "price_def456",
})
```

## Payment Intents

### `app.integrations.stripe.create_payment_intent(...)`

Create a Stripe payment intent. Amounts are in cents. Supports automatic payment methods, manual capture, and metadata.

```lua
-- Standard payment: $50.00
local intent = app.integrations.stripe.create_payment_intent({
    amount = 5000,
    currency = "usd",
    customer = "cus_abc123",
    description = "Order #1234",
    metadata = {
        order_id = "1234",
    },
})
-- Returns: { id = "pi_ghi789", amount = 5000, currency = "usd", status = "requires_payment_method", client_secret = "pi_ghi789_secret_...", capture_method = "automatic", customer = "cus_abc123", created = 1712304000 }

-- Manual capture (authorize first, capture later)
local intent = app.integrations.stripe.create_payment_intent({
    amount = 10000,
    currency = "usd",
    capture_method = "manual",
    customer = "cus_abc123",
})

-- Disable automatic payment methods
local intent = app.integrations.stripe.create_payment_intent({
    amount = 2500,
    currency = "eur",
    automatic_payment_methods_enabled = false,
})
```

### `app.integrations.stripe.get_payment_intent(...)`

Retrieve a Stripe payment intent by ID.

```lua
local intent = app.integrations.stripe.get_payment_intent({
    id = "pi_ghi789",
})
-- Returns: { id = "pi_ghi789", amount = 5000, currency = "usd", status = "succeeded", ... }
```

### `app.integrations.stripe.update_payment_intent(...)`

Update a Stripe payment intent's description and metadata.

```lua
local intent = app.integrations.stripe.update_payment_intent({
    id = "pi_ghi789",
    description = "Updated order description",
    metadata = {
        order_id = "1234",
        source = "web",
    },
})
-- Returns: { id = "pi_ghi789", ... }
```

### `app.integrations.stripe.confirm_payment_intent(...)`

Confirm a Stripe payment intent with a payment method. The intent transitions from `requires_payment_method` to `processing` or `succeeded`.

```lua
local intent = app.integrations.stripe.confirm_payment_intent({
    id = "pi_ghi789",
    payment_method = "pm_card_visa",
    return_url = "https://example.com/payment/complete",
})
-- Returns: { id = "pi_ghi789", status = "succeeded", ... }
```

### `app.integrations.stripe.cancel_payment_intent(...)`

Cancel a Stripe payment intent. Only intents in `requires_payment_method`, `requires_capture`, or `requires_confirmation` status can be cancelled.

```lua
local intent = app.integrations.stripe.cancel_payment_intent({
    id = "pi_ghi789",
    cancellation_reason = "requested_by_customer",
})
-- Returns: { id = "pi_ghi789", status = "canceled", ... }

-- Other cancellation reasons: "abandoned", "automatic", "duplicate"
```

### `app.integrations.stripe.capture_payment_intent(...)`

Capture a payment intent that was created with `capture_method = "manual"`. Optionally capture a partial amount.

```lua
-- Capture the full authorized amount
local intent = app.integrations.stripe.capture_payment_intent({
    id = "pi_ghi789",
})

-- Capture a partial amount (less than the original authorization)
local intent = app.integrations.stripe.capture_payment_intent({
    id = "pi_ghi789",
    amount_to_capture = 7500,
})
-- Returns: { id = "pi_ghi789", amount = 10000, amount_capturable = 0, amount_received = 7500, currency = "usd", status = "succeeded" }
```

## Invoices

### `app.integrations.stripe.create_invoice(...)`

Create a Stripe invoice for a customer. Requires a customer ID. Supports description, subscription binding, metadata, and auto-advance.

```lua
local invoice = app.integrations.stripe.create_invoice({
    customer = "cus_abc123",
    description = "March 2026 consulting",
    metadata = {
        project = "website-redesign",
    },
    auto_advance = true,
})
-- Returns: { id = "in_jkl012", number = nil, customer = "cus_abc123", status = "draft", total = 0, currency = "usd", due_date = nil, created = 1712304000 }

-- Create an invoice for a specific subscription
local invoice = app.integrations.stripe.create_invoice({
    customer = "cus_abc123",
    subscription = "sub_mno345",
})
```

### `app.integrations.stripe.get_invoice(...)`

Retrieve a Stripe invoice by ID.

```lua
local invoice = app.integrations.stripe.get_invoice({
    id = "in_jkl012",
})
-- Returns: { id = "in_jkl012", number = "INV-001", customer = "cus_abc123", status = "paid", total = 5000, currency = "usd", ... }
```

### `app.integrations.stripe.list_invoices(...)`

List Stripe invoices with optional filtering by customer, status, and cursor-based pagination.

```lua
-- List invoices for a customer
local result = app.integrations.stripe.list_invoices({
    customer = "cus_abc123",
    limit = 25,
})
-- Returns: { invoices = { { id = "in_...", number = "INV-001", status = "paid", total = 5000, ... } }, has_more = false }

-- Filter by status
local result = app.integrations.stripe.list_invoices({
    customer = "cus_abc123",
    status = "open",
    limit = 10,
})

-- Status values: "draft", "open", "paid", "uncollectible", "void"

-- Paginate
local page2 = app.integrations.stripe.list_invoices({
    customer = "cus_abc123",
    limit = 25,
    starting_after = "in_jkl012",
})
```

### `app.integrations.stripe.pay_invoice(...)`

Pay a Stripe invoice that is in `open` status. The customer must have a default payment method on file.

```lua
local result = app.integrations.stripe.pay_invoice({
    id = "in_jkl012",
})
-- Returns: { id = "in_jkl012", status = "paid", ... }
```

### `app.integrations.stripe.void_invoice(...)`

Void a Stripe invoice in `draft` or `open` status. The invoice is marked as void and cannot be paid.

```lua
local result = app.integrations.stripe.void_invoice({
    id = "in_jkl012",
})
-- Returns: { id = "in_jkl012", status = "void", ... }
```

## Subscriptions

### `app.integrations.stripe.create_subscription(...)`

Create a Stripe subscription for a customer. Requires a customer ID and a price ID. Supports quantity and trial periods.

```lua
-- Standard subscription
local subscription = app.integrations.stripe.create_subscription({
    customer = "cus_abc123",
    price = "price_def456",
})
-- Returns: { id = "sub_mno345", customer = "cus_abc123", status = "active", plan = { ... }, trial_end = nil, current_period_start = 1712304000, current_period_end = 1714982400, created = 1712304000 }

-- With quantity and trial period
local subscription = app.integrations.stripe.create_subscription({
    customer = "cus_abc123",
    price = "price_def456",
    quantity = 5,
    trial_period_days = 14,
    metadata = {
        plan = "enterprise",
    },
})
```

### `app.integrations.stripe.get_subscription(...)`

Retrieve a Stripe subscription by ID.

```lua
local subscription = app.integrations.stripe.get_subscription({
    id = "sub_mno345",
})
-- Returns: { id = "sub_mno345", customer = "cus_abc123", status = "active", plan = { ... }, ... }
```

### `app.integrations.stripe.cancel_subscription(...)`

Cancel a Stripe subscription by ID. Supports proration and immediate invoicing options.

```lua
-- Cancel with proration and final invoice (default)
local result = app.integrations.stripe.cancel_subscription({
    id = "sub_mno345",
    prorate = true,
    invoice_now = true,
})
-- Returns: { id = "sub_mno345", customer = "cus_abc123", status = "canceled", canceled_at = 1712304000, ended_at = 1712304000 }

-- Cancel immediately without proration or final invoice
local result = app.integrations.stripe.cancel_subscription({
    id = "sub_mno345",
    prorate = false,
    invoice_now = false,
})
```

## Balance

### `app.integrations.stripe.get_balance(...)`

Get the Stripe account balance. Returns available and pending amounts broken down by currency.

```lua
local balance = app.integrations.stripe.get_balance({})
-- Returns: { available = { { amount = 12345, currency = "usd" } }, pending = { { amount = 5000, currency = "usd" } } }
```

## Pagination

All list endpoints (`list_customers`, `list_products`, `list_prices`, `list_invoices`) use **cursor-based pagination** via Stripe's `starting_after` parameter.

- `limit` — Number of records to return (1–100, default 10).
- `starting_after` — A cursor: pass the ID of the last object from the previous page.
- `has_more` — The response includes `has_more = true` when additional pages exist.

```lua
-- Collect all customers across pages
local all_customers = {}
local cursor = nil

repeat
    local args = { limit = 100 }
    if cursor then
        args.starting_after = cursor
    end

    local result = app.integrations.stripe.list_customers(args)

    for _, c in ipairs(result.customers) do
        table.insert(all_customers, c)
    end

    if result.has_more and #result.customers > 0 then
        cursor = result.customers[#result.customers].id
    else
        cursor = nil
    end
until cursor == nil
```

## Common Workflows

### Create a product with a recurring price, then subscribe a customer

```lua
-- Step 1: Create the product
local product = app.integrations.stripe.create_product({
    name = "Pro Plan",
    description = "Full access to pro features",
})

-- Step 2: Create a monthly price
local price = app.integrations.stripe.create_price({
    product = product.id,
    unit_amount = 2999,      -- $29.99/month
    currency = "usd",
    recurring_interval = "month",
})

-- Step 3: Create (or look up) a customer
local customer = app.integrations.stripe.create_customer({
    name = "Jane Smith",
    email = "jane@example.com",
})

-- Step 4: Subscribe the customer
local subscription = app.integrations.stripe.create_subscription({
    customer = customer.id,
    price = price.id,
})
```

### Charge a one-time payment

```lua
-- Create a customer, then a payment intent, then confirm
local customer = app.integrations.stripe.create_customer({
    name = "Bob Johnson",
    email = "bob@example.com",
})

local intent = app.integrations.stripe.create_payment_intent({
    amount = 5000,             -- $50.00
    currency = "usd",
    customer = customer.id,
    description = "One-time purchase",
})

local confirmed = app.integrations.stripe.confirm_payment_intent({
    id = intent.id,
    payment_method = "pm_card_visa",
})
```

### Authorize and capture (two-step payment)

```lua
-- Step 1: Create with manual capture
local intent = app.integrations.stripe.create_payment_intent({
    amount = 10000,            -- $100.00
    currency = "usd",
    customer = "cus_abc123",
    capture_method = "manual",
})

-- Step 2: Confirm to authorize (hold) the funds
local confirmed = app.integrations.stripe.confirm_payment_intent({
    id = intent.id,
    payment_method = "pm_card_visa",
})

-- Step 3: Capture when ready (partial or full)
local captured = app.integrations.stripe.capture_payment_intent({
    id = intent.id,
    amount_to_capture = 7500,  -- capture only $75.00
})
```

### Create and pay an invoice

```lua
-- Step 1: Create the invoice
local invoice = app.integrations.stripe.create_invoice({
    customer = "cus_abc123",
    description = "Consulting services — March 2026",
    auto_advance = true,
})

-- Step 2: Pay the invoice (customer must have a default payment method)
local paid = app.integrations.stripe.pay_invoice({
    id = invoice.id,
})
```

### List invoices for a customer and void drafts

```lua
local result = app.integrations.stripe.list_invoices({
    customer = "cus_abc123",
    status = "draft",
    limit = 100,
})

for _, inv in ipairs(result.invoices) do
    app.integrations.stripe.void_invoice({ id = inv.id })
end
```

## Notes

- **All monetary amounts are in cents** — the smallest currency unit. `$10.00` is `1000`, `€5.50` is `550`, `¥1000` is `1000` (zero-decimal currencies).
- **Currency codes** are lowercase three-letter ISO 4217 codes: `"usd"`, `"eur"`, `"gbp"`, `"jpy"`, etc.
- **Metadata** is a flat key-value object (strings only). Useful for linking Stripe objects to your internal IDs.
- **ID parameters** — Single-object lookups (get, update, delete, cancel, confirm, capture, pay, void) use the parameter name `id` (not the object-type name). For example, `get_customer({ id = "cus_..." })`, not `get_customer({ customer = "cus_..." })`.
- **Test mode** — Use `sk_test_...` keys to interact with Stripe's test environment. No real charges are created.
- **Error handling** — API errors include the HTTP status code and Stripe error message. Common errors: `401` (invalid API key), `402` (request failed — e.g., card declined), `404` (object not found), `429` (rate limit exceeded).

---

## Multi-Account Usage

If you have multiple stripe accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.stripe.function_name({...})

-- Explicit default (portable across setups)
app.integrations.stripe.default.function_name({...})

-- Named accounts
app.integrations.stripe.work.function_name({...})
app.integrations.stripe.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
