# ChartMogul — Lua API Reference

## list_customers

List customers from ChartMogul with optional filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 50, max: 200) |
| `page` | integer | no | Page number, starting from 1 (default: 1) |
| `status` | string | no | Filter by customer status: "Active", "Cancelled", "Future" |
| `email` | string | no | Filter by customer email address |

### Examples

```lua
-- List all active customers
local result = app.integrations.chartmogul.list_customers({
  status = "Active",
  per_page = 50,
  page = 1
})

for _, customer in ipairs(result.entries) do
  print(customer.name .. " (" .. customer.email .. ")")
end

-- Search by email
local result = app.integrations.chartmogul.list_customers({
  email = "john@example.com"
})
```

---

## get_customer

Get details for a single ChartMogul customer by UUID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The ChartMogul customer UUID |

### Examples

```lua
local result = app.integrations.chartmogul.get_customer({
  id = "cus_abc123-def456"
})

print(result.name .. " - " .. result.status)
```

---

## list_subscriptions

List subscriptions with optional filtering by customer or status.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 50, max: 200) |
| `page` | integer | no | Page number, starting from 1 (default: 1) |
| `customer_uuid` | string | no | Filter by customer UUID |
| `status` | string | no | Filter by status: "active", "cancelled", "expired", "future" |

### Examples

```lua
-- List active subscriptions for a customer
local result = app.integrations.chartmogul.list_subscriptions({
  customer_uuid = "cus_abc123",
  status = "active"
})

for _, sub in ipairs(result.entries) do
  print(sub.plan .. " - " .. sub.state)
end
```

---

## list_plans

List billing plans from ChartMogul.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 50, max: 200) |
| `page` | integer | no | Page number, starting from 1 (default: 1) |

### Examples

```lua
local result = app.integrations.chartmogul.list_plans({
  per_page = 100
})

for _, plan in ipairs(result.plans) do
  print(plan.name .. " - " .. plan.amount .. " " .. plan.currency)
end
```

---

## list_invoices

List invoices with optional filtering by customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of results per page (default: 50, max: 200) |
| `page` | integer | no | Page number, starting from 1 (default: 1) |
| `customer_uuid` | string | no | Filter by customer UUID |

### Examples

```lua
-- List invoices for a specific customer
local result = app.integrations.chartmogul.list_invoices({
  customer_uuid = "cus_abc123",
  per_page = 10
})

for _, invoice in ipairs(result.entries) do
  print(invoice.external_id .. ": " .. invoice.amount .. " on " .. invoice.date)
end
```

---

## get_metrics

Query subscription analytics metrics from ChartMogul.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `start_date` | string | yes | Start date (ISO 8601, e.g. "2025-01-01") |
| `end_date` | string | yes | End date (ISO 8601, e.g. "2025-01-31") |
| `interval` | string | no | Grouping interval: "day", "week", "month" (default: "month") |
| `type` | string | no | Metrics type: "absolute" or "percentage" |

### Examples

```lua
-- Monthly MRR over a quarter
local result = app.integrations.chartmogul.get_metrics({
  start_date = "2025-01-01",
  end_date = "2025-03-31",
  interval = "month"
})

for _, entry in ipairs(result.entries) do
  print(entry.date .. ": MRR = " .. entry.mrr .. ", ARR = " .. entry.arr)
end

-- Daily metrics
local result = app.integrations.chartmogul.get_metrics({
  start_date = "2025-03-01",
  end_date = "2025-03-31",
  interval = "day"
})
```

---

## get_current_user

Get the currently authenticated ChartMogul user.

### Parameters

None.

### Examples

```lua
local result = app.integrations.chartmogul.get_current_user({})
print("Connected as: " .. result.first_name .. " " .. result.last_name .. " (" .. result.email .. ")")
```

---

## Multi-Account Usage

If you have multiple ChartMogul accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.chartmogul.function_name({...})

-- Explicit default (portable across setups)
app.integrations.chartmogul.default.function_name({...})

-- Named accounts
app.integrations.chartmogul.production.function_name({...})
app.integrations.chartmogul.staging.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
