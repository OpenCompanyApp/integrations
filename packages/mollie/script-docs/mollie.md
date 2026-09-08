# Mollie — Ruby API Reference

## list_payments

List payments with optional filters.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of payments to return (default: 50, max: 250) |
| `from` | string | no | Payment ID to start from (for pagination) |
| `profileId` | string | no | Filter by profile ID |

### Example

```ruby
result = app.integrations.mollie.list_payments(limit: 10)
result.payments.each do |payment|
  puts((payment.id).to_s + ": " + (payment.description).to_s + " - " + (payment.amount.value).to_s + " " + (payment.amount.currency).to_s)
end
```
---

## get_payment

Retrieve a single payment by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | The payment ID (e.g., `"tr_abc123"`) |

### Example

```ruby
result = app.integrations.mollie.get_payment(id: "tr_abc123")
puts("Status: " + (result.status).to_s)
puts("Amount: " + (result.amount.value).to_s + " " + (result.amount.currency).to_s)
```
---

## create_payment

Create a new payment.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | object | yes | Amount object with `currency` (e.g., `"EUR"`) and `value` (e.g., `"10.00"`) |
| `description` | string | yes | Payment description shown to the customer |
| `redirectUrl` | string | yes | URL to redirect the customer to after payment |
| `metadata` | object | no | Custom metadata to store with the payment |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `locale` | string | no | Locale for the payment screen (e.g., `"nl_NL"`) |

### Example

```ruby
result = app.integrations.mollie.create_payment(amount: {currency: "EUR", value: "29.99"}, description: "Order #12345", redirect_url: "https://example.com/return")
puts("Payment ID: " + (result.id).to_s)
puts("Checkout URL: " + (result._links.checkout.href).to_s)
```
---

## list_customers

List all customers.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of customers to return (default: 50, max: 250) |
| `from` | string | no | Customer ID to start from (for pagination) |

### Example

```ruby
result = app.integrations.mollie.list_customers(limit: 10)
result.customers.each do |customer|
  puts((customer.id).to_s + ": " + (customer.name).to_s + " (" + (customer.email).to_s + ")")
end
```
---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `name` | string | yes | Full name of the customer |
| `email` | string | yes | Email address of the customer |
| `locale` | string | no | Preferred locale (e.g., `"nl_NL"`) |
| `metadata` | object | no | Custom metadata to store with the customer |

### Example

```ruby
result = app.integrations.mollie.create_customer(name: "Jane Smith", email: "jane@example.com")
puts("Customer ID: " + (result.id).to_s)
```
---

## list_subscriptions

List all subscriptions for a specific customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `limit` | integer | no | Number of subscriptions to return (default: 50, max: 250) |
| `from` | string | no | Subscription ID to start from (for pagination) |

### Example

```ruby
result = app.integrations.mollie.list_subscriptions(customer_id: "cst_abc123")
result.subscriptions.each do |sub|
  puts((sub.id).to_s + ": " + (sub.description).to_s + " - " + (sub.amount.value).to_s + " " + (sub.amount.currency).to_s + " / " + (sub.interval).to_s)
end
```
---

## create_subscription

Create a subscription for a customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `customer_id` | string | yes | The customer ID (e.g., `"cst_abc123"`) |
| `amount` | object | yes | Amount object with `currency` and `value` |
| `interval` | string | yes | Interval (e.g., `"1 month"`, `"1 year"`) |
| `description` | string | yes | Description of the subscription |
| `method` | string | no | Payment method (e.g., `"ideal"`, `"creditcard"`) |
| `webhookUrl` | string | no | URL to receive webhook notifications |
| `metadata` | object | no | Custom metadata |
| `startDate` | string | no | Start date (ISO 8601, e.g., `"2026-05-01"`) |
| `times` | integer | no | Number of billing cycles (null = indefinite) |

### Example

```ruby
result = app.integrations.mollie.create_subscription(customer_id: "cst_abc123", amount: {currency: "EUR", value: "9.99"}, interval: "1 month", description: "Pro plan monthly")
puts("Subscription ID: " + (result.id).to_s)
puts("Status: " + (result.status).to_s)
```
---

## list_invoices

List invoices for the authenticated account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `limit` | integer | no | Number of invoices to return (default: 50, max: 250) |
| `from` | string | no | Invoice ID to start from (for pagination) |
| `reference` | string | no | Filter by invoice reference |
| `year` | integer | no | Filter by year |
| `month` | integer | no | Filter by month |

### Example

```ruby
result = app.integrations.mollie.list_invoices(year: 2026)
result.invoices.each do |invoice|
  puts((invoice.id).to_s + ": " + (invoice.reference).to_s + " - " + (invoice.grossAmount.value).to_s + " " + (invoice.grossAmount.currency).to_s)
end
```
---

## get_current_user

Retrieve the enabled payment methods for the authenticated account.

### Parameters

None.

### Example

```ruby
result = app.integrations.mollie.get_payment_methods()
result.methods.each do |method|
  puts((method.id).to_s + ": " + (method.description).to_s)
end
```
---

## Multi-Account Usage

If you have multiple Mollie accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
