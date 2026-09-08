# Paystack — Ruby API Reference

## list_transactions

List transactions on your Paystack integration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of transactions per page (default: 50, max: 100) |
| `page` | integer | no | Page number to retrieve |
| `status` | string | no | Filter by status: `"success"`, `"failed"`, `"abandoned"`, `"reversed"` |
| `customer` | string | no | Filter by customer ID or email |
| `from` | string | no | Start date (ISO 8601, e.g., `"2025-01-01T00:00:00"`) |
| `to` | string | no | End date (ISO 8601, e.g., `"2025-01-31T23:59:59"`) |

### Example

```ruby
result = app.integrations.paystack.list_transactions(per_page: 10, status: "success")
result.data.each do |tx|
  puts((tx.id).to_s + ": " + (tx.amount).to_s + " (" + (tx.status).to_s + ")")
end
```
---

## get_transaction

Get details of a specific transaction by numeric Paystack transaction ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | string | yes | Numeric transaction ID. Use `verify_transaction` when you have a transaction reference. |

### Example

```ruby
result = app.integrations.paystack.get_transaction(id: "123456789")
puts("Status: " + (result.data.status).to_s)
puts("Amount: " + (result.data.amount).to_s)
```
---

## verify_transaction

Verify a transaction by reference. This is the right tool after checkout redirects, webhook delivery, or any workflow where you have the merchant reference rather than Paystack's numeric transaction ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `reference` | string | yes | Transaction reference returned during initialization or webhook processing |

### Example

```ruby
result = app.integrations.paystack.verify_transaction(reference: "order_123")
puts("Status: " + (result.data.status).to_s)
puts("Reference: " + (result.data.reference).to_s)
```
---

## initialize_transaction

Initialize a new payment transaction. Returns an authorization URL for the customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `amount` | integer | yes | Amount in kobo (e.g., `50000` for ₦500.00) |
| `email` | string | yes | Customer email address |
| `reference` | string | no | Unique transaction reference |
| `callback_url` | string | no | URL to redirect after payment |

### Example

```ruby
result = app.integrations.paystack.initialize_transaction(amount: 50000, email: "customer@example.com", callback_url: "https://example.com/callback")
puts("Authorization URL: " + (result.data.authorization_url).to_s)
puts("Reference: " + (result.data.reference).to_s)
```
---

## list_customers

List customers on your integration.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of customers per page (default: 50) |
| `page` | integer | no | Page number to retrieve |

### Example

```ruby
result = app.integrations.paystack.list_customers(per_page: 20)
result.data.each do |cust|
  puts((cust.email).to_s + " - " + ((cust.first_name || "")).to_s + " " + ((cust.last_name || "")).to_s)
end
```
---

## create_customer

Create a new customer.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `first_name` | string | no | Customer first name |
| `last_name` | string | no | Customer last name |
| `phone` | string | no | Customer phone number |

### Example

```ruby
result = app.integrations.paystack.create_customer(email: "jane@example.com", first_name: "Jane", last_name: "Doe", phone: "+2348012345678")
puts("Created customer: " + (result.data.email).to_s)
```
---

## list_plans

List subscription plans.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `per_page` | integer | no | Number of plans per page (default: 50) |
| `page` | integer | no | Page number to retrieve |
| `status` | string | no | Filter by status: `"active"` or `"inactive"` |

### Example

```ruby
result = app.integrations.paystack.list_plans(status: "active")
result.data.each do |plan|
  puts((plan.name).to_s + " - " + (plan.amount).to_s + " kobo / " + (plan.interval).to_s)
end
```
---

## get_current_user

Verify the Paystack API connection and retrieve payment session timeout settings.

### Parameters

None.

### Example

```ruby
result = app.integrations.paystack.connection_check()
puts("Payment session timeout: " + (result.data.payment_session_timeout).to_s)
```
---

## Multi-Account Usage

If you have multiple Paystack accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.paystack.list_transactions()
# Explicit default (portable across setups)
app.integrations.paystack.default.list_transactions()
# Named accounts
app.integrations.paystack.production.list_transactions()
app.integrations.paystack.test.list_transactions()
```
All functions are identical across accounts — only the credentials differ.
