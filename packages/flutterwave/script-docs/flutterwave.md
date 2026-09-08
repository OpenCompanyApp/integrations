# Flutterwave — Ruby API Reference

## list_transactions

List transactions from your Flutterwave account. Supports filtering by status and date range, with pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `status` | string | no | Filter by transaction status (e.g., `"successful"`, `"failed"`, `"pending"`) |
| `from` | string | no | Start date for filtering transactions (YYYY-MM-DD) |
| `to` | string | no | End date for filtering transactions (YYYY-MM-DD) |
| `customer_email` | string | no | Filter by customer email address |
| `tx_ref` | string | no | Filter by merchant transaction reference |
| `customer_fullname` | string | no | Filter by customer full name |
| `currency` | string | no | Filter by transaction currency |

### Examples

#### List recent transactions

```ruby
result = app.integrations.flutterwave.list_transactions(page: 1)
result.data.each do |tx|
  puts((tx.id).to_s + ": " + (tx.amount).to_s + " " + (tx.currency).to_s + " - " + (tx.status).to_s)
end
```
#### Filter by date range and status

```ruby
result = app.integrations.flutterwave.list_transactions(from: "2024-01-01", to: "2024-06-30", status: "successful", tx_ref: "txn-001", currency: "NGN")
```
---

## get_transaction

Retrieve full details of a specific Flutterwave transaction by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Flutterwave transaction ID |

### Examples

#### Get transaction details

```ruby
result = app.integrations.flutterwave.get_transaction(id: 123456)
puts("Amount: " + (result.data.amount).to_s + " " + (result.data.currency).to_s)
puts("Status: " + (result.data.status).to_s)
puts("Customer: " + (result.data.customer.email).to_s)
```
---

## initiate_payment

Initiate a new payment on Flutterwave. Requires a transaction reference, amount, currency, and customer details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `tx_ref` | string | yes | Your unique transaction reference (e.g., `"txn-001"`) |
| `amount` | number | yes | Payment amount (e.g., `5000`) |
| `currency` | string | yes | Three-letter currency code (e.g., `"NGN"`, `"USD"`, `"KES"`) |
| `customer` | object | yes | Customer object with at least an `email` field. May also include `name` and `phonenumber` |
| `redirect_url` | string | no | URL to redirect the customer after payment completion |

### Examples

#### Initiate a payment

```ruby
result = app.integrations.flutterwave.initiate_payment(tx_ref: "txn-001", amount: 5000, currency: "NGN", customer: {email: "customer@example.com", name: "John Doe", phonenumber: "08012345678"})
puts("Payment link: " + (result.data.link).to_s)
```
#### Initiate with redirect URL

```ruby
result = app.integrations.flutterwave.initiate_payment(tx_ref: "txn-002", amount: 100, currency: "USD", customer: {email: "buyer@example.com"}, redirect_url: "https://example.com/callback")
```
---

## verify_transaction

Verify a Flutterwave transaction by its ID to confirm payment status and retrieve full details.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `id` | integer | yes | The Flutterwave transaction ID to verify |

### Examples

#### Verify a transaction

```ruby
result = app.integrations.flutterwave.verify_transaction(id: 123456)
if (result.data.status == "successful")
  puts("Payment confirmed: " + (result.data.amount).to_s + " " + (result.data.currency).to_s)
else
  puts("Payment status: " + (result.data.status).to_s)
end
```
---

## list_customers

List customers registered on your Flutterwave account, with pagination support.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |

### Examples

#### List customers

```ruby
result = app.integrations.flutterwave.list_customers(page: 1)
result.data.each do |customer|
  puts((customer.name).to_s + " <" + (customer.email).to_s + ">")
end
```
---

## create_customer

Create a new customer record on Flutterwave. Requires an email address.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `email` | string | yes | Customer email address |
| `first_name` | string | no | Customer first name |
| `last_name` | string | no | Customer last name |
| `phone` | string | no | Customer phone number |

### Examples

#### Create a customer

```ruby
result = app.integrations.flutterwave.create_customer(email: "jane@example.com", first_name: "Jane", last_name: "Doe", phone: "+2348012345678")
puts("Customer ID: " + (result.data.id).to_s)
```
---

## get_banks

Get a list of supported banks for a given country from Flutterwave.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `country` | string | yes | ISO country code (e.g., `"NG"`, `"KE"`, `"GH"`, `"ZA"`) |

### Examples

#### Get Nigerian banks

```ruby
result = app.integrations.flutterwave.get_banks(country: "NG")
result.data.each do |bank|
  puts((bank.name).to_s + " (" + (bank.code).to_s + ")")
end
```
#### Get Kenyan banks

```ruby
result = app.integrations.flutterwave.get_banks(country: "KE")
```
---

## Multi-Account Usage

If you have multiple flutterwave accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.flutterwave.list_transactions()
# Explicit default (portable across setups)
app.integrations.flutterwave.default.list_transactions()
# Named accounts
app.integrations.flutterwave.production.list_transactions()
app.integrations.flutterwave.staging.list_transactions()
```
All functions are identical across accounts — only the credentials differ.
