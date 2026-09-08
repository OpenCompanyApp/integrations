# Zuora — Ruby API Reference

## zuora_list_accounts

List Zuora customer accounts with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"name.EQ:Acme"` or `"status.EQ:Active"` |

### Filter Syntax

Zuora v2 filters use the format: `field.OPERATOR:value`

Common operators: `EQ`, `NE`, `GT`, `GTE`, `LT`, `LTE`, `LIKE`, `IN`, `ISNULL`

Multiple filters: `["field1.EQ:value1","field2.EQ:value2"]`

### Example

```ruby
result = app.integrations.zuora.list_accounts(page_size: 10, filter: "status.EQ:Active")
result.data.each do |account|
  puts((account.name).to_s + " (" + (account.account_number).to_s + ")")
end
```
---

## zuora_get_account

Get details of a specific Zuora account by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `account_id` | string | yes | The Zuora account ID |

### Example

```ruby
result = app.integrations.zuora.get_account(account_id: "8a90b89a8a...")
puts("Account: " + (result.name).to_s)
puts("Balance: " + (result.balance).to_s)
puts("Status: " + (result.status).to_s)
```
---

## zuora_list_subscriptions

List Zuora subscriptions with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Active"` or `"account_id.EQ:8a90b89a..."` |

### Example

```ruby
result = app.integrations.zuora.list_subscriptions(page_size: 20, filter: "status.EQ:Active")
result.data.each do |sub|
  puts((sub.subscription_number).to_s + " - " + (sub.status).to_s)
end
```
---

## zuora_get_subscription

Get details of a specific Zuora subscription by its ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `subscription_id` | string | yes | The Zuora subscription ID |

### Example

```ruby
result = app.integrations.zuora.get_subscription(subscription_id: "8a90b89a8a...")
puts("Subscription: " + (result.subscription_number).to_s)
puts("Status: " + (result.status).to_s)
puts("Start: " + (result.start_date).to_s)
puts("End: " + (result.end_date).to_s)
```
---

## zuora_list_invoices

List Zuora invoices with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Posted"` or `"account_id.EQ:8a90b89a..."` |

### Example

```ruby
result = app.integrations.zuora.list_invoices(page_size: 10, filter: "status.EQ:Posted")
result.data.each do |inv|
  puts((inv.invoice_number).to_s + ": $" + (inv.amount).to_s + " (" + (inv.status).to_s + ")")
end
```
---

## zuora_list_payments

List Zuora payments with filtering and pagination.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page_size` | integer | no | Number of results per page (default: 20, max: 100) |
| `cursor` | string | no | Pagination cursor from a previous response |
| `filter` | string | no | Filter expression, e.g. `"status.EQ:Processed"` or `"account_id.EQ:8a90b89a..."` |

### Example

```ruby
result = app.integrations.zuora.list_payments(page_size: 10, filter: "status.EQ:Processed")
result.data.each do |pay|
  puts((pay.payment_number).to_s + ": $" + (pay.amount).to_s + " via " + (pay.method).to_s)
end
```
---

## zuora_get_current_user

Get the profile of the currently authenticated Zuora user.

### Parameters

None.

### Example

```ruby
result = app.integrations.zuora.get_current_user()
puts("User: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email).to_s)
```
---

## Multi-Account Usage

If you have multiple Zuora tenants configured, use account-specific namespaces:

```ruby
# Default account (always works)
app.integrations.zuora.list_accounts()
# Explicit default (portable across setups)
app.integrations.zuora.default.list_accounts()
# Named accounts (e.g., production vs. sandbox)
app.integrations.zuora.production.list_accounts()
app.integrations.zuora.sandbox.list_accounts()
```
All functions are identical across accounts — only the credentials differ.
